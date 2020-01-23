<?php


// if (isset($_POST['valider_google'])) {
//     include("config.php");
//     echo $_SESSION["user_profile"];
// }
// if(isset($_COOKIE['user_profile'])){
//     //  var_dump($_COOKIE);die();
// }
// var_dump($_SESSION);
?>

<!-- <form action="" method="post" id="fcontact">
    <p class="titre">sign up</p>
    <div class="form-info">
         col left -->
        <!-- <div class="col-left">
            
            <button type="submit" name="valider_google">connect via google</button>
        </div>
    </div>
    <div class="confirmation">
        <button type="submit" name="valider">Confirmer votre reservation</button>
    </div>
</form> -->
<?php
/**
 * Build a simple HTML page with multiple providers.
 */

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

use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);

$providers = $hybridauth->getProviders();
include 'config.php';
if (isset($_GET['logout'])) {
    // var_dump('sdfdfsdfdf', $_SESSION['HYBRIDAUTH::STORAGE']);exit;
    unset($_SESSION['HYBRIDAUTH::STORAGE']);
    $hybridauth->logoutAllProviders();
    $adapter->disconnect();
    header("Location: http://www.testlogin.test/account.php", true,301);

}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example 06</title>
</head>
<body>
<h1>Sign in</h1>

<ul>
    <?php foreach ($providers as $key=>$name) { 
            var_dump('dumpin,g ; ', $key,$name, $providers);
          ?>
            <li>
            <?php print $config['callback'] . "?provider={$name}"; ?>
                <a href="<?php print $config['callback'] . "?provider={$name}"; ?>">
                    Sign in with <strong><?php print $name; ?></strong>
                </a>
            </li>
    <?php 
         }; ?>
</ul>
<pre><?php var_dump($adapters); ?></pre>
<?php if ($adapters) : ?>
    <h1>You are logged in:</h1>
    <ul>
        <?php foreach ($adapters as $name => $adapter) { 
            
            var_dump($name);
            ?>
            <li>
                <strong><?php print $userProfile->displayName; ?></strong> from
                <i><?php print $name; ?></i>
                <span>(<a href="<?php print $config['callback'] . "?logout={$name}"; ?>">Log Out</a>)</span>
            </li>
        <?php }; ?>
    </ul>
<?php endif; ?>
</body>
</html>
