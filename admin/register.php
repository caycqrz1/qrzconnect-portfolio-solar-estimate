
<?php
session_start();
require_once '../config.php';

// Verifica se o usuário está logado como admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$success_message = "";
$error = "";

// Processa o registro de novo administrador
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega os dados do formulário
    $username = isset($_POST['username']) ? sanitizeInput($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    
    // Validações
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Por favor, preencha todos os campos.";
    } elseif ($password !== $confirm_password) {
        $error = "As senhas não conferem.";
    } elseif (strlen($password) < 8) {
        $error = "A senha deve ter pelo menos 8 caracteres.";
    } else {
        // Conecta ao banco de dados
        $conn = connectDB();
        
        // Verifica se o usuário já existe
        $stmt = $conn->prepare("SELECT id FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Nome de usuário já está em uso.";
        } else {
            // Criptografa a senha
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insere o novo usuário
            $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            
            if ($stmt->execute()) {
                $success_message = "Administrador registrado com sucesso!";
            } else {
                $error = "Erro ao registrar o administrador: " . $conn->error;
            }
        }
        
        // Fecha a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Administrador - QRZConnect</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-register {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-error {
            color: #e74c3c;
            background-color: #fde2e2;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        .register-success {
            color: #27ae60;
            background-color: #e3f9ec;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        .admin-nav {
            background-color: #333;
            color: white;
            padding: 10px 0;
        }
        .admin-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .admin-nav li {
            margin-left: 20px;
        }
        .admin-nav a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .admin-nav a:hover {
            background-color: #444;
        }
        .admin-nav .logout {
            color: #ff6b6b;
        }
    </style>
</head>
<body>
    <!-- Admin Navbar -->
    <nav class="admin-nav">
        <div class="container">
            <div class="logo">QRZConnect Admin</div>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="register.php">Registrar Administrador</a></li>
                <li><a href="logout.php" class="logout">Sair</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-register">
        <div class="register-header">
            <h2>Registrar Novo Administrador</h2>
            <p>Adicione um novo usuário com acesso administrativo</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="register-error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success_message)): ?>
            <div class="register-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Nome de Usuário</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
                <small>A senha deve ter pelo menos 8 caracteres.</small>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Senha</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <div class="form-submit">
                <button type="submit" class="btn btn-primary">Registrar Administrador</button>
            </div>
        </form>
    </div>
</body>
</html>
