<?php
	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
	
	try{
		
		$conexao = new PDO('mysql:host=localhost;dbname=aplicativo', 'root' , '');
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
	}catch(PDOException $e){
		echo $e;
	}
		
?>


<?php

	try{
		
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$cpf = $_POST['cpf'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];

		$resultado = $conexao->prepare("INSERT INTO tabela (nome, email, telefone, cpf, estado, cidade) VALUES (:nome, :email, :telefone, :cpf, :estado, :cidade)");
		$resultado->bindParam(":nome", $nome);
		$resultado->bindParam(":email", $email);
		$resultado->bindParam(":telefone", $telefone);
		$resultado->bindParam(":cpf", $cpf);
		$resultado->bindParam(":estado", $estado);
		$resultado->bindParam(":cidade", $cidade);
		$resultado->execute();


	}catch(PDOException $e){
		echo $e;
	}

?>  
