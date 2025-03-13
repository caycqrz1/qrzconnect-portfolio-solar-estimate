
<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Altere para seu usuário do banco de dados
define('DB_PASS', '');         // Altere para sua senha do banco de dados
define('DB_NAME', 'qrzconnect'); // Altere para o nome do seu banco de dados

// Estabelece a conexão com o banco de dados
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    // Define o conjunto de caracteres
    $conn->set_charset("utf8");
    
    return $conn;
}

// Função para sanitizar entradas
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Função para enviar mensagem via WhatsApp
function sendWhatsAppMessage($message) {
    // URL da API do WhatsApp (substitua pelo seu endpoint real)
    $apiUrl = 'https://api.whatsapp.com/send?phone=SEU_NUMERO&text=' . urlencode($message);
    
    // Redirecionamento para WhatsApp web - em produção, use uma API oficial
    // Neste exemplo, apenas registramos uma mensagem para fins de demonstração
    error_log("Mensagem para WhatsApp: " . $message);
    
    // Retorno da URL para abrir no WhatsApp
    return $apiUrl;
}
?>
