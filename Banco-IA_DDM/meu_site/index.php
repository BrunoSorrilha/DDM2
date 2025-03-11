<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página do Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h1>
    <p>Esta é a sua página de usuário.</p>
    <a href="logout.php">Sair</a>
</body>
</html>