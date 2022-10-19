<!------------------------------------------------------------------------------------>
<!-- Code Permettant de trouver la logitude et la latitude max/min de chaque groupe -->
<!------------------------------------------------------------------------------------>
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
  Nous allon executer la requete qui dit "Selectionner le maximumm de la colonne (longitude) AS longitude_max, le minimum de la colonne(longitude) AS longitude_min, le maximumm de la colonne(latitude) AS latitude_max, 
  le minimum de la colonne (latitude) AS latitude_min, groupe de la TABLE etudiant et Villes QUAND la colonne ville de la table etudiant et la colonne nville 
  de la table Villes elle sont pareil ET QUAND le groupe correspant à ce qui va étre ecrit sur la barre de recherche
*/
$stmt = $pdo->prepare("SELECT MAX(longitude) AS longitude_max, MIN(longitude) AS longitude_min, MAX(latitude) AS latitude_max, MIN(latitude) AS latitude_min, groupe FROM etudiant, Villes WHERE etudiant.ville = Villes.nville AND groupe LIKE ?");
$stmt->execute(["%".$_POST["search"]."%"]);       //Requête en utilisant plutôt des marqueurs interrogatifs (sous la forme  de '?')
$results = $stmt->fetchAll();                     //Recuperation des données et affichage
if (isset($_POST["ajax"])) { echo json_encode($results); }
