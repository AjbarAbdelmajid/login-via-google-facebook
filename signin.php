<?php 
    include 'callback.php';

    if (isset($_POST['valider'])) {
        # searsh for email and password
            # if not exist post error
                $val_pays=mysql_query("select * from `users` where email = '".$_POST['email']."'");
                 # check if the user exist
                 if($val_pays){ 
                    if (password_verify($_POST['password'], $val_pays['password'])) {
                        $_SESSION['user']['loggedin'] = true;
                        $_SESSION['user']['email'] = $_POST['email_client'];
                        $_SESSION['user']['id'] = $val_pays->id;;
                    }else{
                        $signupErrorLogger = 'authentification error';
                    }
                }
                else{
                    $signupErrorLogger = 'authentification error';
                }
            # response handling
                // if(!$req_pays)
                //     var_dump(mysql_error());
                // else{
                //     $val_pays = mysql_fetch_object($req_pays);

                //     # check if the user exist
                //     if($val_pays){ 
                //         var_dump($val_pays);
                //         $_SESSION['user']['loggedin'] = true;
                //         $_SESSION['user']['email'] = $_POST['email_client'];
                //         $_SESSION['user']['id'] = $val_pays->id;
                //     }
                //     # if not regester data 
                //     else{
                //         $signupErrorLogger = 'authentification error';
                //     }
                // }
            # if exist 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>signin</title>
</head>
<body>
    <form action="" method="POST" id="signin">
        <div class="form-info">
        <h1>signin</h1>
        <div class="form-info">
            <div class="input-group">
                <input name="email" type="email" class="" placeholder=" email *">                                       
            </div><br>
            <div class="input-group">
                <input name="password" type="password" class="" placeholder=" password *">
            </div>
        </div>
            <div class="col-left">
            <?php foreach ($providers as $key=>$name) { ?>
                <ul>
                    <li>
                        <button ><a href="<?php print $config['callback'] . "?provider={$name}"; ?>"> connect via <?php echo $name; ?></a> </button>
                    </li>
                </ul>
            <?php }; ?>
                
            </div>
        </div>
        <div class="confirmation">
            <p style="color: red;"><?php if($signupErrorLogger != false) echo $signupErrorLogger ; ?></p>
            <button type="submit" name="valider">signin</button>
        </div>
    </form>
</body>
</html>
