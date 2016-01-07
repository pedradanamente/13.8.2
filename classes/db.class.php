<?php
class DB {
	
	//insere novo pedido ao db
	public function novoPedido($conexao,$placa,$prazo,$valor,$descricao,$_getdate,$status,$ano,$mes){
		$sql = $conexao->prepare("INSERT pedidos SET placa = ?, prazo = ?, valor = ?, descricao = ?, data = ?, status = ?, ano = ?, mes = ?");
		$sql->bind_param('ssssssii',$placa,$prazo,$valor,$descricao,$_getdate,$status,$ano,$mes);
		$sql->execute();
	}
	// insere novo cliente ao db
	public function novoCliente($conexao,$nome,$telefone,$celular,$endereco,$cidade){
		$sql = $conexao->prepare("INSERT clientes SET nome = ?, telefone = ?, celular = ?, endereco = ?, cidade = ?");
		$sql->bind_param('sssss',$nome,$telefone,$celular,$endereco,$cidade);
		$sql->execute();
	}
	public function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
	
}