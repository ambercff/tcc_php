<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar venda</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">

    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/form.css">

</head>
<?php 
    include "../back/conexao.php";
    $id = $_GET['venda_id']; 

    $sql = "SELECT * FROM venda WHERE id = :ID"; 

    $stmt = $pdo -> prepare($sql); 
    $stmt -> bindParam(":ID", $id); 
    $stmt -> execute();

    $usuario = $stmt -> fetch(PDO::FETCH_ASSOC); 

    session_start(); 

    $_SESSION['data'] = $usuario['data']; 
    $_SESSION['local'] = $usuario['local']; 
    $_SESSION['quantidade'] =$usuario['quantidade']; 
    $_SESSION['valor'] = $usuario['valor']; 
    $_SESSION['descricao'] = $usuario['descricao']; 

    if(!isset($_SESSION['username'])) {
        header('location: login.html');
        return;
    }
 
?>
<body>
    <h1>RegCycle</h1>

    <form action="../back/alterar_venda.php" method="POST" class="formulario">
        <!--
            <p class="sucesso"><i class="fas fa-check"></i> Venda registrada com sucesso!</p>
            <p class="falha"><i class="fas fa-times"></i> Não foi possível cadastrar a venda</p>
        -->


        <h3>Editar venda</h3>

        <p>Reescreva as informações da venda de preferência abaixo.</p>
        
        <div class="linha field">
        	<label for="idId"></label>
        	<input type="hidden" name="venda_id" value="<?php echo $id ?>">
        </div>

        <div class="linha field">
            <label for="descId">Descrição da venda: </label>
            <input type="text" name="descCampo" id="descId" placeholder="Reciclável ou conjunto de recicláveis..." 
            value="<?php echo $_SESSION['descricao'] ?>" required>
        </div>
        
        <div class="linhaflex">
            <div class="linha field">
                <label for="qtdId">Quantidade: </label>
                <input type="number" name="qtdCampo" id="qtdId" value= "<?php echo $_SESSION['quantidade'] ?>">
            </div>

            <div class="sep"></div>

            <div class="linha field">
                <label for="valorId">Valor (R$): </label> 
                <input type="number" name="valorCampo" id="valorId" value="<?php echo $_SESSION['valor'] ?>" required>
            </div>
        </div>

        <div class="linha field">
            <label for="dataId">Data da venda: </label>
            <input type="date" name="dataCampo" id="dataId" value="<?php echo $_SESSION['data'] ?>" required>
        </div>

        <div class="linha field">
            <label for="localId">Local da venda: </label>
            <input type="text" name="localCampo" id="localId" placeholder="Rua, avenida, pontos de referência..." 
            value="<?php echo $_SESSION['local'] ?>" required>
        </div> 

        <div class="linha entrar">
            <input type="submit" value="Editar" class="botaotofill-azul botao">
        </div>

        <div class="links">
            <a href="painel.php"><i class="fas fa-arrow-left"></i> Voltar para o painel</a>
        </div>
    </form>
</body>
</html>