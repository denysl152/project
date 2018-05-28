
//Coloration des champs
function surligne(champ, erreur)
{
    if(erreur)
    champ.style.backgroundColor = "#fba";
    else
    champ.style.backgroundColor = "";
}
 
 //vérification du champ mobile               
function verifMobile(champ)
{
    if(champ.value.length !=10)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

//verification du nom et du prénom
function verifNom(champ)
{
   if(champ.value.length < 3)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

//vérification des autres champ
function verifInput(champ)
{
   if(champ.value.length == 0)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

//véfification du rib
function verifRib(champ)
{
   if(champ.value == '')
   {
      surligne(champ, true);
      //alert("Exportez votre RIB sous fichier -pdfF ou jpg ou jpeg ou png- poids maximum autorisé 2Mo");
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

//vérification du champ de l'e-mail             
function verifMail(champ)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if(!regex.test(champ.value))
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}
/*
//pré vérificationavant l'envoie du formulaire              
function verifForm(f)
{
    
    var nomOk = verifNom(f.nom);
    var prenomOk = verifNom(f.prenom);
    var mobileOk = verifMobile(f.mobile);
    var mailOk = verifMail(f.email);
    var adresseOk = verifInput(f.adresse);
    var CPOk = verifInput(f.CP);
    var villeOk = verifInput(f.ville);
    var ribOk = verifRib(f.rib);
                   
    if(mobileOk && mailOk && nomOk && prenomOk && adresseOk && CPOk && villeOk && ribOk)
        return true;
    else
    {
        alert("Veuillez remplir correctement tous les champs obligatoires(*) et Exportez votre RIB sous fichier -pdfF ou jpg ou jpeg ou png- poids maximum autorisé 2Mo");
        return false;
    }
}