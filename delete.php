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

		$resultado = $conexao->prepare("DELETE FROM tabela WHERE id = :id");
		$resultado->bindParam(":id", $id, PDO::PARAM_INT);
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
