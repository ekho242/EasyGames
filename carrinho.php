<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Easy Games - Carrinho de Compras</title>
</head>
<body>
    <header>
        <h1>Easy Games</h1>
        <nav>
            <ul>
                <li><a href="signup.php">Criar Conta</a></li>
                <li><a href="login.php">Fazer Login</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="jogos.php">Jogos</a></li>
                <li><a href="contato.php">Contate-nos</a></li>
                <li><a href="sobre_nos.php">Sobre nós</a></li>
                <li><a href="carrinho.php">Carrinho de Compras</a></li>
            </ul>
        </nav>
    </header>

    <section class="cart">
        <h2>Carrinho de Compras</h2>
        <?php
            // Conexão com o banco de dados
            $conn = new mysqli("localhost", "root", "", "easy_games");

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Obtém o ID do usuário logado
            $username = $_SESSION['username'];
            $user_result = $conn->query("SELECT user_id FROM usuarios WHERE username='$username'");
            $user_row = $user_result->fetch_assoc();
            $user_id = $user_row['user_id'];

            // Consulta SQL para obter os itens no carrinho do usuário
            $cart_result = $conn->query("SELECT carrinho.carrinho_id, jogos.nome, carrinho.quantidade, jogos.preco FROM carrinho JOIN jogos ON carrinho.jogos_id = jogos.jogos_id WHERE carrinho.user_id = '$user_id'");
            
            $total = 0; // Inicializa o total

            // Exibe os itens no carrinho
            while ($cart_row = $cart_result->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<p>Nome do Jogo: {$cart_row['nome']}</p>";
                echo "<p>Quantidade: {$cart_row['quantidade']}</p>";
                echo "<p>Preço Unitário: R$ {$cart_row['preco']}</p>";
                echo "<form action='remove_from_cart.php' method='post'>";
                echo "<input type='hidden' name='carrinho_id' value='{$cart_row['carrinho_id']}'>";
                echo "<button type='submit'>Remover do Carrinho</button>";
                echo "</form>";
                echo "</div>";

                // Atualiza o total
                $total += $cart_row['quantidade'] * $cart_row['preco'];
            }

            // Exibe o total e o botão de finalizar compra
            echo "<div class='cart-total'>";
            echo "<p>Total: R$ $total</p>";
            echo "<form action='checkout.php' method='post'>";
            echo "<input type='hidden' name='total' value='$total'>";
            echo "<button type='submit'>Finalizar Compra</button>";
            echo "</form>";
            echo "</div>";

            // Fecha a conexão com o banco de dados
            $conn->close();
        ?>
    </section>
</body>
</html>
