<?php
/**
 * A simple example that shows how to use multiple providers.
 */
ini_set('display_errors', '1');
ini_set('xdebug.var_display_max_depth', '-1');
ini_set('xdebug.var_display_max_children', '-1');
ini_set('xdebug.var_display_max_data', '-1');

include 'vendor/autoload.php';
include 'config.php';
include_once 'db_config.php';

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

try {
    /**
     * Feed configuration array to Hybridauth.
     */
    $hybridauth = new Hybridauth($config);
    
    /**
     * Initialize session storage.
     */
    $storage = new Session();

    /**
     * Hold information about provider when user clicks on Sign In.
     */
    
    if (isset($_GET['provider'])) {
        $storage->set('provider', $_GET['provider']);
        var_dump('sdfsdfsd');
    }
    /**
     * When provider exists in the storage, try to authenticate user and clear storage.
     *
     * When invoked, `authenticate()` will redirect users to provider login page where they
     * will be asked to grant access to your application. If they do, provider will redirect
     * the users back to Authorization callback URL (i.e., this script).
     */
    if ($provider = $storage->get('provider')) {

        $adapter = $hybridauth->authenticate($provider);
        $storage->set('provider', null);
        $userProfile = $adapter->getUserProfile();

        $_SESSION['userProfile'] = $userProfile;
        $_SESSION['provider'] = $provider;
        // var_dump( $userProfile); exit;
       
        # check if the user exist
            $req_pays=mysql_query("select * from `users` where email = '". $userProfile->email."'");
            # response handling
                if(!$req_pays)
                    var_dump(mysql_error());
                else        
                    $val_pays = mysql_fetch_object($req_pays);
            #
            

            # add the user if not exist 
                if(!$val_pays){
                    $generated_password = $userProfile->firstName.'_'.substr(''.$userProfile->identifier, 0, 2).'_'.$userProfile->lastName; 
                    # firstname + _ + 4 degits from identifire + _ + lastname;
                    $hashed_password = password_hash($generated_password, PASSWORD_DEFAULT);
                    $txt_req_res="INSERT IGNORE INTO `users` (
                        `email`, `firstname`, `lastname`, `tele`, `adress`, `ville`, `codepostal`, `".$provider."_data`, `".$provider."_username`, `password`, `".$provider."_identifier`
                        ) VALUES ('".$userProfile->email."', '". $userProfile->firstName."',
                        '".$userProfile->lastName."',
                        '".$userProfile->phone."',
                        '".$userProfile->address."',
                        '".$userProfile->city."',
                        '".$userProfile->zip."',
                        '".base64_encode(serialize($userProfile))."',
                        '".$userProfile->displayName."',
                        '".$hashed_password."',
                        '".$userProfile->identifier."'
                        );";

                    mysql_query($txt_req_res);
                    $result = mysql_query($txt_req_res, $connexion) or var_dump($txt_req_res, mysql_error());
                    # get db data
                        $req_user=mysql_query("select id from `users` where email = '". $userProfile->email."'");
                        # response handling
                            if(!$req_user)
                                var_dump(mysql_error());
                            else  {      
                                $userid = mysql_fetch_object($req_user);
                                $_SESSION['user']['loggedin'] = true;
                                $_SESSION['user']['email'] = $userProfile->email;
                                $_SESSION['user']['id'] = $userid['id'];
                            }
                        #
                    # add data to user session
                    
                }
            #
            # update user social media data if user existe
                else{
                    $txt_req_res="UPDATE `users`
                    SET ".$provider."_username='".$userProfile->displayName."', ".$provider."_data='".base64_encode(serialize($userProfile))."', ".$provider."_identifier='".$userProfile->identifier."'
                    WHERE email ='".$userProfile->email."'";
            
                    mysql_query($txt_req_res);
                    $result = mysql_query($txt_req_res, $connexion) or var_dump($txt_req_res, mysql_error());
                }
                // var_dump($result);exit;
            #
        #
    }

    /**
     * This will erase the current user authentication data from session, and any further
     * attempt to communicate with provider.
     */
    if (isset($_GET['logout'])) {
        $adapter = $hybridauth->getAdapter($_GET['logout']);
        $adapter->disconnect();
        HttpClient\Util::redirect('http://www.testlogin.test/account.php');
        unset($_SESSION['user']);
    }

    /**
     * Redirects user to home page (i.e., index.php in our case)
     */
   
} catch (Exception $e) {
    var_dump( $e->getMessage()); exit;
    echo $e->getMessage();
}
