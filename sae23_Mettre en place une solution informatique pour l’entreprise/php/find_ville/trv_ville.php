<!------------------------------------------------------------>
<!-- Code Permettant de trouver les données de chaque ville -->
<!------------------------------------------------------------>
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
  Nous allon executer la requete qui dit "Selectionner TOUT de la TABLE Villes QUAND le nom de la ville correspant à ce qui va étre ecrit sur la barre de recherche
  OU QUAND la longitude correspant à ce qui va étre ecrit sur la barre de recherche
  OU QUAND la latitude correspant à ce qui va étre ecrit sur la barre de recherche 
*/
$stmt = $pdo->prepare("SELECT * FROM `Villes` WHERE `nville` LIKE ? OR `longitude` LIKE ? OR `latitude` LIKE ?");
$stmt->execute(["%".$_POST["search"]."%", "%".$_POST["search"]."%", "%".$_POST["search"]."%"]);   //Requête en utilisant plutôt des marqueurs interrogatifs (sous la forme  de '?')
/* 
  Ici nous avons plusieur "%".$_POST["search"]."%", nous devons en mettre un à chaque type de recherche, 
  ici dans la barre de recherche nous pouvons tapper le nom de la ville, la longitute ou bien la latitude
  Ce qui nous fait un Total de 3 type de recherche, nous avons donc 3 "%".$_POST["search"]."%" 
*/
$results = $stmt->fetchAll();         //Recuperation des données et affichage
if (isset($_POST["ajax"])) { echo json_encode($results); }
