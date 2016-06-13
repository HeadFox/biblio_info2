<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Info2</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="<?php if($action=="livre"){echo"active";}?>"><a href="index.php?action=livre">Livres</a></li>
        <li class="<?php if($action=="auteur"){echo"active";}?>"><a href="index.php?action=auteur">Auteurs</a></li>
        <li class="<?php if($action=="editeur"){echo"active";}?>"><a href="index.php?action=editeur">Editeur</a></li>
        <?php if($_SESSION['user']['niveau']==0){ ?>
        <li class="<?php if($action=="admin"){echo"active";}?>"><a href="index.php?action=admin">Admin</a></li>
        <?php } ?>
        <li><a href="index.php?action=logout">Se déconnecter</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
