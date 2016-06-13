<?php if($action=="register"){
  ?>
  <div class="login-register">
  <form class="register" action="index.php" method="post">
    <h1>Register</h1>
    <p>
      <input name="login_register" type="text" placeholder="Identifiant"/>
    </p>
    <p>
    <input name="email_register" type="email" placeholder="Adresse mail"/>
  </p>
  <p>
    <input name="password_register" type="password" placeholder="Password"/>
  </p>
  <p>
    <input type="submit" class="register_button" value="Register">
  </p>
  </form>
  </div>
<?php
  }
  else{
?>
    <div class="login-register">
      <h1>Connexion</h1>
      <?php
      if (isset($errorLogin) && $errorLogin) {
    		echo '<p class="error">Login ou mot de passe incorrect</p>';
    	}
      ?>
    <form class="login" action="index.php" method="post">
      <p>
        <input name="login" type="text" placeholder="Login"/>
      </p>
      <p>
        <input name="password" type="password" placeholder="Password"/>
      </p>
      <p>
        <input type="submit" class="connect_button" value="Se connecter">
      </p>
    </form>
    </div>
    <div class="login-register">
      <a class="register_button" href="index.php?action=register">S'inscrire</a>
    </div>

<?php
 }
