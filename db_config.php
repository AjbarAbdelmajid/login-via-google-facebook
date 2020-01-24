<?php

  
# setting up the conection to DB
    $csx_host_bd="localhost";
    $csx_nom_bd="timoulayhotel-com";
    $csx_user_bd="root";
    $csx_pass_bd="123";
    $connexion=mysql_connect ($csx_host_bd, $csx_user_bd, $csx_pass_bd) or die ('Connexion impossible erreur : ' . mysql_error());
    mysql_select_db($csx_nom_bd);
    mysql_query("SET NAMES 'UTF8'"); // encodage utf8 
#