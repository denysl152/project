<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, user-scalable=yes" />
            <title>Formulaire d'abonnement</title>
            <script type="text/javascript" src="veriform.js"></script>
            <link rel ="stylesheet" href="formulaire.css"/>
            <?php
                //ouverture de la session pour la reception des variable POST
                session_start();
                $_SESSION['bouton_pack'] = $_POST['bouton_pack'];
            ?>
            
        </head>
        <body>
            <div class="haut"><h1>BON DE COMMANDE</h1></div>

            
            
            <form name="formulaire" onsubmit="return verifForm(this)" action="upload_rib.php" enctype="multipart/form-data" method="post">
            <div class="gauche">
                <div class="titulaire_compte">
                <h3>Titulaire du compte</h3>
                <p>Nom* : <input name="nom" type="text" onblur="verifNom(this)" title="trois carctères minimum pour le nom"  <?php if(isset($_GET['nom'])) echo"value=".$_GET['nom'].""; ?>/> Prénom* : <input name="prenom" type="text" onblur="verifNom(this)" title="trois carctères minimum pour le prenom" <?php if(isset($_GET['prenom'])) echo"value=".$_GET['prenom'].""; ?>/></p>
                <p>Tél.* : <input name="mobile" type="text" onblur="verifMobile(this)" title="saisir dix chiffres exemple : XXXX562309" <?php if(isset($_GET['mobile'])) echo"value=".$_GET['mobile'].""; ?>/> Email* : <input name="email" type="email" onblur="verifMail(this)" <?php if(isset($_GET['email'])) echo"value=".$_GET['email'].""; ?>/></p>
                <p>Raison sociale : <input name="raison_soc" type="text" <?php if(isset($_GET['raison_soc'])) echo"value=".$_GET['raison_soc'].""; ?>/></p>
                <p>Adresse* : </p>
                <textarea name="adresse" cols="40" rows="2" onblur="verifInput(this)"><?php if(isset($_GET['adresse'])) echo $_GET['adresse']; ?></textarea>
                <p>Code postale* : <input name="CP" type="text" onblur="verifInput(this)" <?php if(isset($_GET['CP'])) echo"value=".$_GET['CP'].""; ?>/> Ville* : <input name="ville" type="text" onblur="verifInput(this)" <?php if(isset($_GET['ville'])) echo"value=".$_GET['ville'].""; ?>/></p>
                <p>Exportez votre RIB (JPG, PNG ou PDF | max. 2 Mo) :</p>
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                <input type="file" name="rib" id="rib" onblur="veriRib(this)"/>
                </div>
                <div class="nom_domaine">
                <h3>Votre Nom de Domaine</h3>
                <p>Nom de domaine : <input name="domaine" type="text" <?php if(isset($_GET['domaine'])) echo"value=".$_GET['domaine'].""; ?>/></p>
                <img src="bas_gauche.png"/>
                </div>
            </div>
            <div class="droite">
                <div class="pack">
                  <?php
                    if ($_POST['bouton_pack']=="PACK PRESENCE")
                    {
                        include('pack_presence.php');
                    }
                     if ($_POST['bouton_pack']=="PACK NEO")
                    {
                        include('pack_neo.php');
                    }
                    if ($_POST['bouton_pack']=="PACK BUSINESS")
                    {
                        include('pack_business.php');
                    }                    
                  ?>  
                </div>
                <div class="etablissement">
                <h3>Etablissement teneur du compte à débiter</h3>
                <p>Nom : <input name="nom_etablissement" type="text" <?php if(isset($_GET['nom_etablissement'])) echo"value=".$_GET['nom_etablissement'].""; ?>/></p>
                <p>Adresse postale : </p>
                <textarea name="adresse_etablissement" cols="40" rows="2"><?php if(isset($_GET['adresse_etablissement'])) echo"value=".$_GET['adresse_etablissement'].""; ?></textarea>
                <p>Code postale : <input name="cp_etablissement" type="text" <?php if(isset($_GET['cp_etablissement'])) echo"value=".$_GET['cp_etablissement'].""; ?>/> Ville : <input name="ville_etablissement" type="text" <?php if(isset($_GET['ville_etablissement'])) echo"value=".$_GET['ville_etablissement'].""; ?>/></p>
                <img src="bas_droite.png"/>
                <input name="bouton" type="submit" value="signer"/><br />
                <p style=" text-align: left; font-size: small; color: rgb(125, 125, 125);"><em>Attention, à partir du 1er février 2014, les opérations de paiement non conformes à la norme SEPA seront rejetées par les banques.</em></p>
                </div>
            </div>
            </form>
        </body>
    </html>