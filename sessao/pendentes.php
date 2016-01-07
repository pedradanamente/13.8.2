<!DOCTYPE html>
<!-- Inicio do Html -->
<html lang="pt-br">
	<!-- Inicio do cabeçalho -->
	<head>
		<meta charset="iso-8859-1">
	</head>
	<!-- Fim do cabeçalho -->
	<!-- Inicio do Corpo -->
	<body>
		<form method='post' class='pure-form'>
			<fieldset>
				
				<div style="float:left;"><img src="images/pendente-title.png" weight="60px" height="60px"/></div>
				<div style="float:left;margin-left:20px; margin-top:10px; font-size:25px;">PENDENTES</div>
				<?php
				$mes=date('m'); //define mes
				if(isset($_POST['button-filtraMes'])){
					$mesFiltrado=$_POST['filtraMes'];
				}else{
					$mesFiltrado=$mes;
				}
				
				?>
				<div style="float:right;">
					
					<div style="float:left; margin-left:5px;">
				     	<select name="filtraMes" id="filtraMes">
							<option value="01" <?php if ($mesFiltrado=="01"){ echo "selected"; } ?>> Janeiro </option>
							<option value="02" <?php if ($mesFiltrado=="02"){ echo "selected"; } ?>> Fevereiro </option>
							<option value="03" <?php if ($mesFiltrado=="03"){ echo "selected"; } ?>> Março </option>
							<option value="04" <?php if ($mesFiltrado=="04"){ echo "selected"; } ?>> Abril </option>
							<option value="05" <?php if ($mesFiltrado=="05"){ echo "selected"; } ?>> Maio </option>
							<option value="06" <?php if ($mesFiltrado=="06"){ echo "selected"; } ?>> Junho </option>
							<option value="07" <?php if ($mesFiltrado=="07"){ echo "selected"; } ?>> Julho </option>
							<option value="08" <?php if ($mesFiltrado=="08"){ echo "selected"; } ?>> Agosto </option>
							<option value="09" <?php if ($mesFiltrado=="09"){ echo "selected"; } ?>> Setembro </option>
							<option value="10" <?php if ($mesFiltrado=="10"){ echo "selected"; } ?>> Outubro </option>
							<option value="11" <?php if ($mesFiltrado=="11"){ echo "selected"; } ?>> Novembro </option>
							<option value="12" <?php if ($mesFiltrado=="12"){ echo "selected"; } ?>> Dezembro </option>
						</select>
					</div>
					<div style="float:left; margin-left:5px;">
						<button type='submit' name='button-filtraMes' class='pure-button'>OK</button>
					</div>
				
				</div>
				
					<?php
					$sql = $conexao->query("SELECT * FROM pedidos WHERE status='pendente' AND mes='$mesFiltrado' ORDER BY prazo") or die ("Erro na consulta");
					if ($sql->num_rows==0){
						//no results here
						echo '<div style="margin-top:100px;">Não ha nenhum pedido pendente no momento</div>';
					}else{
					?>
						<table style="width:100%; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;">
							<tr>
								<td width="10%"><strong>Código</strong></td>
								<td width="30%"><strong>Placa</strong></td>
								<td width="10%"><strong>Data</strong></td>
								<td width="10%"><strong>Prazo</strong></td>
								<td width="15%"><strong>Valor previsto</strong></td>
								<td width="10%"><strong>Ação</strong></td>	
							</tr>
							<?php
							while($linha=$sql->fetch_array()){
								$codigo=$linha['id'];
								$placa=$linha['placa'];
								$data=$linha['data'];
								$prazo=$linha['prazo'];
								$valor=$linha['valor'];
								$status=$linha['status'];
								$ano_pedido=$linha['ano'];
								if(isset($tr)){ $tr=null; $tr_cor="#fffff0"; }else{ $tr=1; $tr_cor="#eee8cd"; }
								if($ano_pedido != date('Y')){ $tr_cor="#cdc9a5"; }
								if($prazo <= date('d/m/Y')){ $tr_cor="#ffa07a"; }		
							?>
								<tr style="border-color:white; border-style: dotted; border-width:1px; background-color:<?php echo "$tr_cor"; ?>;">
									<td width="10%"><a href="index.php?pedido=<?php echo "$codigo"; ?>"><?php echo "#"."$codigo"; ?></a></td>
									<td width="30%"><a href="index.php?pedido=<?php echo "$codigo"; ?>"><?php echo "<strong>$placa</strong>"; ?></a></td> 
									<td width="10%"><?php echo "$data"; ?></td>
									<td width="10%"><?php echo "$prazo"; ?></td>
									<td width="15%"><?php echo "$valor"; ?></td>
									<td style="color:#b22222;" width="10%"><a href="index.php?finalizar=<?php echo "$codigo"; ?>"><?php echo "<strong>FINALIZAR</strong>"; ?></td></a>	
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

