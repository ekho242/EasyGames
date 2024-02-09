<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Easy Games - Jogos</title>
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

    <section class="product-list">
        <h2>Jogos Disponíveis</h2>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            session_start();

            // Conexão com o banco de dados
            $conn = new mysqli("localhost", "root", "", "easy_games");

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Lógica para adicionar o jogo ao carrinho
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["jogos_id"])) {
                $game_id = $_POST["jogos_id"];

                // Adiciona o jogo ao carrinho (simulação usando uma sessão)
                if (!isset($_SESSION["carrinho"])) {
                    $_SESSION["carrinho"] = array();
                }

                // Verifica se o jogo já está no carrinho
                $game_no_carrinho = false;
                foreach ($_SESSION["carrinho"] as &$item) {
                    if ($item["game_id"] == $game_id) {
                        $item["quantidade"] += 1;
                        $game_no_carrinho = true;
                        break;
                    }
                }

                // Se o jogo não estiver no carrinho, adiciona
                if (!$game_no_carrinho) {
                    $_SESSION["carrinho"][] = array("game_id" => $game_id, "quantidade" => 1);
                }
            }

            // Consulta SQL para obter a lista de jogos
            $result = $conn->query("SELECT * FROM jogos");

            // Exibe a lista de jogos
            while ($row = $result->fetch_assoc()) {
                echo "<div class='game'>";
                echo "<h3>{$row['nome']}</h3>";
                echo "<p>Preço: R$ {$row['preco']}</p>";
                echo "<form action='process_add_to_cart.php' method='post'>";
                echo "<input type='hidden' name='jogos_id' value='{$row['jogos_id']}'>";
                echo "<button type='submit'>Adicionar ao Carrinho</button>";
                echo "</form>";
                echo "</div>";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        ?>
    </section>
</body>
</html>