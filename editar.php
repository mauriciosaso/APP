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
		
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$cpf = $_POST['cpf'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];

		$resultado = $conexao->prepare("UPDATE tabela SET nome=:nome, email=:email, telefone=:telefone, cpf=:cpf, estado=:estado, cidade=:cidade WHERE id = :id");
		$resultado->bindParam(":id", $id, PDO::PARAM_INT);
		$resultado->bindParam(":nome", $nome);
		$resultado->bindParam(":email", $email);
		$resultado->bindParam(":telefone", $telefone);
		$resultado->bindParam(":cpf", $cpf);
		$resultado->bindParam(":estado", $estado);
		$resultado->bindParam(":cidade", $cidade);
		$resultado->execute();

		
		if($resultado->execute()){
			echo json_encode(['status' => 'Sucesso']);
		}else{
			echo json_encode(['status' => 'Erro']);
		}

	}catch(PDOException $e){
		echo json_encode(['status' => 'Erro', 'Mensagem' => $e->getMessage()]);
	}

?>  
