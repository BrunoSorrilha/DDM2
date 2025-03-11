<?php
session_start();
include '../includes/functions.php';

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../user/login.php');
    exit();
}

// Processa a exclusão de um usuário
if (isset($_GET['delete'])) {
    deleteUser ($_GET['delete']);
    header('Location: index.php');
    exit();
}

// Processa a atualização de um usuário
if (isset($_POST['update'])) {
    updateUser ($_POST['id'], $_POST['username'], isset($_POST['is_admin']) ? 1 : 0);
    header('Location: index.php');
    exit();
}

// Obtém todos os usuários
$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Painel de Administração</h1>
    <h2>Usuários</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Admin</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['is_admin'] ? 'Sim' : 'Não'; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                    <label>
                        <input type="checkbox" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>> Admin
                    </label>
                    <div class="action-buttons">
                        <button type="submit" name="update">Atualizar</button>
                        <a href="?delete=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="button-delete">Excluir</a>
                    </div>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="./user/logout.php">Sair</a>
</body>
</html>
