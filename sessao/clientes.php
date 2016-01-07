<?php
if(isset($_POST['button-novo'])){
	$nome=$_POST['nome'];
	$telefone=$_POST['telefone'];
	$celular=$_POST['celular'];
	$endereco=$_POST['endereco'];
	$cidade=$_POST['cidade'];
	// Insere ao banco de dados o pedido
	$OO->novoCliente($conexao,$nome,$telefone,$celular,$endereco,$cidade);
	// Mensagem de sucesso ao adicionar pedido
	echo "
			<div style='height:50px;'>
			<div style='float:left;'><img src='images/addok.png' width='50px' height='50px'></img></div>
			<div style='float:left; margin-top:10px; margin-left:5px; color:green;'><strong>Cliente adicionado</strong></div>
			</div>
			";
}
?>
<!DOCTYPE html>
<!-- Inicio do Html -->
<html lang="pt-br">
	<!-- Inicio do cabeÃ§alho -->
	<head>
		<meta charset="iso-8859-1">
	</head>
	<!-- Fim do cabeÃ§alho -->
	<!-- Inicio do Corpo -->
	<body>
		<form method='post' class='pure-form'>
			<fieldset>
				
				<div style="float:left;"><img src="images/add_cliente.png" weight="60px" height="60px"/></div>
				<div style="float:left;margin-left:20px; margin-top:10px; font-size:25px;">NOVO CLIENTE</div>
				<div style="height:55px;"></div>
			
				<table>
					<tr>
						<td>Nome:</td> <td><input type='text' placeholder='Nome completo' name='nome' id='nome' maxlength='30' required /></td>
					</tr>
					<tr>
						<td>Telefone:</td> <td><input type='text' placeholder='(51) 9999-9999' name='telefone' id='telefone' maxlength='14' /></td>
					</tr>
					<tr>
						<td>Celular:</td> <td><input type='text' placeholder='(51) 9999-9999' name='celular' id='celular' maxlength='14' /></td>
					</tr>
					<tr>
						<td>Endereço:</td> <td><input type='text' placeholder='Rua - Número' name='endereco' id='endereco' maxlength='20' /></td>
					</tr>
					<tr>
						<td>Cidade:</td> <td><input type='text' placeholder='Cidade' name='cidade' id='cidade' maxlength='25' required /></td>
					</tr>
					
				</table>
			
				<div style="float:left; margin-top:20px;"><button type='submit' name='button-novo' class='pure-button'>Adicionar cliente</button></div>
			
			</fieldset>
		</form>
		<hr/>
<?php

	$sql = $conexao->query("SELECT * FROM clientes ORDER BY nome ASC") or die ("Erro na consulta");
	if ($sql->num_rows==0){
		//no results here
		echo "Não há clientes cadastrados no momento";
	}else{
		?>
		<table style="width:100%; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;">
			<tr style="background-color:<?php echo "$tr_cor"; ?>;">
				<td width="3%"></td>
				<td width="25%"><strong>Nome</strong></td>
				<td width="13%"><strong>Telefone</strong></td>
				<td width="13%"><strong>Celular</strong></td>
				<td width="30%"><strong>Endereço</strong></td>
				<td width="16%"><strong>Cidade</strong></td>
			</tr>
		<?php
			while($linha=$sql->fetch_array()){
				$id=$linha['id'];
				$nome=$linha['nome'];
				$telefone=$linha['telefone'];
				$celular=$linha['celular'];
				$endereco=$linha['endereco'];
				$cidade=$linha['cidade'];
				if(isset($tr)){ $tr=null; $tr_cor="#fffff0"; }else{ $tr=1; $tr_cor="#eee8cd"; }
			
		?>
			<tr style="border-color:white; border-style: dotted; border-width:1px; background-color:; height:30px;" >
				<td style="background-color:<?php echo "$tr_cor"; ?>;" align="center" width="3%"><?php echo "<div style='margin-bottom:-10px;'><img src='images/seta.png' height='20px' width='20px'></div>"; ?></td>
				<td style="background-color:<?php echo "$tr_cor"; ?>;" align="left" width="25%"><div style="padding-left:4px;"><?php echo "$nome"; ?></div></td>
				<td style="background-color:<?php echo "$tr_cor"; ?>;" align="left" width="13%"><div style="padding-left:4px;"><?php echo "$telefone"; ?></div></td>
				<td style="background-color:<?php echo "$tr_cor"; ?>;" align="left" width="13%"><div style="padding-left:4px;"><?php echo "$celular"; ?></div></td>
				<td style="background-color:<?php echo "$tr_cor"; ?>;" align="left" width="30%"><div style="padding-left:4px;"><?php echo "$endereco"; ?></div></td>
				<td style="background-color:<?php echo "$tr_cor"; ?>;" align="left" width="16%"><div style="padding-left:4px;"><?php echo "$cidade"; ?></div></td>
			</tr>
		<?php
			 }
	}

?>		
		
		
		<script type='text/javascript'>$('#placa').focus();</script>
		<br/>
	</body>
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->

