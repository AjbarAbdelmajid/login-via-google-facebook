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
include 'callback.php';
ini_set('display_errors', '1');
use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);

$providers = $hybridauth->getProviders();

$userProfile = $_SESSION['userProfile'];
// var_dump( $_SESSION);exit;

# check if the user exist
    $req_pays=mysql_query("select * from `users` where email = '".$_SESSION['user']['email']."'");
    # response handling
        if(!$req_pays)
            var_dump(mysql_error());
        else        
            $val_pays = mysql_fetch_object($req_pays);
    #
    //var_dump($val_pays);
    //var_dump($providerName,'dfgdf', $val_pays,'--------------', unserialize(base64_decode($val_pays->Google_data)));
#

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example 06</title>
</head>
<body>

sdfsdf
<!-- <pre><?php echo('sgfsdf');// var_dump($adapters); ?></pre> -->
<?php  if (isset($_SESSION['provider'])) : ?>
    <h1>You are logged in:</h1>
    <ul>
        <li>
            <!-- <strong>
                <?php # print $userProfile->displayName; ?>
            </strong> from -->
            <i><?php print $_SESSION['provider']; ?></i>
            <span>(<a href="<?php print "http://www.testlogin.test/account.php" . "?logout={$_SESSION['provider']}"; ?>">Log Out</a>)</span>
        </li>
    </ul>
<?php endif; ?>
</body>
</html>
