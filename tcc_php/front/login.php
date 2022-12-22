<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegCycle</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">

    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="../style/form.css">
</head>

<body>
    <h1>RegCycle</h1>

    <form action="login.php" method="POST" class="formulario">
        <!-----------
    	<c:if test="${operacao == 'cadastrada'}">
    		<p class="sucesso"><i class="fas fa-check"></i> Cadastrado(a)! Você pode entrar agora.</p>
    	</c:if>
	    
	    <c:if test="${status != null}"> 
			
			<p class="falha"> <i class="fas fa-times"></i> Login ou senha incorretos!</p>
			
		</c:if>
		
		<c:if test="${sessaoexpirou != null}"> 
			
			<p class="falha"> <i class="fas fa-times"></i> A sessão expirou. Entre novamente.</p>
			
		</c:if>
        --------------->
        <h3>Entrar</h3>
        
        <div class="linha field">
            <label for="usernameId">Nome de usuário: </label>
            <input type="text" name="usernameCampo" id="usernameId" required>
        </div>

        <div class="linha field">
            <label for="senhaId">Senha: </label>
            <input type="password" name="senhaCampo" id="senhaId" required>
        </div>

        <div class="linha entrar">
            <input type="submit" value="Entrar" class="botaotofill-azul botao">
        </div>

        <div class="links">
        	<p>Não tem uma conta? <a href="cadastro.php">Cadastre-se agora!</a></p>
        	
            <a href="index.html"><i class="fas fa-arrow-left"></i> Voltar para a home</a>
            
        </div>
    </form>
</body>

<?php 
    include "../back/conexao.php"; 

    if(isset($_POST['usernameCampo']) && isset($_POST['senhaCampo'])) {
     
        $username = $_POST['usernameCampo']; 
        $senha = $_POST['senhaCampo'];

        $res_username = "SELECT * FROM usuario WHERE username = :USERNAME";

        $stmt = $pdo->prepare($res_username); 
        $stmt -> bindParam(":USERNAME", $username); 
        $stmt -> execute();

        $res_senha = "SELECT * FROM usuario WHERE senha = :SENHA";

        $stmt1 = $pdo -> prepare($res_senha); 
        $stmt1 -> bindParam(":SENHA", $senha); 
        $stmt1 -> execute();

         if($stmt -> rowCount() == 0 || $stmt1 -> rowCount() == 0) {
            echo "username e/ou senha incorretos";
            return;
        }
 
        $usuario = $stmt -> fetch(PDO::FETCH_ASSOC); 

        session_start();

        //usuario
        $_SESSION['username'] = $usuario ['username']; 
        $_SESSION['nome'] = $usuario['nome']; 
        $_SESSION['telefone'] = $usuario['telefone'];

        header('location: ../front/painel.php');
    }

?>
</html>