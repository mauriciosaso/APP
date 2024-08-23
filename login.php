<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // Estabelece a conexão com o banco de dados
    $conexao = new PDO('mysql:host=localhost;dbname=aplicativo', 'root', '');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepara e executa a consulta SQL para verificar o login
        $resultado = $conexao->prepare("SELECT nome FROM login WHERE username = :username AND password = :password");
        $resultado->bindParam(':username', $username);
        $resultado->bindParam(':password', $password);
        $resultado->execute();

        // Verifica se foi encontrado algum registro
        if ($resultado->rowCount() > 0) {
            $usuario = $resultado->fetch(PDO::FETCH_ASSOC); // Pega o resultado da consulta
            $nome = $usuario['nome']; // Obtém o nome do usuário
            echo json_encode(['status' => 'success', 'message' => 'Login bem-sucedido', 'nome' => $nome]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Nome de usuário ou senha incorretos']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Método não permitido']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
