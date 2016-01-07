<?php
//verifica se acionado botao de definir se esta pago
if(isset($_POST['button-pago'])){
	$pedido=$_POST['id_pedido'];
	$sql = $conexao->prepare("UPDATE pedidos SET pago = ? WHERE id = $pedido");
	$pago=1;
	$sql->bind_param('i',$pago);
	$sql->execute();
}
//verifica se acionado botao de add forma de pagamento
if( isset($_POST['button-formaPagamento']) AND $_POST['formaPagamento']!=null ){
	$pedido=$_POST['id_pedido'];
	$sql = $conexao->prepare("UPDATE pedidos SET formaPagamento = ? WHERE id = $pedido");
	$formaPagamento=$_POST['formaPagamento'];
	$sql->bind_param('s',$formaPagamento);
	$sql->execute();
}
//verifica se acionado botao de add observacao
if( isset($_POST['button-observacao']) AND $_POST['observacao']!=null ){
	$pedido=$_POST['id_pedido'];
	$sql = $conexao->prepare("UPDATE pedidos SET observacao = ? WHERE id = $pedido");
	//$observacao=nl2br(mysql_real_escape_string(htmlspecialchars($_POST['observacao'])));
	$observacao=nl2br($_POST['observacao']);
	$sql->bind_param('s',$observacao);
	$sql->execute();
}
//verifica se acionado botao de add valor cobrado
if( isset($_POST['button-valorCobrado']) AND $_POST['valorCobrado']!=null ){
	$pedido=$_POST['id_pedido'];
	$sql = $conexao->prepare("UPDATE pedidos SET valorCobrado = ? WHERE id = $pedido");
	$valorCobrado=$_POST['valorCobrado'];
	$sql->bind_param('s',$valorCobrado);
	$sql->execute();
}
//verifica se acionado botao de add cliente
if( isset($_POST['button-cliente']) AND $_POST['cliente']!=null ){
	$pedido=$_POST['id_pedido'];
	$sql = $conexao->prepare("UPDATE pedidos SET cliente = ? WHERE id = $pedido");
	$cliente=$_POST['cliente'];
	$sql->bind_param('s',$cliente);
	$sql->execute();
}
//verifica se acionado botao de excluir
if(isset($_POST['button-excluir'])){
	$pedido=$_POST['id_pedido'];
	$sql = $conexao->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
	$status="Excluido";
	$sql->bind_param('si',$status,$pedido);
	$sql->execute();
	//$OO->phpAlert(   "O pedido de código $pedido foi excluído."   );
	//echo "<script language=javascript> alert(\" O pedido de código $pedido foi excluído. \"); </script> ";
	echo "O pedido de código $pedido foi excluído";
	exit;
}
//verifica se pedido foi informado
if(!isset($pedido)){
	echo "Pedido não informado!";
}else{
	//no caso de pedido acionado ...
?>
<!DOCTYPE html>
<!-- Inicio do Html -->
<html lang="pt-br">
	<!-- Inicio do cabeçalho -->
	<head>
		<meta charset="iso-8859-1">
	</head>
	<!-- Fim do cabeçalho -->
	<!-- Inicio da Funcao de mascara da moeda -->
	<script type="text/javascript" src="js/mascaraMoeda.js"></script>
	<!-- Fim da Funcao de mascara da moeda -->
	<!-- Inicio do Corpo -->
	<body>
		<form method='post' class='pure-form'>
			<fieldset>
			
				<div style="float:left;"><img src="images/oficina.png" weight="100px" height="100px"/></div>
				<div style="float:left;margin-left:20px; margin-top:10px; font-size:25px;">DETALHES</div>
				
			
					<?php
					$sql = $conexao->query("SELECT * FROM pedidos WHERE id='$pedido'") or die ("Erro na consulta");
					if ($sql->num_rows==0){
						//no results here
						echo '<div style="margin-top:100px;">Pedido não encontrado!</div>';
					}else{
						while($linha=$sql->fetch_array()){
							$codigo=$linha['id'];
							$placa=$linha['placa'];
							$data=$linha['data'];
							$prazo=$linha['prazo'];
							$valor=$linha['valor'];
							$status=$linha['status'];
							$descricao=$linha['descricao'];
							$valorCobrado=$linha['valorCobrado'];
							$formaPagamento=$linha['formaPagamento'];
							$observacao=$linha['observacao'];
							$pago=$linha['pago'];
							$cliente=$linha['cliente'];
							if(isset($tr)){ $tr=null; $tr_cor="#fffff0"; }else{ $tr=1; $tr_cor="#eee8cd"; }
							if($prazo == date('d/m/Y')){ $tr_cor="#ffa07a"; }
						}
					//
							// cliente
							if (isset($cliente)){ echo '<div style="margin-top:70px; margin-left:120px;"><strong>Cliente:</strong> '.$cliente.'</div>'; }
							else{
								?>
								<div style='margin-top:70px; margin-left:120px;'>
								<td><strong>Cliente:</strong></td>
								
								<!-- Inicio do Select para cliente -->
								 <td><select name='cliente' id='cliente'>
								<option value='' selected> Selecione </option>
								<?php
								$sql = $conexao->query("SELECT * FROM clientes ORDER BY nome ASC") or die ("Erro na consulta");
								while($linha=$sql->fetch_array()){
									$nome=$linha['nome'];
									echo "<option value='".$nome."'> $nome </option>";
								}
								?>
								</select></td>
								<!-- Fim do Select para cliente -->
								
								<!--<td><input type='text' placeholder='nome' name='cliente' id='cliente' maxlength='45' /></td>-->
								<td><button type='submit' name='button-cliente' class='pure-button'>GRAVAR</button></td>
								</div>
								<?php
							}
							// fim de cliente
					?>
					<table style="width:100%; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;">
					<tr >
						<td width="10%"><strong>Código</strong></td>
						<td width="30%"><strong>Placa</strong></td>
						<td width="10%"><strong>Data</strong></td>
						<td width="10%"><strong>Prazo</strong></td>
						<td width="15%"><strong>Valor previsto</strong></td>
						<td width="10%"><strong>Status</strong></td>
						<td width="5%"></td>
					</tr>

						<tr style="border-color:white; border-style: dotted; border-width:1px; background-color:<?php echo "$tr_cor"; ?>; height:30px;">
							<td width="10%"><?php echo "#"."$codigo"; ?></td>
							<td width="30%"><?php echo "<strong>$placa</strong>"; ?></td>
							<td width="10%"><?php echo "$data"; ?></td>
							<td width="10%"><?php echo "$prazo"; ?></td>
							<td width="15%"><?php echo "$valor"; ?></td>
							<td style="color:#b22222;" width="10%"><?php echo "<strong>$status</strong>"; ?></td>
							<td width="5%"><div style="text-align:right; margin-right:10px; margin-bottom:-10px;"><img src="images/pago-<?php echo $pago; ?>.png" weight="20px" height="20px"/></div></td>	
						</tr>
						
						</table>
						
							<input style="display:none;" name="id_pedido" value="<?php echo $pedido; ?>"/>
							<div style="padding-top:10px;">
								<div><strong>Descrição:</strong></div>
								<?php echo '<div style="color:#104e8b; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;"><strong>'.$descricao.'</strong></div>'; ?>
							</div>
							<hr/>
							<div style="padding-bottom:10px;"><strong>Informações de pagamento</strong></div>
							<?php
							//valor cobrado
							if (isset($valorCobrado)){ echo "<div>Valor cobrado: $valorCobrado</div>"; }
							else{
								?>
								<div>
									<tr>
										<td>Valor cobrado:</td>
										<td><input type="text" placeholder="0.00" name="valorCobrado" id="valorCobrado" maxlength="8" onKeyPress="return(MascaraMoeda(this,'.',',',event))" /></td>
										<td><button type="submit" name="button-valorCobrado" class="pure-button">GRAVAR</button></td>
									</tr>
								</div>
								<?php
							}
							//forma de pagamento
							if (isset($formaPagamento)){ echo "<div>Forma do pagamento: $formaPagamento</div>"; }
							else{
								echo "
								<div style'clear:both;'>
									<tr>
										<td>Forma de pagamento:</td>
										<td><input style='width:50%;' type='text' placeholder='digite a forma que o cliente irá pagar' name='formaPagamento' id='formaPagamento' maxlength='45' /></td>
										<td><button type='submit' name='button-formaPagamento' class='pure-button'>GRAVAR</button></td>
									</tr>
								</div>
								";
							}
							//definir como pago
							if ($pago==1){ echo '
								<div style="float:left; padding-top:20px; color:green;">
									<div style="float:left;margin-left:-10px; margin-top:-10px; padding-right:5px;">
										<img src="images/pago-1.png" weight="40px" height="40px"/>
									</div>
									<strong>Serviço pago</strong>
								</div>
								';
							}
							else{
								echo "
								<div style='float:left; padding-top:20px;'>
									<button type='submit' name='button-pago' class='pure-button'>
										<div style='float:left;margin-left:-10px; margin-top:-4px; padding-right:10px;'>
											<img src='images/dindin.png' weight='40px' height='40px'/>
										</div>
										<div style='color:gray; width:200px; margin-top:5px; font-size:18px;'>Definir como pago</div>
									</button>
								</div>
								";
							}
							echo '<div style="margin-top:90px;"><hr/></div>';
							//observação
							echo '<div style="clear:both;"><strong>Observação:</strong></div>';
							if (isset($observacao) AND $observacao!=null){ echo "<div>$observacao</div><div><a href='index.php?observacao=".$codigo."'>(apagar observação)</a></div>"; }
							else{
								//style='width:50%;'
								echo "
								<div>
								<td><div><textarea name='observacao' rows='4' cols='100' maxlength='254' placeholder='obs'></textarea><div></td>
								<td><div style='clear:both; margin-top:10px;'><button type='submit' name='button-observacao' class='pure-button'>GRAVAR</button></div></td>
								</div>
								";
							}
							echo "
							<div style='float:right; margin-top:100px;'><button type='submit' name='button-excluir' class='pure-button'><div style='float:left;margin-left:-10px; margin-top:-1px; padding-right:15px;'><img src='images/del.png' weight='20px' height='20px'/></div><strong>EXCLUIR</strong></button></div>
							";
							
							
					}
					?>

			</fieldset>
		</form>
		<br/>
	</body>
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->
<?php
}
?>

