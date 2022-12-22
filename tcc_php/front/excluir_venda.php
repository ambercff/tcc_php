<?php 
include "../back/conexao.php";
session_start(); 
$username = $_SESSION['username']; 
$id = $_POST['venda_id'];

$sql = "DELETE FROM venda WHERE id=:ID AND username=:USERNAME"; 

$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(":ID", $id); 
$stmt -> bindParam(":USERNAME", $username); 
$stmt -> execute();

header('location: painel.php')
?>