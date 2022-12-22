<?php 
    $dsn = "mysql:host=localhost;dbname=regcycle;charset=utf8";
    $usuario = "root"; 
    $senha = ""; 

    try {
        $pdo = new PDO ($dsn, $usuario, $senha); 
    } catch(PDOException $erro) {
        echo json_encode(["mensagem" => "conexao com banco falhou"]); 
        exit(); 
    }

?>