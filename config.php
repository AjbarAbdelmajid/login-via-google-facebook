<?php
require_once 'vendor/hybridauth/hybridauth/src/autoload.php';
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;

$config = [
    'callback' => 'http://localhost/testSocialLogin/login.php',
    'providers' => [
        'GitHub' => [ 
            'enabled' => false,
            'keys'    => [ 'id' => '', 'secret' => '' ], 
        ],

        'Google' => [ 
            'enabled' => true,
            'keys' => [
                'id'     => '649634393214-mo3l2hl3f33m7kc8q4cve9h8p9uh8abu.apps.googleusercontent.com', //Required: your Facebook application id
                'secret' => 'NbYBJ4dJkNFtKY00Fl3Ibb_C'
            ],
        ],

        'Facebook' => [ 
            'enabled' => false,
            'keys'    => [ 'id' => '', 'secret' => '' ],
        ],
    ],

];

// $adapter = new Hybridauth\Provider\Google($config);

// $adapter->authenticate();

// $accessToken = $adapter->getAccessToken();

// $userProfile = $adapter->getUserProfile();
try {    
    $hybridauth = new Hybridauth( $config );
    $adapters = []; $adapters = $hybridauth->getConnectedAdapters();
    $adapter = $hybridauth->authenticate( 'Google' );

    // $adapter = $hybridauth->authenticate( 'Google' );
    // $adapter = $hybridauth->authenticate( 'Facebook' );
    // $adapter = $hybridauth->authenticate( 'Twitter' );

    $tokens = $adapter->getAccessToken();
    $userProfile = $adapter->getUserProfile();


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
            // var_dump($userProfile,'--------',$val_pays,'--------------', $adapters);
    #
    # add the user if not exist 
        if(!$val_pays){
            $txt_req_res="INSERT INTO `users` (
                `email`, `lastname`, `firstname`
                ) VALUES ('".$userProfile->email."', '". $userProfile->firstName."','".$userProfile->lastName."');";
    
            mysql_query($txt_req_res);
             $result = mysql_query($txt_req_res, $connexion) or var_dump("select * from `users` where email = '". $userProfile->email."'", mysql_error());
             die();
        }
    #
        
    // $adapter->disconnect();
}
catch (\Exception $e) {
    echo $e->getMessage();
}
