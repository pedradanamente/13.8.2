<?php
	 // aqui inicia conexao
	$conexao = new mysqli($banco_hostname,$banco_usuario,$banco_senha,$banco_nome);
	if ( !$conexao ){
	echo "Erro! N�o foi possivel conectar ao banco de dados ...";
		}
?>