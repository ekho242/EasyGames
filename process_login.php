<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Login</title>
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
$password = $_POST['password'];

// Verifica as credenciais na tabela "usuarios"
$sql = "SELECT * FROM usuarios WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Login bem-sucedido, define a variável de sessão
        session_start();
        $_SESSION['username'] = $username;
        echo "Login bem-sucedido! Redirecionando para a página inicial...";
        header("refresh:3;url=index.php"); // Redireciona após 3 segundos
    } else {
        echo "Senha incorreta. Tente novamente.";
        echo "<a href='index.php'><button>Voltar para a Página Inicial</button></a>";
    }
} else {
    echo "Nome de usuário não encontrado. Tente novamente.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
</body>
</html>