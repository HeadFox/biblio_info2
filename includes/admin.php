<?php
if($_SESSION['user']['niveau'] == 0){
  if($action=="admin" && $method=="delete"){
    $sql="DELETE FROM utilisateur WHERE id=$id";
    mysqli_query($connexion, $sql);
  }
  if($action=="admin" && $method=="edit"){
    $sql = "SELECT identifiant, email, niveau FROM utilisateur WHERE id=$id";
    $sqlResult 	= mysqli_query($connexion, $sql);
    $user_edit 		= mysqli_fetch_assoc($sqlResult);
    if (isset($user_edit) && $user_edit) {
      ?>
      <div class="user_edit" id="user_edit">
        <form method="post" action="index.php">
          <a href="#"class="quit"><i class="material-icons">close</i></a>
          <h1> Edit User </h1>
          <input name="action2" type="hidden" value="admin"/>
          <p>
            <input name="login_update" type="text" value='<?php echo $user_edit['identifiant']?>'/>
          </p>
          <p>
          <input name="email_update" type="email" value='<?php echo $user_edit['email']?>'/>
        </p>
        <p>
          <input name="password_update" type="password" placeholder="New Password">
        </p>
        <p>
          <select name="level_update" class="level_register">
           <option value="0" <?php if($user_edit['niveau']=="0"){ echo "selected";} ?>>Administrateur</option>
           <option value="1" <?php if($user_edit['niveau']=="1"){ echo "selected";} ?>>Bibliotéquaire</option>
           <option value="2" <?php if($user_edit['niveau']=="2"){ echo "selected";} ?>>Lecteur</option>
         </select>
        </p>
        <p>
          <input type="submit" class="register_button" value="Update">
        </p>
        </form>
      </div>
      <?php
    }
  }
  $sql = "SELECT id,identifiant, email, niveau FROM utilisateur";
  $sqlResult 	= mysqli_query($connexion, $sql);
  $rowCount   = mysqli_num_rows($sqlResult);
  if ( isset($rowCount) && $rowCount )  {
    $table = '<table class="contenu">';
    $table.= '<tr><td>ID</td><td>Identifiant</td><td>Mail</td><td>Table</td><td>Action</td></tr>';
    while($row = mysqli_fetch_assoc($sqlResult))
    {
    	$table.= "<tr>";
    	foreach ($row as $value) {
    		$table.= "<td>".$value."</td>";
      }
      $table.='<td><a id="edit" href="index.php?action=admin&method=edit&id='.$row['id'].'"><i class="material-icons orange">mode_edit</i><a>';
      $table.='<a href="index.php?action=admin&method=delete&id='.$row['id'].'"><i class="material-icons red">delete</i><a></td>';
    	$table.= "</tr>";
    }
    $table.= "</table>";
    echo $table;
  }
  ?>
  <button class="register_button add_user"> Ajouter</button>
  <div class="user_edit add_user" id="user_edit">
  <form method="post" action="index.php">
    <a href="#"class="quit"><i class="material-icons">close</i></a>
    <h1> Add User </h1>
    <input name="action2" type="hidden" value="admin"/>
    <p>
      <input name="login_register" type="text" placeholder="Identifiant" required/>
    </p>
    <p>
    <input name="email_register" type="email" placeholder="Adresse mail" required/>
  </p>
  <p>
    <input name="password_register" type="password" placeholder="Password" required/>
  </p>
  <p>
    <select name="level_register" class="level_register">
     <option value="0">Administrateur</option>
     <option value="1">Bibliotéquaire</option>
     <option value="2">Lecteur</option>
   </select>
  </p>
  <p>
    <input type="submit" class="register_button" value="Register">
  </p>
  </form>
</div>
<?php
}
