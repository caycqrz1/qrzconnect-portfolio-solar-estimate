
<?php
session_start();
require_once '../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Busca os dados do banco
$conn = connectDB();

// Busca orçamentos web
$web_quotes = [];
$web_result = $conn->query("SELECT * FROM web_quotes ORDER BY created_at DESC");
if ($web_result && $web_result->num_rows > 0) {
    while ($row = $web_result->fetch_assoc()) {
        $web_quotes[] = $row;
    }
}

// Busca orçamentos solar
$solar_quotes = [];
$solar_result = $conn->query("SELECT * FROM solar_quotes ORDER BY created_at DESC");
if ($solar_result && $solar_result->num_rows > 0) {
    while ($row = $solar_result->fetch_assoc()) {
        $solar_quotes[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - QRZConnect</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilos para o dashboard admin */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
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
        .dashboard {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .quote-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        .quote-header {
            background-color: #f1f5f9;
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        .quote-table {
            width: 100%;
            border-collapse: collapse;
        }
        .quote-table th, .quote-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .quote-table th {
            background-color: #f8fafc;
            font-weight: 600;
        }
        .quote-table tr:hover {
            background-color: #f9fafb;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-new {
            background-color: #ebf5ff;
            color: #3182ce;
        }
        .status-contacted {
            background-color: #e9f6fd;
            color: #0ea5e9;
        }
        .status-closed {
            background-color: #f0fff4;
            color: #38a169;
        }
        .empty-state {
            padding: 40px;
            text-align: center;
            color: #718096;
        }
        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            background-color: #edf2f7;
            color: #4a5568;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
        }
        .action-btn:hover {
            background-color: #e2e8f0;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .tab.active {
            border-bottom-color: #4299e1;
            color: #4299e1;
            font-weight: 600;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
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

    <div class="dashboard">
        <div class="dashboard-header">
            <h1>Dashboard</h1>
            <div>
                <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
            </div>
        </div>
        
        <div class="tabs">
            <div class="tab active" onclick="showTab('web-tab')">Orçamentos Web</div>
            <div class="tab" onclick="showTab('solar-tab')">Orçamentos Solar</div>
        </div>
        
        <div id="web-tab" class="tab-content active">
            <div class="quote-section">
                <div class="quote-header">
                    <h2>Orçamentos de Desenvolvimento Web</h2>
                </div>
                
                <?php if (count($web_quotes) > 0): ?>
                    <div style="overflow-x: auto;">
                        <table class="quote-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Tipo de Projeto</th>
                                    <th>Orçamento</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($web_quotes as $quote): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($quote['name']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['email']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['project_type']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['budget']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($quote['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="action-btn">Ver detalhes</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <p>Ainda não há orçamentos de desenvolvimento web.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div id="solar-tab" class="tab-content">
            <div class="quote-section">
                <div class="quote-header">
                    <h2>Orçamentos de Energia Solar</h2>
                </div>
                
                <?php if (count($solar_quotes) > 0): ?>
                    <div style="overflow-x: auto;">
                        <table class="quote-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Telhado</th>
                                    <th>Consumo</th>
                                    <th>Tipo de Imóvel</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($solar_quotes as $quote): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($quote['name']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['email']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['roof_type']); ?></td>
                                    <td><?php echo htmlspecialchars($quote['consumption']) . ' kWh'; ?></td>
                                    <td><?php echo htmlspecialchars($quote['property_type']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($quote['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="action-btn">Ver detalhes</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <p>Ainda não há orçamentos de energia solar.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Esconde todos os conteúdos das abas
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove a classe active de todas as abas
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Ativa a aba clicada
            document.getElementById(tabId).classList.add('active');
            
            // Ativa o botão da aba
            event.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>
