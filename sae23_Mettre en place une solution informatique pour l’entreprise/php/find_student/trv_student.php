<!--------------------------------------------------------------->
<!-- Code Permettant de trouver les données de chaque étudiant -->
<!--------------------------------------------------------------->
<?php
// (A) Configuration de la connexion à la BDD
define("DB_HOST", "localhost");
define("DB_NAME", "yelhamio_03");
define("DB_CHARSET", "utf8");
define("DB_USER", "yelhamio");
define("DB_PASSWORD", "toto****");

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

//(C) Search (stmt = requete preparer)
/* 
  Nous allon executer la requete qui dit "Selectionner tout de la TABLE etudiant QUAND le prénom correspant à ce qui va étre ecrit sur la barre de recherche
  OU QUAND le nom correspant à ce qui va étre ecrit sur la barre de recherche
  OU QUAND le groupe correspant à ce qui va étre ecrit sur la barre de recherche
  OU QUAND la ville correspant à ce qui va étre ecrit sur la barre de recherche 
*/
$stmt = $pdo->prepare("SELECT * FROM `etudiant` WHERE `prenom` LIKE ? OR `nome` LIKE ? OR `groupe` LIKE ? OR `ville` LIKE ?");
$stmt->execute(["%".$_POST["search"]."%", "%".$_POST["search"]."%", "%".$_POST["search"]."%", "%".$_POST["search"]."%"]);   //Requête en utilisant plutôt des marqueurs interrogatifs (sous la forme  de '?')
/* 
  Ici nous avons plusieur "%".$_POST["search"]."%", nous devons en mettre un à chaque type de recherche, ici dans la barre de recherche nous pouvons tapper le prenom le nom, le groupe ou bien la ville
  Ce qui nous fait un Total de 4 type de recherche, nous en avons donc 4 "%".$_POST["search"]."%" 
*/
$results = $stmt->fetchAll();             //Recuperation des données et affichage
if (isset($_POST["ajax"])) { echo json_encode($results); }
