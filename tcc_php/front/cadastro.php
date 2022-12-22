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
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../style/form.css">

</head>

<body>
    <h1>RegCycle</h1>

    <form action="cadastro.php" method="POST" class="formulario" onsubmit="return validar()">
    
        <!----------------------
    	<c:if test="${status != null}">
    	
    		<p class="falha"><i class="fas fa-times"></i> A senha n�o confere! </p>
    	
    	</c:if>
        ---------------------->

        <h3>Cadastrar</h3>

        <div class="linha field">
            <label for="nomeId">Nome: </label>
            <input type="text" name="nomeCampo" id="nomeId" required>
        </div>
        
        <div class="linha field">
            <label for="usernameId">Nome de usuário: </label>
            <input type="text" name="usernameCampo" id="usernameId" required>
        </div>

        <div class="linha field">
            <label for="telefoneId"> Telefone: </label> 
            <input type="tel" name="telefoneCampo" id="telefoneId" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" required>
        </div>

        <div class="linha field">
            <label for="senhaId">Senha: </label>
            <input type="password" name="senhaCampo" id="senhaId" required>
        </div>

        <div class="linha field">
            <label for="confirmaSenhaId">Confirme sua senha: </label>
            <input type="password" name="confirmarSenhaCampo" id="confirmaSenhaId" 
            onkeyup="verificarSenha(this)" required>
            <error id="alert"></error>
        </div> 

        <div class="linha entrar">
            <input type="submit" value="Cadastrar" class="botaotofill-azul botao">
        </div>

        <div class="links">
        	<p>Já tem uma conta? <a href="login.php">Entre agora!</a></p>
        	
            <a href="index.html"><i class="fas fa-arrow-left"></i> Voltar para a home</a>
        </div>
    </form>
</body>

<script> 

//MÁSCARA TELEOFNE
    function mask(o, f) {
    setTimeout(function() {
        var v = mphone(o.value);
        if (v != o.value) {
        o.value = v;
        }
    }, 1);
    }

    function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
        r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
        r = r.replace(/^(\d*)/, "($1");
    }
    return r;
    }

    var senha = document.getElementById('senhaId');
    var confere = 1; //se for 1 ñ tem erro, se for 0 tem erro

    function verificarSenha(confSenha) {
        if(confSenha.value.length > 0 ) {
            if(confSenha.value != senha.value) {
                document.getElementById("alert").innerText = "As senhas não conferem";
                confere = 0;
            } else {
                document.getElementById("alert").innerText = "";
                confere = 1; 
            }
        }
    }

    function validar() {
        if(confere == 1) {
            return true; 
        } else {
            return false;
        }
    }
</script>

<?php 
    include "../back/conexao.php"; 

    if(isset($_POST['nomeCampo']) && isset($_POST['usernameCampo']) && isset($_POST['telefoneCampo']) 
    && isset($_POST['senhaCampo'])) {

        

        $nome =  $_POST['nomeCampo']; 
        $username = $_POST['usernameCampo'];
        $telefone = $_POST['telefoneCampo']; 
        $senha = $_POST['senhaCampo'];

        verUsuarioCadastrado($pdo,$username); 

        cadastroUsuario($pdo, $username, $telefone, $nome, $senha);

    }


    function verUsuarioCadastrado($pdo,$username){
        $sql_verifica = "SELECT * FROM usuario WHERE username = :USERNAME"; 

        $stmt = $pdo->prepare($sql_verifica); 
        $stmt -> bindParam(":USERNAME", $username); 
        $stmt -> execute();

       if($stmt -> rowCount() > 0){
           echo "<script> alert('usuario ja cadastrado!'); </script>";
           return;
       }
       
    }

    function cadastroUsuario($pdo, $username, $telefone, $nome, $senha){
                
        $sql_create = "INSERT INTO usuario (username, telefone, nome, senha) VALUES 
        (:USERNAME, :TELEFONE, :NOME, :SENHA)";

        $stmt = $pdo -> prepare($sql_create); 
        $stmt -> bindParam(":USERNAME", $username); 
        $stmt -> bindParam(":TELEFONE" , $telefone); 
        $stmt -> bindParam(":NOME", $nome); 
        $stmt -> bindParam(":SENHA", $senha); 
        
        if($stmt -> execute()) {
            echo "<script> alert('usuario cadastrado com sucesso') </script>"; 
        } else {
            echo "<script> alert('erro ao cadastrar usuario') </script>"; 
        }

    }

?>      

</html>

