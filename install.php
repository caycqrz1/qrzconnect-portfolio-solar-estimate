
<?php
require_once 'config.php';

// Função para criar o banco de dados
function createDatabase() {
    // Conectar ao servidor MySQL sem selecionar um banco de dados
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    
    // Criar o banco de dados se não existir
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Banco de dados criado com sucesso!</p>";
    } else {
        echo "<p>Erro ao criar banco de dados: " . $conn->error . "</p>";
    }
    
    $conn->close();
}

// Função para criar as tabelas
function createTables() {
    $conn = connectDB();
    
    // Tabela para orçamentos web
    $sql_web = "CREATE TABLE IF NOT EXISTS web_quotes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        company VARCHAR(100),
        project_type VARCHAR(50) NOT NULL,
        budget VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
        deadline VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql_web) === TRUE) {
        echo "<p>Tabela de orçamentos web criada com sucesso!</p>";
    } else {
        echo "<p>Erro ao criar tabela de orçamentos web: " . $conn->error . "</p>";
    }
    
    // Tabela para orçamentos solar
    $sql_solar = "CREATE TABLE IF NOT EXISTS solar_quotes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        roof_type VARCHAR(50) NOT NULL,
        consumption INT NOT NULL,
        location VARCHAR(255) NOT NULL,
        property_type VARCHAR(50) NOT NULL,
        notes TEXT,
        bill_path VARCHAR(255) NOT NULL,
        id_front_path VARCHAR(255) NOT NULL,
        id_back_path VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql_solar) === TRUE) {
        echo "<p>Tabela de orçamentos solar criada com sucesso!</p>";
    } else {
        echo "<p>Erro ao criar tabela de orçamentos solar: " . $conn->error . "</p>";
    }
    
    // Tabela para usuários admin
    $sql_users = "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql_users) === TRUE) {
        echo "<p>Tabela de usuários admin criada com sucesso!</p>";
    } else {
        echo "<p>Erro ao criar tabela de usuários admin: " . $conn->error . "</p>";
    }
    
    $conn->close();
}

// Função para criar usuário admin padrão
function createDefaultAdmin() {
    $conn = connectDB();
    
    // Verificar se já existe um usuário admin
    $check = $conn->query("SELECT COUNT(*) as count FROM admin_users");
    $result = $check->fetch_assoc();
    
    if ($result['count'] == 0) {
        // Criar usuário admin padrão (username: admin, senha: admin123)
        $username = 'admin';
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        
        if ($stmt->execute()) {
            echo "<p>Usuário admin criado com sucesso! (usuário: admin, senha: admin123)</p>";
        } else {
            echo "<p>Erro ao criar usuário admin: " . $stmt->error . "</p>";
        }
        
        $stmt->close();
    } else {
        echo "<p>Usuário admin já existe.</p>";
    }
    
    $conn->close();
}

// Verificar a pasta de uploads
function checkUploadsFolder() {
    $uploadDir = "uploads/";
    
    if (!file_exists($uploadDir)) {
        if (mkdir($uploadDir, 0755, true)) {
            echo "<p>Pasta de uploads criada com sucesso!</p>";
        } else {
            echo "<p>Erro ao criar pasta de uploads. Por favor, crie manualmente uma pasta chamada 'uploads' com permissão de escrita.</p>";
        }
    } else {
        echo "<p>Pasta de uploads já existe.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação - QRZConnect</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .install-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .install-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .install-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .success {
            color: #27ae60;
            font-weight: bold;
        }
        .error {
            color: #e74c3c;
            font-weight: bold;
        }
        .install-actions {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-header">
            <h1>QRZConnect - Instalação</h1>
            <p>Este script irá configurar o banco de dados para o site QRZConnect.</p>
        </div>
        
        <div class="install-section">
            <h2>1. Criando banco de dados</h2>
            <?php createDatabase(); ?>
        </div>
        
        <div class="install-section">
            <h2>2. Criando tabelas</h2>
            <?php createTables(); ?>
        </div>
        
        <div class="install-section">
            <h2>3. Criando usuário administrador</h2>
            <?php createDefaultAdmin(); ?>
        </div>
        
        <div class="install-section">
            <h2>4. Verificando pastas</h2>
            <?php checkUploadsFolder(); ?>
        </div>
        
        <div class="install-actions">
            <p>Instalação concluída! Agora você pode acessar o site e o painel administrativo.</p>
            <a href="index.php" class="btn btn-primary">Ir para o site</a>
            <a href="admin/login.php" class="btn btn-light">Acessar painel administrativo</a>
        </div>
        
        <div class="install-section" style="margin-top: 20px; border: 1px dashed #e74c3c; color: #e74c3c;">
            <h2>Importante!</h2>
            <p>Por questões de segurança, <strong>você deve excluir este arquivo (install.php)</strong> após a instalação.</p>
            <p>Além disso, altere a senha do administrador após o primeiro login.</p>
        </div>
    </div>
</body>
</html>
