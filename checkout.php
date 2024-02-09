<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Easy Games - Checkout</title>
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

    <section class="checkout">
        <h2>Checkout</h2>
        <?php
            // Verifica se o formulário foi submetido
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verifica se o total foi enviado
                if (isset($_POST['total'])) {
                    $total = $_POST['total'];

                    // Exibe os produtos e o total
                    echo "<p>Produtos Selecionados:</p>";

                    // Aqui você pode consultar novamente o banco para obter detalhes dos produtos
                    // Neste exemplo, usaremos a variável de sessão para obter os produtos

                    session_start();

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
                    $cart_result = $conn->query("SELECT jogos.nome, carrinho.quantidade, jogos.preco FROM carrinho JOIN jogos ON carrinho.jogos_id = jogos.jogos_id WHERE carrinho.user_id = '$user_id'");
                    
                    while ($cart_row = $cart_result->fetch_assoc()) {
                        echo "<div class='checkout-item'>";
                        echo "<p>{$cart_row['nome']} - Quantidade: {$cart_row['quantidade']} - Preço Unitário: R$ {$cart_row['preco']}</p>";
                        echo "</div>";
                    }

                    echo "<p>Total: R$ $total</p>";

                    // Fecha a conexão com o banco de dados
                    $conn->close();

                    // Adicione aqui a lógica para realizar o pagamento, por exemplo, exibindo um código QR para o PIX
                    echo "<p>Forma de Pagamento: PIX</p>";
                    echo "<p>Chave PIX: [625.656.569-35]</p>";
                    echo "<p>Ou escaneie o código QR para realizar o pagamento.</p>";

                } else {
                    echo "<p>O total não foi enviado.</p>";
                }
            } else {
                echo "<p>Erro: O formulário não foi submetido corretamente.</p>";
            }
        ?>
    </section>
</body>
</html>
