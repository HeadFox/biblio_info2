<?php
$connexion	= mysqli_connect(SERVEUR, USER, PASSWORD, BDD);

// Check connection
if (mysqli_connect_errno())
{
	die("Impossible de se connecter:" . mysqli_connect_error());
}

mysqli_set_charset($connexion, 'utf8' );
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
