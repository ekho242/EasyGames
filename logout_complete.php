<?php
session_start();

// Destroi todas as variáveis de sessão
session_destroy();

// Redireciona para a página intermediária com a mensagem de logout
header("Location: logout_message.php");
exit();
?>
