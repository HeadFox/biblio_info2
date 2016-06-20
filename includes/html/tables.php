<?php
defined('APP') or die;
/**
 * Récupére le nom de l'auteur à partir de son id
 * @param $id
 * @return string
 */

function get_auteur($id,$connect){
  $sql="SELECT nom FROM auteur WHERE id=$id";
  $result = mysqli_query($connect, $sql);
  $object = mysqli_fetch_object($result);
  $final = $object->nom;
  return $final;
}
 if( $action=="auteur" && $method=="delete" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){

   if(isset($confirm) && $confirm=="yes"){
     $sql="DELETE FROM livre WHERE id_auteur=$id";
     mysqli_query($connexion, $sql);
     $sql="DELETE FROM auteur WHERE id=$id";
     mysqli_query($connexion, $sql);
   }
   if(empty($confirm) && $action == "auteur"){
     ?>
     <div class="alert">
       <h1>Voulez-vous réelement supprimer cet auteur et tout les livres qui lui sont associés ?</h1>
       <?php
       echo '<a href="index.php?action=auteur&method=delete&id='.$id.'&confirm=no">NO</a>';
       echo '<a href="index.php?action=auteur&method=delete&id='.$id.'&confirm=yes">YES</a>';
       ?>
     </div>
    <?php
   }
 }
 elseif($action=="editeur" && $method=="delete" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){
   if(isset($confirm)){
     $sql="DELETE FROM editeur WHERE id=$id";
     mysqli_query($connexion, $sql);
   }
 }
 elseif($action=="livre" && $method=="delete" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){
   if(isset($confirm)){
     $sql="DELETE FROM livre WHERE id=$id";
     mysqli_query($connexion, $sql);
   }
 }
 if($action=="livre" && $method=="edit" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){
 	$sql = "SELECT titre, description, couverture, date_publication FROM livre WHERE id=$id";
 	$sqlResult 	= mysqli_query($connexion, $sql);
 	$livre_edit 		= mysqli_fetch_assoc($sqlResult);
 	if (isset($livre_edit) && $livre_edit) {
 		?>
 		<div class="user_edit" id="user_edit">
 			<form method="post" action="index.php" enctype="multipart/form-data">
 				<a href="#"class="quit"><i class="material-icons">close</i></a>
 				<h1> Edit Book </h1>
 				<input name="action2" type="hidden" value="livre"/>
 				<input name="id_update" type="hidden" value='<?php echo $id ?>'/>
 				<p>
 					<input name="titre_update" type="text" value="<?php echo $livre_edit['titre']?>"/>
 				</p>
 				<p>
 				<textarea name="description_update" rows="10" cols="70"><?php echo $livre_edit['description'] ?></textarea>
 			</p>
			<p>
        <input name="file_update" type="file" required/>
		</p>
 			<p>
 				<input name="date_update" type="date" value="<?php echo $livre_edit['date_publication']?>"/>
 			</p>
 			<p>
 				<input type="submit" class="register_button" value="Update">
 			</p>
 			</form>
 		</div>
 		<?php
 	}
 }
 if($action=="editeur" && $method=="edit" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){
 	$sql = "SELECT nom FROM editeur WHERE id=$id";
 	$sqlResult 	= mysqli_query($connexion, $sql);
 	$editeur_edit = mysqli_fetch_assoc($sqlResult);
 	if (isset($editeur_edit) && $editeur_edit) {
 		?>
 		<div class="user_edit" id="user_edit">
 			<form method="post" action="index.php">
 				<a href="#"class="quit"><i class="material-icons">close</i></a>
 				<h1> Edit editeur </h1>
 				<input name="action2" type="hidden" value="editeur"/>
 				<input name="id_update" type="hidden" value='<?php echo $id ?>'/>
 				<p>
 					<input name="nomediteur_update" type="text" value="<?php echo $editeur_edit['nom']?>"/>
 				</p>
 			<p>
 				<input type="submit" class="register_button" value="Update">
 			</p>
 			</form>
 		</div>
 		<?php
 	}
 }
 if($action=="auteur" && $method=="edit" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){
 	$sql = "SELECT nom, prenom, date_naissance FROM auteur WHERE id=$id";
 	$sqlResult 	= mysqli_query($connexion, $sql);
 	$auteur_edit 		= mysqli_fetch_assoc($sqlResult);
 	if (isset($auteur_edit) && $auteur_edit) {
 		?>
 		<div class="user_edit" id="user_edit">
 			<form method="post" action="index.php">
 				<a href="#"class="quit"><i class="material-icons">close</i></a>
 				<h1> Edit Book </h1>
 				<input name="action2" type="hidden" value="auteur"/>
 				<input name="id_update" type="hidden" value='<?php echo $id ?>'/>
 				<p>
 					<input name="nom_update" type="text" value="<?php echo $auteur_edit['nom']?>"/>
 				</p>
				<p>
					<input name="prenom_update" type="text" value="<?php echo $auteur_edit['prenom']?>"/>
				</p>
 				   <input name="date_n_update" type="date" value='<?php echo $auteur_edit['date_naissance']?>'/>
 			</p>
 			<p>
 				<input type="submit" class="register_button" value="Update">
 			</p>
 			</form>
 		</div>
 		<?php
 	}
 }

 /**
  * Affiche un tableau php sous forme de table html
  * @param $array,$type
  * @return html
  */
function getHtmlTable($array,$type,$connexion)
{
	$table = '<table class="contenu">';
	if($type=="livre"){
		$table.= '<tr><td>ID</td><td class="table_idauteur">Auteur(ID)</td><td class="table_idediteur">ID Editeur</td><td class="table_titre">Titre</td><td>Description</td><td>Couverture</td><td class="table_date">Date de publication</td>';
    if($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1){
      $table.='<td class="table_action">Action</td>';
    }
    $table.='</tr>';
	}
	elseif($type=="auteur" || $type==""){
		$table.= '<tr><td>ID</td><td>Nom</td><td>Prénom</td><td class="table_date">Date de naissance</td>';
    if($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1){
      $table.='<td class="table_action">Action</td>';
    }
    $table.='</tr>';
	}
  elseif ($type=="editeur") {
    $table.= '<tr><td>ID</td><td>Nom</td>';
    if($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1){
      $table.='<td class="table_action">Action</td>';
    }
    $table.='</tr>';
  }
	foreach ($array as $item)
	{
		$table.= "<tr>";
		foreach ($item as $key=>$value) {
      if($key=="couverture"){
        $couv = str_replace(' ', '%20',"$value");
        $table.="<td><img width='100px' src='./$couv' alt='$couv'></a></td>";
      }
      elseif($key=="id_auteur"){
        $nom_auteur = get_auteur($value,$connexion);
        $table.='<td><a id="show_book" href="index.php?action='.$type.'&method=show_book&id='.$value.'"">'.$nom_auteur.'('.$value.')</a></td>';
      }
      else{
        $table.= "<td>".$value."</td>";
      }
		}
		if($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1){
			$table.='<td><a id="edit" href="index.php?action='.$type.'&method=edit&id='.$item['id'].'""><i class="material-icons orange">mode_edit</i><a>';
			$table.='<a href="index.php?action='.$type.'&method=delete&id='.$item['id'].'""><i class="material-icons red">delete</i><a></td>';
		}
		$table.= "</tr>";
	}
	$table.= "</table>";
	return $table;
}
?>
<?php if($action=="livre" && ($_SESSION['user']['niveau'] == 0 || $_SESSION['user']['niveau'] == 1)){ ?>
<div class="user_edit add_livre" id="user_edit">
<form method="post" action="index.php" enctype="multipart/form-data">
  <a href="#"class="quit"><i class="material-icons">close</i></a>
  <h1> Add <?php echo $action ?> </h1>
  <input name="action2" type="hidden" value="livre" required/>
  <p>
    <input name="titre_register" type="text" placeholder="Titre du livre" required/>
  </p>
  <p>
    <?php
      $sql = "SELECT id,nom, prenom FROM auteur";
      $sqlResult 	= mysqli_query($connexion, $sql);
      $rowCount   = mysqli_num_rows($sqlResult);
      if ( isset($rowCount) && $rowCount )  {
        $select = '<select name="id_auteur_register">';
        while($row = mysqli_fetch_assoc($sqlResult))
        {
        	$select.= '<option value='.$row['id'].'>'.$row['nom'].'&nbsp'.$row['prenom'].'</option>';
        }
        $select.= "</select>";
        echo $select;
      }
    ?>
  </p>
  <p>
    <?php
      $sql = "SELECT id,nom FROM editeur";
      $sqlResult 	= mysqli_query($connexion, $sql);
      $rowCount   = mysqli_num_rows($sqlResult);
      if ( isset($rowCount) && $rowCount )  {
        $select = '<select name="id_editeur_register">';
        while($row = mysqli_fetch_assoc($sqlResult))
        {
        	$select.= '<option value='.$row['id'].'>'.$row['nom'].'</option>';
        }
        $select.= "</select>";
        echo $select;
      }
    ?>
  </p>
  <p>
  <textarea name="description_register" rows="10" cols="70"></textarea>
</p>
<p>
  <input name="file_register" type="file" required/>
</p>
<p>
  <input name="date_register" type="date" required/>
</p>
<p>
  <input type="submit" class="register_button" value="Register">
</p>
</form>
</div>
<?php
  }
 if($action=="auteur"){ ?>
  <div class="user_edit add_auteur" id="user_edit">
  <form method="post" action="index.php">
    <a href="#"class="quit"><i class="material-icons">close</i></a>
    <h1> Add <?php echo $action ?> </h1>
    <input name="action2" type="hidden" value="auteur" required/>
    <p>
      <input name="nom_register" type="text" placeholder="Nom" required/>
    </p>
    <p>
      <input name="prenom_register" type="text" placeholder="Prénom" required/>
    </p>
  <p>
    <input name="date_n_register" type="date" required/>
  </p>
  <p>
    <input type="submit" class="register_button" value="Register">
  </p>
  </form>
  </div>
  <?php
    }
  if($action=="editeur"){ ?>
   <div class="user_edit add_editeur" id="user_edit">
   <form method="post" action="index.php">
     <a href="#"class="quit"><i class="material-icons">close</i></a>
     <h1> Add <?php echo $action ?> </h1>
     <input name="action2" type="hidden" value="editeur" required/>
     <p>
       <input name="nomediteur_register" type="text" placeholder="Nom" required/>
     </p>
   <p>
     <input type="submit" class="register_button" value="Register">
   </p>
   </form>
   </div>
   <?php
     }
?>
