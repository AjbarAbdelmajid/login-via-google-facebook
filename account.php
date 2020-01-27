<?php
/**
 * Build a simple HTML page with multiple providers.
 */
ini_set('display_errors', '1');

include 'vendor/autoload.php';
use Hybridauth\Hybridauth;
include 'callback.php';
include_once 'db_config.php';

$signupErrorLogger = false;
$hybridauth = new Hybridauth($config);
$providers = $hybridauth->getProviders();
$lang = 'fr';

if(isset($_POST['valider'])){
    include 'sample_signup.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example 06</title>
</head>
<body>
    <form action="" method="POST" id="fcontact">
        <div class="form-info">
        <h1>Sign up</h1>
        <div class="form-info">
                                    
            <!-- col left -->
            <div class="col-left">

            <p>
                <label>agence name :</label>
                <input name="nom_agence" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_nomag_val"; ?>'}}}"/>
            </p>
            <p>
                <label><?php echo 'TXT_extra_ins_niata'; ?>  :</label>
                <input name="num_iata" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_niata_val"; ?>'}}}"/>
            </p>
            <p>
                <label><?php echo "TXT_extra_ins_if"; ?> :</label>
                <input name="id_fiscale" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_if_val"; ?>'}}}"/>
            </p>
            <p>
                <label><?php echo "TXT_extra_ins_directeur"; ?> :</label>
                <input name="nomc_directeur" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_directeur_val"; ?>'}}}"/>
            </p>
            <p>
                <label><?php echo "TXT_extra_ins_adresse"; ?> :</label>
                <input name="adresse_agence" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_adresse_val"; ?>'}}}" />
            </p>
            <p>
                <label><?php echo "TXT_extra_ins_cp"; ?> :</label>
                <input name="cp_agence" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_cp_val"; ?>'}}}"/>
            </p>
            <p>
                <label><?php echo 'TXT_extra_ins_fax'; ?>  :</label>
                <input name="fax_agence" type="text" class="{validate:{required:true, messages:{required:'• <?php echo "TXT_extra_ins_fax_val"; ?>'}}}"/>
            </p>
            <p>
                <label><?php echo 'TXT_extra_ins_passe'; ?> :</label><input id="password_agence" name="password_agence" type="password" class="{validate:{required:true,minlength:6, messages:{required:'• <?php echo "TXT_extra_ins_passe_val"; ?>',minlength:'• <?php echo "TXT_extra_ins_passe_val2"; ?>'}}}" />
            </p>
            <p>
                <label><?php echo 'TXT_extra_ins_repeat_passe'; ?> :</label><input  name="password_agencec" type="password" class="{validate:{equalTo:'#password_agence', messages:{equalTo:'• <?php echo "TXT_extra_ins_repeat_passe_val"; ?>'}}}"/>
            </p>


                <!-- debut input-->
                <div class="input-group">
                <select name="civilite" class="{validate:{required:true, messages:{required:'•  TXT_contact_civilite_val '}}}">
                <option value="TXT_contact_mr; ?>" selected="selected">mr</option>
                <option value=" TXT_contact_mme; ?>"> ms</option>
                <option value=" TXT_contact_mlle; ?>"> mll </option>
                </select>
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                    <input name="nom_client" type="text" class="{validate:{required:true, messages:{required:'•  TXT_contact_nom_val; ?>'}}}" placeholder=" nom_client *">                                       
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                <input name="prenom_client" type="text" class="{validate:{required:true, messages:{required:'•  TXT_contact_prenom_val; ?>'}}}" placeholder=" prenom_client *">
                
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                <input name="date_client" type="date" class="{validate:{date: true,required:false, messages:{required:'•  TXT_contact_date_naissance_val; ?>'}}}" placeholder=" <?php if($lang=='fr') echo '(aaaa-mm-jj)'; else echo '(yyyy-mm-dd)'; ?>">
                                                
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                <input  name="email_client" type="text" class="{validate:{required:true,email:true, messages:{required:'•  TXT_contact_email_val; ?>',email:'•  contact_email_val'}}}" placeholder=" email_client *">
                
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                <input name="tel_client" type="text" class="{validate:{required:true, messages:{required:'•  TXT_contact_tel_val; ?>'}}}" placeholder=" tel_client *">
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                
                <input name="adresse_client" type="text" class="{validate:{required:true, messages:{required:'•  TXT_contact_adresse_val; ?>'}}}" placeholder=" adresse_client *">
                </div>
                <!--fin input-->
            </div>
            <!-- col right -->
            <div class="col-right">
                <!-- debut input-->
                <div class="input-group">
                <input name="cp_client" type="text" class="{validate:{required:true, messages:{required:'•  TXT_contact_cp_val; ?>'}}}" placeholder=" _contact_cp_client *">
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                
                <input name="ville_client" type="text" class="{validate:{required:true, messages:{required:'•  TXT_contact_ville_val; ?>'}}}" placeholder=" ville_client *">
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                
                <input name="code_postal" type="number" class="{validate:{required:true, messages:{required:'•  TXT_contact_ville_val; ?>'}}}" placeholder=" number *">
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                
                <input name="password" type="password" class="{validate:{required:true, messages:{required:'•  TXT_contact_ville_val; ?>'}}}" placeholder=" password *">
                </div>
                <!--fin input-->
                <!-- debut input-->
                <div class="input-group">
                <select name="id_pays" class="{validate:{required:true, messages:{required:'•  TXT_contact_pays_val'}}}">

                <option value="" > country </option>

                <?php $req_pays=mysql_query("select * from `pays` order by nom_pays_".$lang."");
                if(!$req_pays){
                    var_dump(mysql_error());exit;
                }
                while($val_pays = mysql_fetch_array($req_pays)) 
                    {?>
                <option value="<?php echo $val_pays["id_pays"]; ?>"><?php echo $val_pays["nom_pays_".$lang.""]; ?></option>
                <?php }?>
                </select>

                </div>
                <!--fin input-->
                <div class="input-group">
                <textarea name="informations_sup" cols="" rows=""  class="{validate:{required:true, messages:{required:'•  TXT_contact_infosup_val; ?>'}}}" placeholder=" TXT_contact_infosup;"></textarea>

                </div>
            </div>
        
        </div>
            <div class="col-left">
            <?php foreach ($providers as $key=>$name) { ?>
                <ul>
                    <li>
                        <button ><a target="_blank" href="<?php print $config['callback'] . "?provider={$name}"; ?>"> connect via <?php echo $name; ?></a> </button>
                    </li>
                </ul>
            <?php }; ?>
                
            </div>
        </div>
        <div class="confirmation">
            <p style="color: red;"><?php if($signupErrorLogger != false) echo $signupErrorLogger ; ?></p>
            <button type="submit" name="valider">Confirmer votre reservation</button>
        </div>
    </form>
</body>
</html>
