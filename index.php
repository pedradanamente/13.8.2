<?php
include("config.php");
include("conexao.php");
include("classes/db.class.php");
	
$OO = new DB();
session_start();

// verifica e faz login
if (isset($_POST['button-entrar'])){
	if($_POST['senha']===$coruja){
		$_SESSION['oficina']=1;
	}
}
// verifica se esta com secao permitida
if(isset($_SESSION['oficina']) AND $_SESSION['oficina']=1){
	// --------------------------------------------
	// verifica se a url foi solicitada e define varivavel
	if(isset($_GET['page'])){
		$geturl=$_GET['page'];
		//verifica se valor da variavel existe no diretorio
		if(!file_exists("sessao/"."$geturl") OR $geturl==null){
			$geturl="novo.php";
		}
	}else{
		$_GET['page']="novo.php";
	}
	// --------------------------------------------
	// caso tenha clicado para finalizar um pedido
	if(isset($_GET["finalizar"])){
	$id_finalizar=$_GET['finalizar'];
	
	$finalizado="Finalizado";
	$sql = $conexao->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
	$sql->bind_param('si',$finalizado,$id_finalizar);
	$sql->execute();
	
	$_GET["pedido"]=$id_finalizar;
	}
	// --------------------------------------------
	// caso tenha clicado para apagar uma observação
	if(isset($_GET["observacao"])){
	$id_observacao=$_GET['observacao'];
	
	$observacao=null;
	$sql = $conexao->prepare("UPDATE pedidos SET observacao = ? WHERE id = ?");
	$sql->bind_param('ss',$observacao,$id_observacao);
	$sql->execute();
	
	$_GET["pedido"]=$id_observacao;
	}
	// --------------------------------------------
	// captura url para o detalhes de um pedido
	if (isset($_GET['pedido'])){
		$pedido=$_GET['pedido'];
		$geturl="detalhes.php";
	}else{

	}
	// --------------------------------------------
	?>
	
<!DOCTYPE html>
<!-- Inicio do Html -->
<html lang="pt-br">
	<!-- Inicio do cabeçalho -->
	<head>
		<meta charset="iso-8859-1">
		<title><?php echo "$titulo"; ?></title>
		<link rel="stylesheet" href="css/base-min.css" type="text/css" />
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />
		<link rel="stylesheet" href="css/pure-min.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet" />
	</head>
	<!-- Fim do cabeçalho -->
	<!-- Inicio do Corpo -->
	<body>
	<!-- Inicio do Div do Taciano -->
		<div class="content">
			<!-- Inicio do Topo -->
        	<div class="header">
            	<div class="pure-menu pure-menu-open pure-menu-fixed pure-menu-horizontal">
                	<div class="pure-menu-heading"><img src="images/relatorio.png" width="60px" height="60px" /></div>

	                <ul>
        	            <li><a href="index.php?page=novo.php">Novo</a></li>
        	            <li><a href="index.php?page=localizar.php">Localizar</a></li>
        	            <li><a href="index.php?page=pendentes.php">Pendentes</a></li>
        	            <li><a href="index.php?page=finalizados.php">Finalizados</a></li>
        	            <li><a href="index.php?page=clientes.php">Clientes</a></li>
        	            <!--<li><a href="index.php?page=pecas.php">Peças</a></li>-->
        	            <!--<li><a href="index.php?page=entrada.php">Entrada monetária</a></li>-->
					</ul>
           		</div>
        	</div>
        	<!-- Fim do Topo -->

        	<div class="splash">
            	<div class="pure-g">
                	
                		<div class="pure-u-3-4" style=" margin-left:10%; ">
                			<div style="height:50px;"></div>
							<?php
							if(isset($geturl)){
								include("sessao/" . $geturl);
							}else{
								include("sessao/novo.php");
							}
							?>
                    				
                    	</div>
                	
            	</div>
        	</div>

    	</div>
		<!-- Fim do Div do Taciano -->
	</body>	
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->
<?php
}else{
	include("sessao/login.php");	
}
?>