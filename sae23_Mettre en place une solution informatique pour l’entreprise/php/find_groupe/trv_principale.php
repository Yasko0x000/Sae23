<!----------------------------------------------------------------------->
<!-- Code Permettant de trouver les données groupe la ville principale -->
<!----------------------------------------------------------------------->
<?php
// (A) Configuration de la connexion à la BDD
define("DB_HOST", "localhost");                       //Nous sommes en local host puisque le site est dans le meme serveur PHP
define("DB_NAME", "yelhamio_03");                     //Le nom correspand au nom de la BDD
define("DB_CHARSET", "utf8");                         //L'encodage en utf8
define("DB_USER", "yelhamio");                        //Le nom correspand a mon psedo ENT
define("DB_PASSWORD", "toto****");                    //Le mdp est modifiable depuis l'interface du rt-serv

// (B) Connexion à la BDD
try {
  $pdo = new PDO(
    "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
    DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }

// (C) Search (stmt = requete preparer)
/* 
  Nous allon executer la requete qui dit "Selectionner la COLONNE prenom, nome, groupe, ville, nville, longitude, latitude de la TABLE etudiant et Villes QUAND la colonne ville de la table 
  etudiant et la colonne nville de la table Villes elle sont pareil ET QUAND le prénom correspant à ce qui va étre ecrit sur la barre de recherche
*/
$stmt = $pdo->prepare("SELECT  prenom, nome, groupe, ville, nville, longitude, latitude FROM etudiant, Villes WHERE etudiant.ville = Villes.nville AND groupe LIKE ?");
$stmt->execute(["%".$_POST["search"]."%"]);       //Requête en utilisant plutôt des marqueurs interrogatifs (sous la forme  de '?')              
$results = $stmt->fetchAll();                     //Recuperation des données et affichage
if (isset($_POST["ajax"])) { echo json_encode($results); }
