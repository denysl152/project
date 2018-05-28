<?php

/*
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=lrvl_demo;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM visite360');

while ($donnees = $reponse->fetch())
{
    echo $donnees['nom_client'] . $donnees['prenom_client'] . $donnees['email_client'] . '<br />';
}

$reponse->closeCursor();



*/




//récupération des variable enregistré dans SESSION
session_start();

//connexion à la base de données
/*
$link = mysqli_connect('127.0.0.1', 'root', 'root', 'lrvl_demo');
       
//code du message en cas d'erreur
if(!$link){
           die('La connexion a échoué ('.mysqli_connect_errno().')'.msqli_connect_error());
          }


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=lrvl_demo;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT nom, prix FROM jeux_video ORDER BY prix');

while ($donnees = $reponse->fetch())
{
	echo $donnees['nom'] . ' coûte ' . $donnees['prix'] . ' EUR<br />';
}

$reponse->closeCursor();
*/


//Préparation d'une req

//$insert = mysqli_prepare($link, "INSERT INTO commande VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
//mysqli_stmt_bind_param($insert, 'ssssssssssssd', $nom,$prenom,$email,$adr,$mobile_clt,$cp,$ville,$domaine,$nom_etablissement,$adr_etablissement,$ville_etablissement,$cp_etablissement,$date);

$nom=$_SESSION['nom'];
$prenom=$_SESSION['prenom'];
$email=$_SESSION['email'];
$adr=$_SESSION['adresse'];
$mobile_clt = $_SESSION['mobile'];
$cp=$_SESSION['CP'];
$ville=$_SESSION['ville'];
$domaine=$_SESSION['domaine'];
$nom_etablissement=$_SESSION['nom_etablissement'];
$adr_etablissement=$_SESSION['adresse_etablissement'];
$ville_etablissement=$_SESSION['ville_etablissement'];
$cp_etablissement=$_SESSION['cp_etablissement'];
$pack=$_SESSION['bouton_pack'];
$date = date("d/m/Y");

           
//Exécution de la req
//mysqli_stmt_execute($insert);

/*
|----------------------------------------
|CREATION DU PDF 
|----------------------------------------
*/


require('../../FPDF/fpdf.php');
         
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->Image('fond.png', null, null, 276, 178); //marge de gauche, marge du haut, largeur, hauteur 
$pdf->SetFont('Arial','B',11);


/*
|----------------------------------------
|TITULAIRE DU COMPTE
|----------------------------------------
*/
// NOM
$pdf->SetXY(28, -177.5);  //vers la droite(+) vers la gauche(-) , vers le haut(-) le bas(+)||a partir de 15 la col de droite et
$pdf->Cell(44,10, utf8_decode($_SESSION['nom']));

// PRENOM
$pdf->SetXY(87, -177.5);
$pdf->Cell(44,10, utf8_decode($_SESSION['prenom']));

// TEL
$pdf->SetXY(25, -168.8);  
$pdf->Cell(47,10, utf8_decode($_SESSION['mobile']));

// EMAIL
$pdf->SetXY(84, -168.8);
$pdf->Cell(47,10,utf8_decode($_SESSION['email']));

// ADRESSE POSTALE
$pdf->SetXY(16.8, -150.8);
$pdf->MultiCell(114.8,17,utf8_decode($_SESSION['adresse'])); //mettre ',1' ap le poste pour aff les bordure

//CODE POSTALE
$pdf->SetXY(38, -133.9);
$pdf->Cell(34,10,utf8_decode($_SESSION['CP']));

//RAISON SOCIALE
$pdf->SetXY(42, -160);
$pdf->Cell(92,10, utf8_decode($_SESSION['raison_soc']));//utf8_decode($_SESSION['raison_soc'])

// VILLE 
$pdf->SetXY(85, -133.9);
$pdf->Cell(48,10, utf8_decode($_SESSION['ville']));

/*
|----------------------------------------
|VOTRE NOM DE DOMAINE
|----------------------------------------
*/
//NOM DE DOMAINE
$pdf->SetXY(58, -113);
$pdf->Cell(73,10,utf8_decode($_SESSION['domaine']));//utf8_decode($_SESSION['domaine'])



/*
|------------------------------------------
|LE PACK CHOISI
|------------------------------------------
*/
$pdf->SetXY(136, -186);
//$pdf->MultiCell(142,65, $_SESSION['bouton_pack'],1); permet de tester la valeur des boutons "bouton_pack"

if ($pack =="PACK PRESENCE")
                    {
                        $pdf->Image('fond_pack_presence.png', 135, 25.5, 144, 62);
                    }
if ($pack =="PACK NEO")
                    {
                        $pdf->Image('fond_pack_neo.png', 135, 25, 144, 62);
                    }
if ($pack =="PACK BUSINESS")
                    {
                        $pdf->Image('fond_pack_business.png', 135, 26, 144, 62);
                    }





/*
|------------------------------------------
|ETABLISSEMENT TENEUR DU COMPTE A DEBITER
|------------------------------------------
*/
//NOM
$pdf->SetXY(146, -112.4);
$pdf->MultiCell(130,10, utf8_decode($_SESSION['nom_etablissement']));//utf8_decode($_SESSION['nom_etablissement'])

//ADRESSE
$pdf->SetXY(135, 110.7);
$pdf->MultiCell(80,11.5, utf8_decode($_SESSION['adresse_etablissement']));//utf8_decode($_SESSION['adresse_etablissement']) 

//CODE POSTALE
$pdf->SetXY(229, 106.7);
$pdf->Cell(48,10,utf8_decode($_SESSION['cp_etablissement']));//utf8_decode($_SESSION['cp_etablissement'])

// VILLE 
$pdf->SetXY(218, 115.8);
$pdf->Cell(60,10, utf8_decode($_SESSION['ville_etablissement']));//utf8_decode($_SESSION['ville_etablissement'])

//DATE
//affectation de la date courrente
$date_sign = date("d/m/Y");
$pdf->SetXY(148, 125.3);
$pdf->Cell(48,10, $date_sign);

//SIGNATURE
//recupération de l'image
$pdf->Image('doc_signs/'.$_SESSION['sig'].'.png',null, 134,81,16);

/* IMPORTANT : en cas de modification active la partie "//AFFICHAGE" et désactive la partie "RECEPTION DU PDF"
| PS: à la fin de ta modification n'ouble pas de ré-active la partie "RECEPTION DU PDF" et désactive la partie "//AFFICHAGE"*/

//RECEPTION DU PDF


//nom du pdf : _CMD_DateHeureSecondeIntialsnomPrenom
$pdf_nom = '_CMD_'.date("dmYHis").substr($_SESSION['nom'], 0, 3).$_SESSION['prenom'].'.pdf';
//forçage du téléchargement côté client
$pdf->Output('D',$pdf_nom,true);
//enregistrement dans le dossier doc_client
$pdf->Output('F','doc_client/'.$pdf_nom,true);

$pdf->Close();



//AFFICHAGE
//$pdf->Output();




?>
