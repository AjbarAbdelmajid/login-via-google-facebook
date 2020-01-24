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
         
        # setting up the conection to DB
            $csx_host_bd="localhost";
            $csx_nom_bd="timoulayhotel-com";
            $csx_user_bd="root";
            $csx_pass_bd="123";
            $connexion=mysql_connect ($csx_host_bd, $csx_user_bd, $csx_pass_bd) or die ('Connexion impossible erreur : ' . mysql_error());
            mysql_select_db($csx_nom_bd);
            mysql_query("SET NAMES 'UTF8'"); // encodage utf8 
        #
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
                    $txt_req_res="INSERT INTO `users` (
                        `email`, `lastname`, `firstname`
                        ) VALUES ('".$userProfile->email."', '". $userProfile->firstName."','".$userProfile->lastName."');";
            
                    mysql_query($txt_req_res);
                    $result = mysql_query($txt_req_res, $connexion) or var_dump($txt_req_res, mysql_error());
                }
            #
            # update user social media data if user existe
                else{
                    $txt_req_res="UPDATE `users`
                    SET ".$provider."_username='".$userProfile->displayName."', ".$provider."_data='".base64_encode(serialize($userProfile))."', ".$provider."_identifire='".$userProfile->identifier."'
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
    }

    /**
     * Redirects user to home page (i.e., index.php in our case)
     */
   
} catch (Exception $e) {
    var_dump( $e->getMessage()); exit;
    echo $e->getMessage();
}
