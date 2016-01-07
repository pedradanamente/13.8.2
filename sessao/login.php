<!DOCTYPE html>
<!-- Inicio do Html -->
<html lang="pt-br">
	<!-- Inicio do cabeçalho -->
	<head>
		<meta charset="iso-8859-1">
		<style> 
			body{
				margin:0 auto;
				padding:10px;
				
			}
		</style>
	</head>
	<!-- Fim do cabeçalho -->
	<!-- Inicio do Corpo -->
	<body>
	<form action="index.php" method="post">
		<div style="width:700px; height:100px; margin:0 auto; ">
			<div style="float:left; font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 42px; margin-top:15px; margin-left:8px; color:gray;">
				<img src="images/senha.png" width="200px" height="200px" />
				</div>
			<div style="float:right;">
				<input style="height:80px; width:400px; margin-top:75px; margin-right:8px; font-size:15px;" name="senha" id="senha" type="text" value="" width="45px" height="10px" required/>
			</div>
			<div>
				<button type="submit" name="button-entrar" style="width:150px; height:50px; margin-top:20px; margin-right:8px;float:right;">ENTRAR</button>
			</div>
		</div>
	</form>
		<script type='text/javascript'>$('#senha').focus();</script>
	</body>
	<!-- Fim do Corpo -->
</html>
<!-- Fim do Html -->