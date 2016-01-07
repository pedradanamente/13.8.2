<?php
if(isset($_POST['button-novo'])){
	$prazo=$_POST["prazo"];
	if(is_numeric($prazo)) { $prazo=preg_replace("/[^0-9]/","", $prazo); }else { $prazo=2; }
	$placa=$_POST['placa'];
	$prazo=date('d/m/Y', strtotime("+".$prazo." days"));
	$_getdate=date('d/m/Y');
	$valor=$_POST['valor_previsto'];
	$descricao=nl2br($_POST['descricao']);
	$status="Pendente";
	$ano=date('Y'); //define ano
	$mes=date('m'); //define mes
	// Insere ao banco de dados o pedido
	$OO->novoPedido($conexao,$placa,$prazo,$valor,$descricao,$_getdate,$status,$ano,$mes);
	// sucesso ao adicionar pedido redireciona ou manda msg
	$sql = $conexao->query( "SELECT * FROM pedidos WHERE data='$_getdate' AND prazo ='$prazo' AND descricao = '$descricao' AND placa = '$placa' ") or die ("Erro na consulta");
	if ($sql->num_rows==1){
		while($linha=$sql->fetch_array()){
			$pedido=$linha['id'];
			echo "
			<div style='height:50px;'>
			<div style='float:left;'><img src='images/addok.png' width='50px' height='50px'></img></div>
			<div style='float:left; margin-top:10px; margin-left:5px; color:green;'><strong>Pedido referente a placa $placa foi adicionado</strong><a href='index.php?pedido=".$pedido."'> Clique aqui para abrir</a></div>
			</div>
			";
			
		}
	}
	if ($sql->num_rows>1){
	echo "
	<div style='height:50px;'>
	<div style='float:left;'><img src='images/addok.png' width='50px' height='50px'></img></div>
	<div style='float:left; margin-top:10px; margin-left:5px; color:green;'><strong>Pedido referente a placa $placa foi adicionado.</strong></div>
	</div>
	";
	}
	if ($sql->num_rows==0){
	echo "
	<div style='height:50px;'>
	<div style='float:left;'><img src='images/addok.png' width='50px' height='50px'></img></div>
	<div style='float:left; margin-top:10px; margin-left:5px; color:red;'><strong>Houve um erro ao adicionar.</strong></div>
	</div>
	";
	}
}
?>
<!DOCTYPE html>
<!-- Inicio do Html -->
<html lang="pt-br">
	<!-- Inicio do cabeçalho -->
	<head>
		<meta charset="iso-8859-1">
	</head>
	<!-- Fim do cabeçalho -->
	<!-- Inicio Funcao MascaraMoeda -->
	<script type="text/javascript" src="js/mascaraMoeda.js"></script>
	<!-- Fim Funcao MascaraMoeda -->
	<!-- Inicio do Corpo -->
	<body>
		<form method='post' class='pure-form'>
			<fieldset>
				
				<div style="float:left;"><img src="images/add.png" weight="60px" height="60px"/></div>
				<div style="float:left;margin-left:20px; margin-top:10px; font-size:25px;">NOVO</div>
				<div style="height:55px;"></div>
			
				<table>
					<tr>
						<td>Placa do veículo:</td> <td><input type='text' placeholder='PLACA' name='placa' id='placa' maxlength='15' required/></td>
					</tr>
					<tr>
						<td>Prazo (dias):</td> <td><input type='text' placeholder='PRAZO' name='prazo' id='prazo' maxlength='2' required/></td>
					</tr>
					<tr>
						<td>Valor previsto:</td> <td><input type="text" placeholder="0.00" name="valor_previsto" id="valor_previsto" maxlength="8" onKeyPress="return(MascaraMoeda(this,'.',',',event))" /></td>
					</tr>
					<tr>
						<td><div style="margin-top:-60px;">Descrição:</div></td> <td><textarea name='descricao' rows='8' cols='80' maxlength='254' required></textarea></td>
					</tr>
					
				</table>
			
				<div style="float:left; margin-top:20px;"><button type='submit' name='button-novo' class='pure-button'>Adicionar pedido</button></div>
			
			</fieldset>
		</form>
		<script type='text/javascript'>$('#placa').focus();</script>
		<br/>
	</body>
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->

