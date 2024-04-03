<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudphpnat";

$connexion = new mysqli($servername, $username, $password, $dbname);

$sql = "DELETE FROM client WHERE id=$id";
$connexion->query( $sql );  // on execute la requête SQL
}
header("location: /crudphpnat/index.php");
?>