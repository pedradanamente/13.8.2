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
		<form method='post' class='pure-form' action='index.php?page=localizar.php'>
			<fieldset>
			
				<div style="float:left;"><img src="images/search.png" weight="60px" height="60px"/></div>
				<div style="float:left;margin-left:20px; margin-top:10px; font-size:25px;">LOCALIZAR</div>
				<div style="clear:both;";>
					<table>
						<tr>
							<td>Placa do veículo: </td> <td> <input type='text' placeholder='PLACA' name='placa' id='placa' required/></td>
						</tr>
					</table>
				</div>
				<div style="float:left; margin-top:20px;"><button type='submit' name='submit-search' class='pure-button'>Buscar placa</button></div>
			
			</fieldset>
		</form>
		<script type='text/javascript'>$('#placa').focus();</script>
		<br/>
	</body>
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->
<?php
if (isset($_POST['submit-search'])){
	$palavra=$_POST['placa'];
	$sql = $conexao->query("SELECT * FROM pedidos WHERE placa LIKE '%".$palavra."%' AND status != 'excluido' ORDER BY id DESC") or die ("Erro na consulta");
	if ($sql->num_rows==0){
		echo "A placa $palavra não foi encontrada!";
	}else{
		?>
		<table style="width:100%; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;">
			<tr style="background-color:<?php echo "$tr_cor"; ?>;">
				<td width="10%"><strong>Código</strong></td>
				<td width="30%"><strong>Placa</strong></td>
				<td width="10%"><strong>Data</strong></td>
				<td width="10%"><strong>Prazo</strong></td>
				<td width="15%"><strong>Valor previsto</strong></td>
				<td width="10%"><strong>Status</strong></td>	
				<td width="5%"></td>
			</tr>
		<?php
			while($linha=$sql->fetch_array()){
				$codigo=$linha['id'];
				$placa=$linha['placa'];
				$data=$linha['data'];
				$prazo=$linha['prazo'];
				$valor=$linha['valor'];
				$status=$linha['status'];
				$descricao=$linha['descricao'];
				$ano_pedido=$linha['ano'];
				$pago=$linha['pago'];
				if(isset($tr)){ $tr=null; $tr_cor="#fffff0"; }else{ $tr=1; $tr_cor="#ffefdb"; }
				if($status=="Pendente"){ $tr_cor="#eed5d2"; }
				if($ano_pedido != date('Y')){ $tr_cor="#cdc9a5"; }
				if($prazo == date('d/m/Y')){ $tr_cor="#ffa07a"; }			
		?>
			<tr style="height:30px; border-color:white; border-style: dotted; border-width:1px; background-color:<?php echo "$tr_cor"; ?>;">
				<td width="10%"><a href="index.php?pedido=<?php echo "$codigo"; ?>"><strong><?php echo "#"."$codigo"; ?></strong></a></td>
				<td width="30%"><a href="index.php?pedido=<?php echo "$codigo"; ?>"><strong><?php echo "$placa"; ?></strong></a></td> 
				<td width="10%"><?php echo "$data"; ?></td>
				<td width="10%"><?php echo "$prazo"; ?></td>
				<td width="15%"><?php echo "$valor"; ?></td>
				<td style="color:#b22222;" width="10%"><?php echo "<strong>$status</strong>"; ?></td>	
				<td width="5%"><div style="text-align:right; margin-right:10px; margin-bottom:-10px;"><img src="images/pago-<?php echo $pago; ?>.png" weight="20px" height="20px"/></div></td>
			</tr>
		<?php
			 }
	}
}
?>