<?php
/**
 * Build a simple HTML page with multiple providers.
 */
ini_set('display_errors', '1');

include 'vendor/autoload.php';
use Hybridauth\Hybridauth;
include 'callback.php';

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
                        <button type="submit" name="valider_google">
                    <a href="<?php print $config['callback'] . "?provider={$name}"; ?>"> connect via <?php echo $name; ?></a>
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
