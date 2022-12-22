<!----------------------------
<%!
	DateTimeFormatter dtf_data = DateTimeFormatter.ofPattern("dd/MM/yyyy");
	LocalDateTime now = LocalDateTime.now();
	String data = dtf_data.format(now);
	
	DateTimeFormatter dtf_hora = DateTimeFormatter.ofPattern("HH");
	String hora = dtf_hora.format(now);
	String hora_dia = horaDoDia(Integer.parseInt(hora));
	
	public String horaDoDia(int horario) {
		String msg = "";
		if (horario >= 00) {
			msg = "Boa madrugada";
		}
		
		if (horario >= 06) {
			msg = "Bom dia";
		}
		
		if (horario >= 12) {
			msg = "Boa tarde";
		}
		
		if (horario >= 18) {
			msg = "Boa noite";
		}
		
		return msg;
	}
	
%>
--------------------------->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do usuário</title>

    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/painel.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    
    <style>
    	
    </style>
</head>
<?php 
    session_start();
    
    if(!isset($_SESSION['username'])) {
        header('location: login.html');
        return;
    } 
?>

<body>
	<!--CALCULANDO O TOTAL DAS VENDAS -->
    <!--------------
	<c:set var="total"/>
				
	<div style="display: none;">
		<c:forEach var="vendas" items="${usuario.vendas}">
			${total = total + vendas.valor_venda}
		</c:forEach>
	</div>	
	<c:set var="data" value="<%=data%>"/>
	<c:set var="hora_dia" value="<%=hora_dia%>"/>
	-------------------->
	<nav class="navbar-mobile">
        <div class="perfil">
            <div class="foto">
                <i class="fas fa-user"></i>
                <!--<img src="" alt="perfil">-->
            </div>
            
            <p class="nome"><?php echo $_SESSION['username']; ?></p>

            <a class="botao sair botaotofill-cinza-vermelho" href="../back/logout.php"><i class="fas fa-sign-out-alt"></i> sair</a>
        </div>

        <div class="operacoes">
            <a class="botao botaofilled-verde" href="form_venda.php"><i class="fas fa-plus"></i> nova venda</a>
            <a class="botao botaofilled-verde" href="form_meta.html"><i class="fas fa-plus"></i> nova meta</a>
        </div>
    </nav>

	
	
    <div class="wrapper">
        <nav class="navbar-desktop">
            <div class="dia-desktop">
                <!--<p>${hora_dia}! Hoje é dia <b>${data}</b></p>-->
            </div>

            <div class="perfil">
                <div class="foto">
                    <i class="fas fa-user"></i>
                    <!--<img src="" alt="perfil">-->
                </div>
                
                <p class="nome"> <?php echo $_SESSION['username']; ?></p>
            </div>
    
            <div class="operacoes">
                <a class="botao botaofilled-verde" href="form_venda.php"><i class="fas fa-plus"></i> nova venda</a>
                <a class="botao botaofilled-verde" href="form_meta.jsp"><i class="fas fa-plus"></i> nova meta</a>
            </div>
			
			<a class="botao sair botaotofill-cinza-vermelho" href="../back/logout.php"><i class="fas fa-sign-out-alt"></i> sair</a>
        </nav>
    
    
    
        <div class="dia-mobile">
            <!--<p>${hora_dia}! Hoje é dia <b>${data}</b></p> -->
        </div>

        <div class="funcionalidades">
            <div class="minhasvendas">
                <h3 class="titulo">Minhas vendas</h3>
				<?php verVendas(); ?>
                <!-----------------
				<c:if test="${usuario.vendas.isEmpty()}">
					<div class="nenhumavenda">
	                    <p>Nenhuma venda foi registrada ainda...</p>
	
	                    <a class="botao-plus" href="form_venda.jsp"><i class="fas fa-plus"></i> Registrar uma venda</a>
	                </div>
				</c:if>
				-------------------->

                <div class="minhasmetas">
                <h3 class="titulo">MINHAS METAS</h3>
                <?php verMetas(); ?>
                

				
    <script>
    	function trocarVisCard() {
    		const botaoCard = document.querySelector("button.card");
    		const botaoTabela = document.querySelector("button.tabela");
    		
    		const tabela = document.querySelector("table.metas-t");
    		const tabela2 = document.querySelector("table.metas-2");
    		
    		const boxLegenda = document.querySelector("div.metas-legenda .tag div.normal");
    		
    		tabela.classList.replace("metas-t", "metas-c");
    		tabela2.classList.replace("metas-t", "metas-c");
    		
    		botaoCard.className = "card active";
    		botaoTabela.className = "tabela";
    		
    		boxLegenda.className = "box normal-c";
    	}
    	
    	function trocarVisTabela() {
    		const botaoCard = document.querySelector("button.card");
    		const botaoTabela = document.querySelector("button.tabela");
    		
    		const tabela = document.querySelector("table.metas-c");
    		const tabela2 = document.querySelector("table.metas-2");
    		
    		const boxLegenda = document.querySelector("div.metas-legenda .tag div.normal-c");
    		
    		tabela.className = "metas-t";
    		tabela2.className = "metas-t metas-2";
    		
    		botaoCard.className = "card";
    		botaoTabela.className = "tabela active";
    		
    		boxLegenda.className = "box normal";
    	}
    	
    	function metasNaoConcluidas() {
    		const botaoNC = document.querySelector("button.nao-concluidas");
    		const botaoC = document.querySelector("button.concluidas");
    		
    		const tabelaNaoConcluidas = document.querySelector("div.nao-concluidas");
    		const tabelaConcluidas = document.querySelector("div.concluidas");
    		
    		const legenda = document.querySelector("div.metas-legenda");
    		
    		botaoNC.className = "nao-concluidas active";
    		botaoC.className = "concluidas";
    		
    		tabelaNaoConcluidas.className = "nao-concluidas active";
    		tabelaConcluidas.className = "concluidas disable";
    		
    		legenda.className = "metas-legenda";
    		
    		trocarVisTabela();
    	}
    	
    	function metasConcluidas() {
    		const botaoNC = document.querySelector("button.nao-concluidas");
    		const botaoC = document.querySelector("button.concluidas");
    		
    		const tabelaNaoConcluidas = document.querySelector("div.nao-concluidas");
    		const tabelaConcluidas = document.querySelector("div.concluidas");
    		
    		const legenda = document.querySelector("div.metas-legenda");
    		
    		botaoNC.className = "nao-concluidas";
    		botaoC.className = "concluidas active";
    		
    		tabelaNaoConcluidas.className = "nao-concluidas disable";
    		tabelaConcluidas.className = "concluidas active";
    		
    		legenda.className = "metas-legenda disable";
    		
    		trocarVisTabela();
    	}
    </script>
</body>

<?php 
    function verVendas(){
        include '../back/conexao.php'; 
        $sql_vendas = "SELECT * FROM venda"; 

        $stmt = $pdo -> prepare($sql_vendas); 
        $stmt -> execute(); 

        if($stmt -> rowCount() == 0) {
            echo "<div class='nenhumavenda'>
            <p>Nenhuma venda foi registrada ainda...</p>

            <a class='botao-plus' href='form_venda.jsp'><i class='fas fa-plus'></i> Registrar uma venda</a>
        </div>";
        } else {
            echo "<table class='vendas'>
            <thead>
                <tr class='total'><th colspan='5'>TOTAL = R$</th></tr>
                <th>VENDA</th>
                <th>QTD.</th>
                <th>VALOR (R$)</th>
                <th>DATA</th>
                <th>LOCAL</th>
            </thead>
            
            <tbody>";
            
            while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                    echo "<td class='descricao'>". $row['descricao']. "</td>";
                    echo  "<td>" . $row['quantidade'] . "</td>"; 
                    echo  "<td>" . $row['valor'] . "</td>"; 
                    echo  "<td>" . $row['data'] . "</td>"; 
                    echo  "<td>" . $row['local'] . "</td>"; 
                    echo "<form method='GET' action='editar_venda.php'>";
                    echo "<td class='operacao'><button type='submit' class='editar'><i class='operacao fas fa-pen'></i></button> </td>";
                    echo "<input type='hidden' name='venda_id' value= $row[id]>
                    </form>";
                    echo "<form method='POST' action='excluir_venda.php'>";
                    echo "<td class='operacao'><button type='submit' class='remover'><i class='operacao fas fa-trash'></i></button></td>";
                    echo "<input type='hidden' name='venda_id' value= $row[id]>
                    </form>";
                    "</tr>";
            }
            echo "</tbody> </table>";

        }

    }
/******
    function verMetas(){
        include "../back/conexao.php"; 

        $sql = "SELECT * FROM meta"; 

        $stmt = $pdo -> prepare($sql); 
        $stmt -> execute(); 

        if ($stmt -> rowCount() == 0) {
            echo "<div class='nao-concluidas active'>
            <div class='nenhumameta'>
            <p>Nenhuma meta foi definida ainda...</p>
            <a class='botao-plus' href='form_meta.jsp'><i class='fas fa-plus'></i> Registrar uma meta</a>
            </div>"
        } else {
            echo "<table class='metas-t'>"; 
            echo "<thead>"; 
            echo "<th> META </th>"; 
            echo "<th> VALOR META (R$) </th>"; 
            echo "<th> INICIAR EM: </th>";
            echo "<th> TERMINAR EM: </th>"; 
            echo "</thead>" ;

            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
                echo "<tr class='metas-c'>";
                echo "<td class='descricao'>" . $row['descricao'] . "</td>";
            }
        }
    }

		                    <tbody>
		                    	<c:forEach var="metas" items="${usuario.metas}">
		                    		<c:if test="${metas.status == 0}">
		                    			<c:set var="cor" value="normal"/>
		                    			
		                    			<c:if test="${metas.expirada()}">
		                    				<c:set var="cor" value="expirada"/>
		                    			</c:if>
		                    			
		                    			<c:if test="${metas.quaseExpirada() && !metas.expirada()}">
		                    				<c:set var="cor" value="quase-expirada"/>
		                    			</c:if>
		                    			
		                    			<tr class="metas-c ${cor}">
		                    				<td class="descricao">${metas.descricao}</td>
		                    				<td class="t-remove c-break"></td>
				                            <td class="c-valormeta"><span class="t-remove">R$</span>${metas.valor_meta}</td>
				                            <td class="t-remove c-break"></td>
				                            
				                            <fmt:parseDate value="${metas.data_inicial}" pattern="yyyy-MM-dd" var="parsedDate2" type="date"/>
		                            		<fmt:formatDate value="${parsedDate2}" var="formatedDataInicial1" type="date" pattern="dd/MM/yyyy"/>
											<!-- <td class="data-i">${metas.data_inicial}</td> -->
											<td class="data-i">${formatedDataInicial1}</td>
											
											<td class="t-remove c-data-meio">-</td>
											
											<fmt:parseDate value="${metas.data_final}" pattern="yyyy-MM-dd" var="parsedDate2" type="date"/>
		                            		<fmt:formatDate value="${parsedDate2}" var="formatedDataFinal1" type="date" pattern="dd/MM/yyyy"/>
					                        <!-- <td class="data-f">${metas.data_final}</td> -->
					                        <td class="data-i">${formatedDataFinal1}</td>
					                        
				        					<form method="POST" action="ConcluirMetaController">
				        						<td class="operacao concluir"><button type="submit" name="operacao" value="concluir" class="check"><i class="fas fa-check"></i></button></td>
				        						<input type="hidden" name="meta_id" value="${metas.id}">
				        					</form>
				        					
				        					<form method="GET" action="EditarMetaController">
					                            <td class="operacao editar"><button type="submit" name="operacao" value="editar" class="editar"><i class="operacao fas fa-pen"></i></button> </td>
					                            <input type="hidden" name="meta_id" value="${metas.id}">
				                      		</form>
				                            
				                            <form method="POST" action="ExcluirMetasController">
				                            	<td class="operacao excluir"><button type="submit" name="operacao" value="excluir" class="remover"><i class="operacao fas fa-trash"></i></button></td>
				                            	<input type="hidden" name="meta_id" value="${metas.id}">
				                            </form>
		                    			
			                        	</tr>
    }
	******/


?>
</html>