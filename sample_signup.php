<?php
    var_dump($_POST);
    $signupErrorLogger = false;

    $req_pays=mysql_query("select * from `users` where email = '". $_POST['email_client'] ."'");
    # response handling
        if(!$req_pays)
            var_dump(mysql_error());
        else{        
            $val_pays = mysql_fetch_object($req_pays);

            # check if the user all ready exist send an error message
            if($val_pays){ 
                $signupErrorLogger = 'this email is allready registerd if its u try signin';
            }
            # if not regester data 
            else{
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                $txt_req_res="INSERT IGNORE INTO `users` (
                    `email`,`civilite`, `firstname`, `lastname`, `tele`, `adress`, `ville`, `codepostal`,`date_naissance`, `password`
                    ) VALUES ('".$_POST['email_client']."', '". $_POST['civilite']."',
                    '". $_POST['nom_client']."',
                    '".$_POST['prenom_client']."',
                    '".$_POST['tel_client']."',
                    '".$_POST['adresse_client']."',
                    '".$_POST['ville_client']."',
                    '".$_POST['code_postal']."',
                    ".$_POST['date_client'].",
                    '".$hashed_password."'
                    );";
                
                mysql_query($txt_req_res);
                $result = mysql_query($txt_req_res, $connexion) or var_dump($txt_req_res, mysql_error());
                if($result){
                    $req=mysql_query("select * from `users` where email = '". $_POST['email_client'] ."'");
                    $val_pays = mysql_fetch_object($req);
                    var_dump('signed in : ', $val_pays);
                    $_SESSION['user']['loggedin'] = true;
                    $_SESSION['user']['email'] = $_POST['email_client'];
                    $_SESSION['user']['id'] = $val_pays->id;
                }
                var_dump($result);exit;
                
            }
        }
    #