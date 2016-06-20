<?php
session_start();

// on inclus les variables statiques
require_once('includes/configuration.php');

// on récupère implicitement $connexion
require_once('includes/header.php');

// reception des variables get, post
$action2 	= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['action2']) ? $_POST['action2'] : NULL));
$action 	= htmlentities(mysqli_real_escape_string($connexion,isset($_GET['action']) ? $_GET['action'] : NULL));
$confirm 	= htmlentities(mysqli_real_escape_string($connexion,isset($_GET['confirm']) ? $_GET['confirm'] : NULL));
if($action2=="admin"){$action="admin";}
elseif ($action2=="livre") {$action="livre";}
elseif ($action2=="auteur") {$action="auteur";}
elseif ($action2=="editeur") {$action="editeur";}

$method = htmlentities(mysqli_real_escape_string($connexion,isset($_GET['method']) ? $_GET['method'] : NULL));
$id = htmlentities(mysqli_real_escape_string($connexion,isset($_GET['id']) ? $_GET['id'] : NULL));

$login 		= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['login']) ? $_POST['login'] : NULL)) ;
$password 	= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['password']) ? $_POST['password'] : NULL)) ;

//Enregistrement
$login_r		= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['login_register']) ? $_POST['login_register'] : NULL)) ;
$email_r		= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['email_register']) ? $_POST['email_register'] : NULL)) ;
$password_r 	= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['password_register']) ? $_POST['password_register'] : NULL ));
$level_r 	= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['level_register']) ? $_POST['level_register'] : NULL)) ;
$search 	= htmlentities(mysqli_real_escape_string($connexion, isset($_POST['search']) ? $_POST['search'] : NULL)) ;

//Add auteur
$nom_r   = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['nom_register']) ? $_POST['nom_register'] : NULL));
$prenom_r = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['prenom_register']) ? $_POST['prenom_register'] : NULL));
$date_n_r = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['date_n_register']) ? $_POST['date_n_register'] : NULL));

//Add editeur
$nom_e_r   = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['nomediteur_register']) ? $_POST['nomediteur_register'] : NULL));

//id commun à toute les éditions
$id_u       = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['id_update']) ? $_POST['id_update'] : NULL));

//Update editeur
$nom_e_u   = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['nomediteur_update']) ? $_POST['nomediteur_update'] : NULL));

//Add livre
$titre_r    = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['titre_register']) ? $_POST['titre_register'] : NULL));
$description_r = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['description_register']) ? $_POST['description_register'] : NULL));

//Récupération Image
if(isset($_FILES['file_register']) || isset($_FILES['file_update'])){
  if(isset($_FILES['file_update'])){
    $sql = "SELECT couverture FROM livre WHERE id=$id_u";
    $sqlResult = mysqli_query($connexion, $sql);
    $row = mysqli_fetch_assoc($sqlResult);

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file_update"]["name"]);
    // Check if file already exists
    if (file_exists($target_file)) {
        unlink("./".$row['couverture']);
    }
    $file_size = $_FILES["file_update"]["size"];
    $file_name = $_FILES["file_update"]["name"];
    $tmp_name    = $_FILES["file_update"]["tmp_name"];
  }
  else{
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file_register"]["name"]);
    $file_size = $_FILES["file_register"]["size"];
    $file_name = $_FILES["file_register"]["name"];
    $tmp_name    = $_FILES["file_register"]["tmp_name"];
  }
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($tmp_name);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check file size
  if ( $file_size > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($tmp_name, $target_file)) {
          echo "The file ". basename( $file_name). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}

$date_r = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['date_register']) ? $_POST['date_register'] : NULL));
$id_auteur_r = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['id_auteur_register']) ? $_POST['id_auteur_register'] : NULL));
$id_editeur_r = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['id_editeur_register']) ? $_POST['id_editeur_register'] : NULL));


//Mise a jour
$login_u		= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['login_update']) ? $_POST['login_update'] : NULL)) ;
$email_u		= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['email_update']) ? $_POST['email_update'] : NULL)) ;
$password_u 	= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['password_update']) ? $_POST['password_update'] : NULL)) ;
$level_u 	= htmlentities(mysqli_real_escape_string($connexion,isset($_POST['level_update']) ? $_POST['level_update'] : NULL)) ;

//Mise à jour du livre
$titre_u    = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['titre_update']) ? $_POST['titre_update'] : NULL));
$description_u = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['description_update']) ? $_POST['description_update'] : NULL));
$date_u = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['date_update']) ? $_POST['date_update'] : NULL));


//Mise à jour du auteur
$nom_u    = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['nom_update']) ? $_POST['nom_update'] : NULL));
$prenom_u = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['prenom_update']) ? $_POST['prenom_update'] : NULL));
$date_n_u = htmlentities(mysqli_real_escape_string($connexion,isset($_POST['date_n_update']) ? $_POST['date_n_update'] : NULL));

//Tentative d'Enregistrement
if($login_r && $email_r && $password_r ){
  $password_r=md5($password_r);
  if(isset($level_r) && isset($_SESSION['user']) && ($_SESSION['user']['niveau']==0)){
    $sql = "INSERT INTO utilisateur VALUES('','$login_r','$email_r','$password_r',$level_r)";
  }
  else{
    $sql = "INSERT INTO utilisateur VALUES('','$login_r','$email_r','$password_r',2)";
  }
  mysqli_query($connexion, $sql);
  if(mysqli_affected_rows($connexion)==1){
    echo "BRAVO";
  }
  else{
    echo "DOMMAGE";
  }
}

//Enregistrement editeur
if($nom_e_r){
  if($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1){
    $sql = "INSERT INTO editeur VALUES('','$nom_e_r')";
  }
  mysqli_query($connexion, $sql);
  if(mysqli_affected_rows($connexion)==1){
    echo "BRAVO";
  }
  else{
    echo "DOMMAGE";
  }
}

//Update editeur
if($nom_e_u){
  if($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1){
    $sql = "UPDATE editeur SET nom='$nom_e_u' WHERE id='$id_u'";
    mysqli_query($connexion, $sql);
    if(mysqli_affected_rows($connexion)==1){
      echo "BRAVO";
    }
    else{
      echo "DOMMAGE";
    }
  }
}

//Tentative d'Enregistrement d'un auteur
if($nom_r && $prenom_r && $date_n_r ){
  if($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1){
    $sql = "INSERT INTO auteur VALUES('','$nom_r','$prenom_r','$date_n_r')";
  }
  mysqli_query($connexion, $sql);
  if(mysqli_affected_rows($connexion)==1){
    echo "BRAVO";
  }
  else{
    echo "DOMMAGE";
  }
}

//Tentative d'Enregistrement d'un livre
if($titre_r && $id_auteur_r && $id_editeur_r && $description_r && $date_r ){
  if($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1){
    $sql = "INSERT INTO livre VALUES('','$id_auteur_r', '$id_editeur_r','$titre_r','$description_r','$target_file','$date_r')";
  }
  mysqli_query($connexion, $sql);
  if(mysqli_affected_rows($connexion)==1){
    echo "BRAVO";
  }
  else{
    echo "DOMMAGE";
  }
}
//Tentative de Mise à jour
if($login_u && $email_u){
  if(!empty($password_u)){
    $password_u=md5($password_u);
  }
  if($_SESSION['user']['niveau']==0){
    $sql = "UPDATE utilisateur SET identifiant='$login_u', niveau='$level_u', email='$email_u'";
    if(!empty($password_u)){
      $sql.=", mot_de_passe='$password_u'";
    }
    $sql.= "WHERE id='$id_u'";
  }
  mysqli_query($connexion, $sql);
  if(mysqli_affected_rows($connexion)==1){
    echo "BRAVO";
  }
  else{
    echo "DOMMAGE";
  }
}

//Tentative de mise à jour de livre
if($titre_u && $description_u && $date_u){
  if($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1){
    $sql = "UPDATE livre SET titre='$titre_u', description='$description_u',couverture='$target_file', date_publication='$date_u' WHERE id='$id_u'";
    mysqli_query($connexion, $sql);
    if(mysqli_affected_rows($connexion)==1){
      echo "BRAVO";
    }
    else{
      echo "DOMMAGE";
    }
  }
}

//Tentative de mise à jour de auteur
if($nom_u && $prenom_u && $date_n_u){
  if($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1){
    $sql = "UPDATE auteur SET nom='$nom_u', prenom='$prenom_u', date_naissance='$date_n_u' WHERE id='$id_u'";
    mysqli_query($connexion, $sql);
    if(mysqli_affected_rows($connexion)==1){
      echo "BRAVO";
    }
    else{
      echo "DOMMAGE";
    }
  }
}
// Tentative de login
if ($login && $password)
{
	$password = md5($password);
        $sql = "SELECT identifiant, email, niveau FROM utilisateur";
        $sql.= " WHERE identifiant = '$login' AND mot_de_passe = '$password' LIMIT 1";
        $sqlResult 	= mysqli_query($connexion, $sql);
        $user 		= mysqli_fetch_assoc($sqlResult);
        if (isset($user) && $user) {
        	$_SESSION['user'] = $user;
        } else {
        	$errorLogin = true;
        }
}


// Déconnexion utilisateur
if ($action == 'logout') {
	unset($_SESSION['user']);
	session_destroy();
}

// chargement des fonction de creation des requetes sql
require_once('includes/sql.php');

// inclusion de la fonction table
require_once('includes/html/tables.php');

// inclusion entete HTML + Styles
require_once('template/header.php');

if (isset($_SESSION['user']) && $_SESSION['user']) {
   // User connecté
  require_once('template/menu.php');
  ?><div class="full-page">
    <div class="search">
      <form action="index.php?action=<?php echo $action ?>" method="post">
          <input name="search" placeholder="rechercher" type="text"/>
          <button class="search_button" type="submit"><i class="material-icons">search</i></button>
      </form>
    </div>
    <?php
    if($action=="admin"){
      require_once('includes/admin.php');
    }
    else{
      if(isset($method) && $method=="show_book"){
        $sql = "SELECT * FROM livre WHERE id_auteur=$id";
        $sqlResult 	= mysqli_query($connexion, $sql);
        $rowCount   = mysqli_num_rows($sqlResult);
      }
      else{
        $sql      	= getSql($action, $search, $connexion);
      	$sqlResult 	= mysqli_query($connexion, $sql);
      	$rowCount   = mysqli_num_rows($sqlResult);
      }
    // affichage des resultats de la recherche utilisateur
  	if ( isset($rowCount) && $rowCount )  {
  	    while($row = mysqli_fetch_assoc($sqlResult))
  	    {
  	        $result[] 	= $row;
  	    }
  	    echo getHtmlTable($result,$action,$connexion);
  	} else {
  	    echo "pas de résultats";
  	}
    if($action==""){
      $action="auteur";
    }
    if(isset($method) && $method=="show_book"){
      echo '<a class="show_all" href="index.php?action=livre"> Afficher tout les livres</a>';
    }
    if(($action=="livre" || $action=="auteur" || $action=="editeur") && ($_SESSION['user']['niveau']==0 || $_SESSION['user']['niveau']==1)){
      echo '<button class="register_button add_'.$action.'"> Ajouter un '.$action.'</button>';
    }
  }
  ?></div><?php

} else { // User non connecté
  require_once('includes/login-register.php');
}

// Inclusion fin HTML
require_once('template/footer.php');

// Footer PHP - Ferme la connexion
require_once('includes/footer.php');
