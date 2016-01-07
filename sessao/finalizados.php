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
				
				<div style="float:left;"><img src="images/buttonok.png" weight="60px" height="60px"/></div>
				<div style="float:left;margin-left:20px; margin-top:10px; font-size:25px;">FINALIZADOS</div>
				<?php
				$ano=date('Y'); //define ano
				if(isset($_POST['button-filtraAno'])){
					$anoFiltrado=$_POST['filtraAno'];
				}else{
					$anoFiltrado=$ano;
				}
				
				?>
				<div style="float:right;">
					
					<div style="float:left; margin-left:5px;">
				     	<select name="filtraAno" id="filtraAno">
							<option value="2014" <?php if ($anoFiltrado==2014){ echo "selected"; } ?>> 2014 </option>
							<option value="2015" <?php if ($anoFiltrado==2015){ echo "selected"; } ?>> 2015 </option>
							<option value="2016" <?php if ($anoFiltrado==2016){ echo "selected"; } ?>> 2016 </option>
							<option value="2017" <?php if ($anoFiltrado==2017){ echo "selected"; } ?>> 2017 </option>
							<option value="2018" <?php if ($anoFiltrado==2018){ echo "selected"; } ?>> 2018 </option>
      					</select>
					</div>
					<div style="float:left; margin-left:5px;">
						<button type='submit' name='button-filtraAno' class='pure-button'>OK</button>
					</div>
				
				</div>
				
				<?php
				$sql = $conexao->query("SELECT * FROM pedidos WHERE status='finalizado' AND ano='$anoFiltrado' ORDER BY id DESC") or die ("Erro na consulta");
				if ($sql->num_rows==0){
					//no results here
					echo '<div style="margin-top:100px;">Não ha nenhum pedido finalizado no momento</div>';
				}else{
				?>
						<table style="width:100%; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;">
							<tr>
								<td width="10%"><strong>Código</strong></td>
								<td width="30%"><strong>Placa</strong></td>
								<td width="10%"><strong>Data</strong></td>
								<td width="10%"><strong>Prazo</strong></td>
								<td width="15%"><strong>Valor previsto</strong></td>
								<td width="10%"><strong></strong></td>	
							</tr>
							<?php
							while($linha=$sql->fetch_array()){
								$codigo=$linha['id'];
								$placa=$linha['placa'];
								$data=$linha['data'];
								$prazo=$linha['prazo'];
								$valor=$linha['valor'];
								$status=$linha['status'];
								$pago=$linha['pago'];
								if(isset($tr)){ $tr=null; $tr_cor="#fffff0"; }else{ $tr=1; $tr_cor="#eee8cd"; }
								if($prazo == date('d/m/Y')){ $tr_cor="#ffa07a"; }
							?>
								<tr style="border-color:white; border-style: dotted; border-width:1px; background-color:<?php echo "$tr_cor"; ?>;">
									<td width="10%"><a href="index.php?pedido=<?php echo "$codigo"; ?>"><?php echo "#"."$codigo"; ?></a></td>
									<td width="30%"><a href="index.php?pedido=<?php echo "$codigo"; ?>"><?php echo "<strong>$placa</strong>"; ?></a></td> 
									<td width="10%"><?php echo "$data"; ?></td>
									<td width="10%"><?php echo "$prazo"; ?></td>
									<td width="15%"><?php echo "$valor"; ?></td>
									<td style="color:#8fbc8f;" width="10%"><?php echo '<div style="text-align:right; margin-right:10px; margin-bottom:-10px;"><img src="images/pago-'.$pago.'.png" weight="20px" height="20px"/></div>'; ?></td>	
								</tr>
							<?php
					
							}

					//
				}
				?>
						</table>
			
			</fieldset>
		</form>

	</body>
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->

