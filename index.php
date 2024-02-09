<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Easy Games</title>
    <style>
        header {
            text-align: center;
        }

        nav {
            margin-top: 20px;
        }

        section {
            text-align: center;
            margin-top: 20px;
        }

        section img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        section p {
            margin-top: 10px;
            background-color: black;
            color: red;
            padding: 10px;
            border-radius: 8px;
            display: inline-block;
        }
    </style>
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

    <section>
        <p>Gamer = Aquele que compra na Easy Games</p>
        <img src="imagem.jpg">

        <?php
        // Inicia a sessão
        session_start();

        // Verifica se o usuário está logado
        if (isset($_SESSION['username'])) {
            // Se logado, exibe mensagem de boas-vindas
            echo "<p>Login feito: {$_SESSION['username']}</p>";
        } else {
            // Se não logado, exibe mensagem de não logado
            echo "<p>Não login feito</p>";
        }
        ?>
    </section>

    <?php
    // Verifica se o usuário está logado e exibe o botão de logout se necessário
    if (isset($_SESSION['username'])) {
        echo '<div id="logout-btn">';
        echo '<button onclick="logout()">Sair</button>';
        echo '</div>';
    }
    ?>

    <script>
        // Função para realizar logout
        function logout() {
            // Redireciona diretamente para a página de logout_complete.php ao clicar em "Sair"
            window.location.href = 'logout_complete.php';
        }
    </script>
</body>
</html>
