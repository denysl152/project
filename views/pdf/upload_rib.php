<?php

//recuppération des variable du formulaire pour la session
			session_start();
			$_SESSION['nom'] = $_POST['nom'];
			$_SESSION['prenom'] = $_POST['prenom'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['mobile'] = $_POST['mobile'];
			$_SESSION['adresse'] = $_POST['adresse'];
			$_SESSION['CP'] = $_POST['CP'];
			$_SESSION['ville'] = $_POST['ville'];
			$_SESSION['domaine'] = $_POST['domaine'];
			$_SESSION['raison_soc'] = $_POST['raison_soc'];
			$_SESSION['nom_etablissement']= $_POST['nom_etablissement'];
			$_SESSION['adresse_etablissement']=$_POST['adresse_etablissement'];
			$_SESSION['cp_etablissement']=$_POST['cp_etablissement'];
			$_SESSION['ville_etablissement']=$_POST['ville_etablissement'];
			
//recuppération des variable du formulaire en cas de redirection 
			$le_nom=$_POST['nom'];
			$le_prenom=$_POST['prenom'];
            $l_email=$_POST['email'];
            $le_mobile=$_POST['mobile'];
            $l_adresse=$_POST['adresse'];
            $le_cp=$_POST['CP'];
            $la_ville=$_POST['ville'];
			$le_domaine = $_POST['domaine']; //.'&domaine='.$le_domaine.'&raison_soc='.$la_raison_soc.'&nom_etabilssement='.$le_nom_etabilssement.'&adresse_etabilssement='.$l_adresse_etabilssement.'&cp_etabilssement='.$le_cp_etabilssement.'&ville_etabilssement='.$la_ville_etabilssement
			$la_raison_soc = $_POST['raison_soc']; 
			$le_nom_etablissement= $_POST['nom_etablissement'];
			$l_adresse_etablissement=$_POST['adresse_etablissement'];
			$le_cp_etablissement=$_POST['cp_etablissement'];
			$la_ville_etablissement=$_POST['ville_etablissement'];

			//SI LE FICHIER A BIEN ETE UPLOADE
			if ($_FILES['rib']['error'] > 0){
                $erreur = "Erreur lors du transfert, nous vous redirigeons vers le formulaire";
                echo $erreur;
				header('Refresh: 3; formulaire.php?nom='.$le_nom.'&prenom='.$le_prenom.'&email='.$l_email.'&adresse='.$l_adresse.'&CP='.$le_cp.'&ville='.$la_ville.'&mobile='.$le_mobile.'&domaine='.$le_domaine.'&raison_soc='.$la_raison_soc.'&nom_etablissement='.$le_nom_etablissement.'&adresse_etablissement='.$l_adresse_etablissement.'&cp_etablissement='.$le_cp_etablissement.'&ville_etablissement='.$la_ville_etablissement);
				}
            else{
               
               //TAILLE MAX
                if ($_FILES['rib']['size'] > $_POST['MAX_FILE_SIZE']){
                    $erreur = "Le fichier est trop volumineux, nous vous redirigeons vers le formulaire";
                    echo $erreur;
					header('Refresh: 3; formulaire.php?nom='.$le_nom.'&prenom='.$le_prenom.'&email='.$l_email.'&adresse='.$l_adresse.'&CP='.$le_cp.'&ville='.$la_ville.'&mobile='.$le_mobile.'&domaine='.$le_domaine.'&raison_soc='.$la_raison_soc.'&nom_etablissement='.$le_nom_etablissement.'&adresse_etablissement='.$l_adresse_etablissement.'&cp_etablissement='.$le_cp_etablissement.'&ville_etablissement='.$la_ville_etablissement);
					}
                else{
                    
                    
                    //DIMMENSION DE L'IMAGE
                    $image_sizes = getimagesize($_FILES['rib']['tmp_name']);
                    if ($image_sizes[0] > 2500 OR $image_sizes[1] > 3600){
                        $erreur = "Image trop grande, nous vous redirigeons vers le formulaire";
                        echo $erreur;}
                    else{
                        
                      //TYPE DU FICHIER 
                        $type_autorise = array('jpg', 'jpeg', 'png', 'pdf');
                        //1. strrchr renvoie l'extension avec le point (« . »).
                        //2. substr(chaine,1) ignore le premier caractère de chaine.
                        //3. strtolower met l'extension en minuscules.
                        $extension_upload = strtolower(  substr(  strrchr($_FILES['rib']['name'], '.')  ,1)  );
                        if ( in_array($extension_upload,$type_autorise) ){
                            echo " Extension correcte";
                            
                            //DEPLCEMENT DU FICHIER DANS /doc_client/ 
                            //1.création du nouveau nom du fichier : _RIB_DateHeureSecondeIntialsnomPrenom
                            $fichier_nom = '_RIB_'.date("dmYHis").substr($_POST['nom'], 0, 3).$_POST['prenom'].'.'.$extension_upload;
                            //2. Chemain du dossier
                            $chemain = "doc_client/{$fichier_nom}";
                            //2.déplacer le fichier du répertoire temporaire vers le dossier de destination
                            $transfert = move_uploaded_file($_FILES['rib']['tmp_name'],$chemain);
                            if ($transfert) {
                                //echo " Transfert réussi";
                                header('location: sign_src/my_sign.php');
                            }
                            else{
								echo " Echec du transfert, nous vous redirigeons vers le formulaire";
								header('Refresh: 3; formulaire.php?nom='.$le_nom.'&prenom='.$le_prenom.'&email='.$l_email.'&adresse='.$l_adresse.'&CP='.$le_cp.'&ville='.$la_ville.'&mobile='.$le_mobile.'&domaine='.$le_domaine.'&raison_soc='.$la_raison_soc.'&nom_etablissement='.$le_nom_etablissement.'&adresse_etablissement='.$l_adresse_etablissement.'&cp_etablissement='.$le_cp_etablissement.'&ville_etablissement='.$la_ville_etablissement);
							}
                            
                        }

                        else{
                            echo" Extension incorecte, veillez re-envoyer un fichier (png ou jpg ou jpeg ou pdf), nous vous redirigeons vers le formulaire";
                            header('Refresh: 3; formulaire.php?nom='.$le_nom.'&prenom='.$le_prenom.'&email='.$l_email.'&adresse='.$l_adresse.'&CP='.$le_cp.'&ville='.$la_ville.'&mobile='.$le_mobile.'&domaine='.$le_domaine.'&raison_soc='.$la_raison_soc.'&nom_etablissement='.$le_nom_etablissement.'&adresse_etablissement='.$l_adresse_etablissement.'&cp_etablissement='.$le_cp_etablissement.'&ville_etablissement='.$la_ville_etablissement);
                        }  
                        
                    }
                    
                    
                    
                }
                
            }
			
?>