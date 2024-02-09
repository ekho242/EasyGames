<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "easy_games");

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recupera o ID do jogo enviado
$game_id = $_POST['jogos_id'];

// Recupera o ID do usuário logado
$username = $_SESSION['username'];
$user_result = $conn->query("SELECT user_id FROM usuarios WHERE username='$username'");
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['user_id'];

// Inicia uma transação
$conn->begin_transaction();

try {
    // Verifica se o jogo já existe na tabela 'jogos'
    $check_game = $conn->query("SELECT * FROM jogos WHERE jogos_id = '$game_id'");
    if ($check_game->num_rows == 0) {
        // Se o jogo não existe, você pode adicionar à tabela 'jogos' aqui
        // Exemplo: $conn->query("INSERT INTO jogos (jogos_id, nome, preco) VALUES ('$game_id', 'Nome do Jogo', 19.99)");
    }

    // Insere o jogo no carrinho do usuário
    $conn->query("INSERT INTO carrinho (user_id, jogos_id, quantidade) VALUES ('$user_id', '$game_id', 1)");

    // Commit da transação
    $conn->commit();

} catch (Exception $e) {
    // Rollback da transação em caso de falha
    $conn->rollback();
    echo "Erro: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn->close();

// Redireciona de volta para a página de jogos
header("Location: jogos.php");
exit();
?>