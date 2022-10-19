<!DOCTYPE html>          <!--Cette ligne nous permes d'eviter de passer en quirks mode lors du rendu d'un document-->
<html lang="fr">
<head>                   <!--La variable "head" c'est pour reperer l'entete du site, on y met tout les bases du site sans qu'il ne sois concretement visible sur le site (sauf pour le title et le favicon)-->
	<title>Accueil</title>                                                        <!-- Variable titre -->
  <meta charset="utf-8">                                                        <!-- L'encodage utf-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">        <!-- L'élément de métadonnées du document -->
	<link rel="stylesheet" type="text/css" href="../css/menu.css">                   <!-- Les suivantes 4 lignes sont des liaison pour le bon fonctionnement de mon site -->
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
  

  <link rel="icon" type="image/png" href="img/yasko_logo.png" />

</head>


<body>                                    <!-- A partir de cette variable jusqu'a sa fermeture, il y'aura tout le contenu du site-->

  <header>      <!--En tete-->
        <h1> Ajouter un étudiant  <br> <span class="redfamily">(Nom, prenom, groupe, ville)</span></h1>
    </header>

  <input type="checkbox" id="check_menu" >       <!-- La balise imput a la fonctionnalité de créer un contrôle interactif dans un formulaire web qui permet à l'utilisateur de saisir des données, dans mon cas sous forme de box -->
      <nav class="header">                               <!-- Nav est une balise destinée à la navigation, mais dans mon paragraphe cela concerne le menu burger -->
      	<div class="h-left">
      		<label for="check_menu">                       <!-- label c'est une legende ou bien une étiquette -->
      			<i class="fa fa-bars"></i>                   <!-- <i> représente un morceau de texte qui se différencie du texte principal (au lieu de <p>) -->
      		</label>
      	</div>
      </nav>

<div class="sidebar">                                    <!-- <div> est une balise qui permet de creer une division ou bien un conteneur, il ne change pas la mise en forme du site, sauf comme dans mon cas, j'ai rajoité une class pour crée une reference pour ensuite la modifier dans le css (stylesheet)-->
     <div class="sidebar_close">
        <img class="logo" src="img/yasko_logo.png" alt="Logo-Yassine">          <!-- La variable img nous permet d'inserer une image peut importe son format (png, jpg, jpeg,etc), il est utile de mettre un alt="" est mettre a l'interieur un texte qui va s'afficher en cas d'erreur-->
        <label for="check_menu"><i class="fa fa-close"></i></label>
     </div>
     
     <div class="nav-list">
		<a class="micon" href="index.html"><i class="fa fa-home ic"></i><span>Accueil</span> </a>     <!-- <a> cela permet de crée des lien, il y'a donc tres souvent un href="" qui va donc contenir le chemin du lien souhaité, cette explication est valable pour les 5 lignes suivantes-->
        <a class="micon" href="add_etudiant.php"><i class="fa fa-user-secret" aria-hidden="true"></i><span>Add Student</span></a>
		<a class="micon" href="find_student/form_student.php"><i class="fa fa-superpowers" aria-hidden="true"></i><span>Search student</span></a>
        <a class="micon" href="find_ville/form_ville.php"><i class="fa fa-book"></i><span>Search city</span></a>
        <a class="micon" href="find_groupe/form_groupe.php"><i class="fa fa-briefcase"></i><span>Search band</span></a>
        <a class="micon" href="find_all/form_principale.php"><i class="fa fa-archive"></i><span>Search Stu' data</span></a>
        <a class="micon" href="find_maxmin/form_maxmin.php"><i class="fa fa-bar-chart"></i><span>Search max' data</span></a>
        <a class="micon" href="../mode_emploie_search23.pdf" target="_blank"><i class="fa fa-user-circle-o"></i><span>Help</span></a>
        <br><br><br>   <!-- Cette ligne me permet de mettre a la ligne une variable, dans mon cas je l'ai utilisé plusieurs fois pour eviter de toucher à cela dans css -->
    </div>
</div>


<table>
			<tbody>

        <form action="add_etudiant.php" method="get">
            <p>Entrez le nom    : <input type="text" name="nom" /></p>
            <p>Entrez le prenom : <input type="text" name="prenom"/></p>
            <p>Entrez le groupe : <input type="text" name="groupe" /></p>
            <p>Entrez le ville  : <input type="text" name="ville" /></p>

            <p><input type="submit" value="OK"></p>
        </form>
			</tbody>
		</table>

        <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $bdd = 'sae23';

    //On établit la connexion
    $conn = mysqli_connect($servername, $username, $password, $bdd);

    //On vérifie la connexion
    if(!$conn){
        die('Erreur : ' .mysqli_connect_error());
    }
    echo 'Connexion réussie<br>';

    //var_dump($_GET);


      $query = "INSERT INTO etudiant (nome, prenom, groupe, ville) VALUE ('".$_GET['nome']."','".$_GET['prenom']."','".$_GET['groupe']."','".$_GET['ville']."')";
      echo $query;

      $result = mysqli_query($conn, $query);

      if ($result){
          echo "<br>BDD ok! <br>";
      }else{
          echo "BDD NO! <br>";
      }

?>
    
<footer>                                                          <!-- le pied de page -->

</footer>



</body>
</html>
