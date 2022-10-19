<!--------------------------------------------------------------------------->
<!-- Code Permettant de trouver les données étudiantde la ville secondaire -->
<!--------------------------------------------------------------------------->
<?php
// Pas besoin de faire l'etape de configuration puisque cela est deja configurer dans le fichier trv_principale.php
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
  Nous allon executer la requete qui dit "Selectionner la COLONNE prenom, nome, groupe, ville, villeS, nville, longitude, latitude de la TABLE etudiant et Villes
  QUAND la colonne ville de la table etudiant et la colonne nville de la table Villes elle sont pareil ET QUAND le prénom correspant à ce qui va étre ecrit sur la barre de recherche
*/
$stmt = $pdo->prepare("SELECT  prenom, nome, groupe, ville, villeS, nville, longitude, latitude FROM etudiant, Villes WHERE etudiant.villeS = Villes.nville AND prenom LIKE ?");
$stmt->execute(["%".$_POST["search"]."%"]);                 //Requête en utilisant plutôt des marqueurs interrogatifs (sous la forme  de '?')
$results = $stmt->fetchAll();                               //Recuperation des données et affichage
if (isset($_POST["ajax"])) { echo json_encode($results); }
