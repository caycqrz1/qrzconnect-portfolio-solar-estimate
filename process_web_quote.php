
<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form fields
    $name = isset($_POST['web-name']) ? sanitizeInput($_POST['web-name']) : '';
    $email = isset($_POST['web-email']) ? sanitizeInput($_POST['web-email']) : '';
    $phone = isset($_POST['web-phone']) ? sanitizeInput($_POST['web-phone']) : '';
    $company = isset($_POST['web-company']) ? sanitizeInput($_POST['web-company']) : '';
    $projectType = isset($_POST['web-type']) ? sanitizeInput($_POST['web-type']) : '';
    $budget = isset($_POST['web-budget']) ? sanitizeInput($_POST['web-budget']) : '';
    $description = isset($_POST['web-description']) ? sanitizeInput($_POST['web-description']) : '';
    $deadline = isset($_POST['web-deadline']) ? sanitizeInput($_POST['web-deadline']) : '';
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($projectType) || empty($budget) || empty($description)) {
        echo '<script>
            alert("Por favor, preencha todos os campos obrigatórios.");
            window.location.href = "index.php#web-orcamento";
        </script>';
        exit;
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
            alert("Por favor, insira um endereço de e-mail válido.");
            window.location.href = "index.php#web-orcamento";
        </script>';
        exit;
    }
    
    // Connect to database
    $conn = connectDB();
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO web_quotes (name, email, phone, company, project_type, budget, description, deadline) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        echo '<script>
            alert("Erro ao preparar a consulta: ' . $conn->error . '");
            window.location.href = "index.php#web-orcamento";
        </script>';
        $conn->close();
        exit;
    }
    
    // Bind parameters
    $stmt->bind_param("ssssssss", $name, $email, $phone, $company, $projectType, $budget, $description, $deadline);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Get the ID of the inserted quote
        $quoteId = $conn->insert_id;
        
        // Create WhatsApp message
        $message = "Novo orçamento WEB (#$quoteId):\n";
        $message .= "Nome: $name\n";
        $message .= "E-mail: $email\n";
        $message .= "Telefone: $phone\n";
        $message .= "Tipo de projeto: $projectType\n";
        $message .= "Orçamento: $budget";
        
        // Get WhatsApp URL
        $whatsappUrl = sendWhatsAppMessage($message);
        
        // Close database connection
        $stmt->close();
        $conn->close();
        
        // Redirect to success page with WhatsApp opening
        echo '<script>
            alert("Obrigado! Sua solicitação de orçamento para desenvolvimento web foi enviada com sucesso. Entraremos em contato em breve.");
            window.open("' . $whatsappUrl . '", "_blank");
            window.location.href = "index.php";
        </script>';
    } else {
        // Error handling
        echo '<script>
            alert("Erro ao salvar o orçamento: ' . $stmt->error . '");
            window.location.href = "index.php#web-orcamento";
        </script>';
        
        // Close database connection
        $stmt->close();
        $conn->close();
    }
}
?>
