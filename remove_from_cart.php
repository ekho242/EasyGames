<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["carrinho_id"])) {
    $carrinho_id = $_POST["carrinho_id"];

    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "easy_games");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Remove o item do carrinho
    $conn->query("DELETE FROM carrinho WHERE carrinho_id = '$carrinho_id'");

    // Fecha a conexão com o banco de dados
    $conn->close();

    // Redireciona de volta para a página de carrinho
    header("Location: carrinho.php");
    exit();
}
?>
