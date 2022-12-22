<?php 
    session_start();
    include "conexao.php"; 
    $username = $_SESSION['username']; 
    $id = $_POST['venda_id']; 
    $descricao = $_POST['descCampo']; 
    $quantidade = $_POST['qtdCampo']; 
    $valor = $_POST['valorCampo']; 
    $data = $_POST['dataCampo'];
    $local = $_POST['localCampo']; 

    $sql = "UPDATE venda SET descricao=:DESCRICAO, quantidade=:QUANTIDADE, valor=:VALOR,
    data=:DATA, local=:LOCAL WHERE id= :ID AND username=:USERNAME"; 

    $stmt = $pdo -> prepare($sql); 
    $stmt -> bindParam(":USERNAME", $username);
    $stmt -> bindParam(":ID", $id); 
    $stmt -> bindParam(":DESCRICAO", $descricao); 
    $stmt -> bindParam(":QUANTIDADE", $quantidade); 
    $stmt -> bindParam(":VALOR", $valor); 
    $stmt -> bindParam(":DATA", $data); 
    $stmt -> bindParam(":LOCAL", $local); 
    $stmt -> execute(); 

    if($stmt -> rowCount() > 0) {
        echo "<script> alert('venda alterada com sucesso') </script>";
        header('location: ../front/painel.php'); 
    }
?>