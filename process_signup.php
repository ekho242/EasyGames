<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Sucesso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "easy_games");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Recebe os dados do formulário
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Armazenar senha de forma segura

    // Insere os dados na tabela "usuarios"
    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Conta criada com sucesso!";
        echo "<br><br>";
        echo "<a href='index.php'><button>Voltar para a Página Inicial</button></a>";
    } else {
        echo "Erro ao criar conta: " . $conn->error;
        echo "<a href='index.php'><button>Voltar para a Página Inicial</button></a>";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>
