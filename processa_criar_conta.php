<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    // Conecta ao banco de dados
    $conn = new mysqli("localhost", "seu_usuario_mysql", "sua_senha_mysql", "easy_games");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insere o novo usuário na tabela
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $senha);
    $stmt->execute();

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
