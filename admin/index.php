
<?php
session_start();
require_once '../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Função para obter orçamentos web
function getWebQuotes() {
    $conn = connectDB();
    $result = $conn->query("SELECT * FROM web_quotes ORDER BY created_at DESC");
    
    $quotes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quotes[] = $row;
        }
    }
    
    $conn->close();
    return $quotes;
}

// Função para obter orçamentos solar
function getSolarQuotes() {
    $conn = connectDB();
    $result = $conn->query("SELECT * FROM solar_quotes ORDER BY created_at DESC");
    
    $quotes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quotes[] = $row;
        }
    }
    
    $conn->close();
    return $quotes;
}

// Obter o tipo de orçamento a ser exibido (web ou solar)
$quoteType = isset($_GET['type']) ? $_GET['type'] : 'web';

// Obter os orçamentos com base no tipo selecionado
$quotes = ($quoteType === 'solar') ? getSolarQuotes() : getWebQuotes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - QRZConnect</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-container {
            padding: 20px;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .admin-nav {
            display: flex;
            gap: 10px;
        }
        .admin-tab {
            padding: 10px 20px;
            background-color: #f0f0f0;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
        }
        .admin-tab.active {
            background-color: var(--primary-color);
            color: white;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .admin-table th,
        .admin-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .admin-table th {
            background-color: #f4f4f4;
            font-weight: 600;
        }
        .admin-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        .quote-id {
            font-weight: bold;
            color: var(--primary-color);
        }
        .quote-date {
            color: #666;
            font-size: 0.9em;
        }
        .quote-detail-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 8px;
            width: 80%;
            max-width: 800px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .close-modal {
            color: #777;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close-modal:hover {
            color: #333;
        }
        .quote-detail {
            margin-top: 20px;
        }
        .quote-detail-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .quote-detail-label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .quote-files {
            margin-top: 20px;
        }
        .quote-file {
            margin-bottom: 10px;
        }
        .quote-file-link {
            color: #3498db;
            text-decoration: none;
        }
        .quote-file-link:hover {
            text-decoration: underline;
        }
        .admin-logout {
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }
        .no-quotes {
            text-align: center;
            padding: 50px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Painel Administrativo</h1>
            <div class="admin-actions">
                <a href="logout.php" class="admin-logout">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
        
        <div class="admin-nav">
            <a href="index.php?type=web" class="admin-tab <?php echo $quoteType === 'web' ? 'active' : ''; ?>">
                <i class="fas fa-laptop-code"></i> Orçamentos Web
            </a>
            <a href="index.php?type=solar" class="admin-tab <?php echo $quoteType === 'solar' ? 'active' : ''; ?>">
                <i class="fas fa-solar-panel"></i> Orçamentos Solar
            </a>
        </div>
        
        <div class="admin-content">
            <?php if (empty($quotes)): ?>
                <div class="no-quotes">
                    <i class="fas fa-inbox" style="font-size: 48px; opacity: 0.3;"></i>
                    <p>Nenhum orçamento encontrado.</p>
                </div>
            <?php else: ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <?php if ($quoteType === 'web'): ?>
                                <th>Tipo de Projeto</th>
                            <?php else: ?>
                                <th>Consumo</th>
                            <?php endif; ?>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotes as $quote): ?>
                            <tr>
                                <td class="quote-id">#<?php echo $quote['id']; ?></td>
                                <td class="quote-date"><?php echo date('d/m/Y H:i', strtotime($quote['created_at'])); ?></td>
                                <td><?php echo $quote['name']; ?></td>
                                <td><?php echo $quote['email']; ?></td>
                                <td><?php echo $quote['phone']; ?></td>
                                <?php if ($quoteType === 'web'): ?>
                                    <td><?php echo $quote['project_type']; ?></td>
                                <?php else: ?>
                                    <td><?php echo $quote['consumption']; ?> kWh</td>
                                <?php endif; ?>
                                <td>
                                    <button class="quote-detail-btn" onclick="showQuoteDetails('<?php echo $quoteType; ?>', <?php echo htmlspecialchars(json_encode($quote), ENT_QUOTES, 'UTF-8'); ?>)">
                                        Ver detalhes
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Modal para detalhes do orçamento -->
    <div id="quoteModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2 id="modal-title">Detalhes do Orçamento</h2>
            <div id="quote-detail" class="quote-detail"></div>
        </div>
    </div>
    
    <script>
        // Função para exibir detalhes do orçamento
        function showQuoteDetails(type, quote) {
            const modal = document.getElementById('quoteModal');
            const modalTitle = document.getElementById('modal-title');
            const quoteDetail = document.getElementById('quote-detail');
            
            // Define o título do modal
            modalTitle.textContent = type === 'web' ? 
                'Detalhes do Orçamento Web #' + quote.id : 
                'Detalhes do Orçamento Solar #' + quote.id;
            
            // Limpa o conteúdo anterior
            quoteDetail.innerHTML = '';
            
            // Adiciona os detalhes comuns
            let detailsHTML = `
                <div class="quote-detail-item">
                    <span class="quote-detail-label">Data:</span>
                    ${new Date(quote.created_at).toLocaleString('pt-BR')}
                </div>
                <div class="quote-detail-item">
                    <span class="quote-detail-label">Nome:</span>
                    ${quote.name}
                </div>
                <div class="quote-detail-item">
                    <span class="quote-detail-label">E-mail:</span>
                    ${quote.email}
                </div>
                <div class="quote-detail-item">
                    <span class="quote-detail-label">Telefone:</span>
                    ${quote.phone}
                </div>
            `;
            
            // Adiciona detalhes específicos com base no tipo de orçamento
            if (type === 'web') {
                detailsHTML += `
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Empresa:</span>
                        ${quote.company || 'Não informado'}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Tipo de Projeto:</span>
                        ${quote.project_type}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Orçamento:</span>
                        ${quote.budget}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Prazo:</span>
                        ${quote.deadline || 'Não informado'}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Descrição:</span>
                        <div style="white-space: pre-wrap;">${quote.description}</div>
                    </div>
                `;
            } else {
                detailsHTML += `
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Tipo de Telhado:</span>
                        ${quote.roof_type}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Consumo:</span>
                        ${quote.consumption} kWh
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Local:</span>
                        ${quote.location}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Tipo de Imóvel:</span>
                        ${quote.property_type}
                    </div>
                    <div class="quote-detail-item">
                        <span class="quote-detail-label">Observações:</span>
                        <div style="white-space: pre-wrap;">${quote.notes || 'Nenhuma observação'}</div>
                    </div>
                    <div class="quote-files">
                        <h3>Arquivos Enviados</h3>
                        <div class="quote-file">
                            <a href="../${quote.bill_path}" target="_blank" class="quote-file-link">
                                <i class="fas fa-file"></i> Conta de Luz
                            </a>
                        </div>
                        <div class="quote-file">
                            <a href="../${quote.id_front_path}" target="_blank" class="quote-file-link">
                                <i class="fas fa-file"></i> RG (Frente)
                            </a>
                        </div>
                        <div class="quote-file">
                            <a href="../${quote.id_back_path}" target="_blank" class="quote-file-link">
                                <i class="fas fa-file"></i> RG (Verso)
                            </a>
                        </div>
                    </div>
                `;
            }
            
            // Adiciona o conteúdo ao modal
            quoteDetail.innerHTML = detailsHTML;
            
            // Exibe o modal
            modal.style.display = 'block';
        }
        
        // Função para fechar o modal
        function closeModal() {
            document.getElementById('quoteModal').style.display = 'none';
        }
        
        // Fecha o modal quando o usuário clica fora dele
        window.onclick = function(event) {
            const modal = document.getElementById('quoteModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
