<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Criar Conta - Easy Games</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        .navigation-buttons {
            margin-top: 20px;
        }

        .navigation-buttons a {
            margin: 0 10px;
        }
    </style>
</head>
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
                <li><a href="carrinho.php">Carrinho de Compras</a>
            </ul>
        </nav>
    </header>
<body>
    <h1>Criar Conta</h1>
    <form action="process_signup.php" method="post">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Criar Conta</button>
    </form>

</body>
</html>