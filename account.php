<?php
/**
 * Build a simple HTML page with multiple providers.
 */

use Hybridauth\Hybridauth;
include 'vendor/autoload.php';

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

$hybridauth = new Hybridauth($config);
$providers = $hybridauth->getProviders();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example 06</title>
</head>
<body>
    <h1>Sign in</h1>
    <form action="" method="POST" id="fcontact">
        <p class="titre">sign up</p>
        <div class="form-info">
            col left -->
            <div class="col-left">
            <?php foreach ($providers as $key=>$name) { 
                   
                ?>
                    <li>
                    <?php print $config['callback'] . "?provider={$name}"; ?>
                        <button name="valider_google">
                    <a href="<?php print $config['callback'] . "?provider={$name}"; ?>"> connect via google</a>
                </button>
                    </li>
            <?php 
                }; ?>
                
            </div>
        </div>
        <div class="confirmation">
            <button type="submit" name="valider">Confirmer votre reservation</button>
        </div>
    </form>
</body>
</html>
