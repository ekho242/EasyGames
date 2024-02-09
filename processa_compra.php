<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera o ID do jogo a ser adicionado ao carrinho
    $jogos_id = $_POST["jogos_id"];

    // Lógica para adicionar o jogo ao carrinho (simulação usando uma sessão)
    session_start();

    if (!isset($_SESSION["carrinho"])) {
        $_SESSION["carrinho"] = array();
    }

    // Verifica se o jogo já está no carrinho
    $jogo_no_carrinho = false;
    foreach ($_SESSION["carrinho"] as &$item) {
        if ($item["jogos_id"] == $jogos_id) {
            $item["quantidade"] += 1;
            $jogo_no_carrinho = true;
            break;
        }
    }

    // Se o jogo não estiver no carrinho, adiciona
    if (!$jogo_no_carrinho) {
        $_SESSION["carrinho"][] = array("jogos_id" => $jogos_id, "quantidade" => 1);
    }

    // Redireciona de volta para a página de Jogos
    header("Location: jogos.php");
    exit();
}
?>
