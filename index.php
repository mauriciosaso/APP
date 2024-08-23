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
		$result = $conexao->prepare("SELECT * FROM tabela");			
		$result->execute();
		$contar = $result->rowCount();
		if($contar>0){
			while($mostra = $result->fetchAll(PDO::FETCH_ASSOC)){
	?>           
	
				  
<?php 
	echo json_encode($mostra); 
?>

<?php
}				
	}else{
		echo '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Aviso!</strong> Não há post cadastrado em nosso banco de dados ou a página não existe.
		</div>';
	}
	
	}catch(PDOException $e){
	echo $e;
	}
?>  
