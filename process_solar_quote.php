
<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form fields
    $name = isset($_POST['solar-name']) ? sanitizeInput($_POST['solar-name']) : '';
    $email = isset($_POST['solar-email']) ? sanitizeInput($_POST['solar-email']) : '';
    $phone = isset($_POST['solar-phone']) ? sanitizeInput($_POST['solar-phone']) : '';
    $roofType = isset($_POST['solar-roof']) ? sanitizeInput($_POST['solar-roof']) : '';
    $consumption = isset($_POST['solar-consumption']) ? intval($_POST['solar-consumption']) : 0;
    $location = isset($_POST['solar-location']) ? sanitizeInput($_POST['solar-location']) : '';
    $propertyType = isset($_POST['solar-type']) ? sanitizeInput($_POST['solar-type']) : '';
    $notes = isset($_POST['solar-notes']) ? sanitizeInput($_POST['solar-notes']) : '';
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($roofType) || empty($consumption) || empty($location) || empty($propertyType)) {
        echo '<script>
            alert("Por favor, preencha todos os campos obrigatórios.");
            window.location.href = "index.php#solar-orcamento";
        </script>';
        exit;
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
            alert("Por favor, insira um endereço de e-mail válido.");
            window.location.href = "index.php#solar-orcamento";
        </script>';
        exit;
    }
    
    // Upload directory
    $uploadDir = "uploads/";
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Process file uploads
    $fileErrors = [];
    $uploadedFiles = [];
    
    $requiredFiles = ['solar-bill', 'solar-id-front', 'solar-id-back'];
    
    foreach ($requiredFiles as $fileField) {
        if (isset($_FILES[$fileField]) && $_FILES[$fileField]['error'] === UPLOAD_ERR_OK) {
            $originalFileName = basename($_FILES[$fileField]['name']);
            $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
            
            // Generate a unique filename
            $newFileName = uniqid() . '_' . $originalFileName;
            $targetFilePath = $uploadDir . $newFileName;
            
            // Check if file is a valid image or PDF
            $validExtensions = ["jpg", "jpeg", "png", "pdf"];
            if (!in_array($fileExtension, $validExtensions)) {
                $fileErrors[] = "Apenas arquivos JPG, PNG e PDF são permitidos.";
                continue;
            }
            
            if (move_uploaded_file($_FILES[$fileField]['tmp_name'], $targetFilePath)) {
                $uploadedFiles[$fileField] = $targetFilePath;
            } else {
                $fileErrors[] = "Erro ao fazer upload de " . $originalFileName;
            }
        } else {
            $fileErrors[] = "Por favor, envie todos os arquivos necessários.";
        }
    }
    
    if (!empty($fileErrors)) {
        $errorMessage = implode("\n", $fileErrors);
        echo '<script>
            alert("' . str_replace('"', '\"', $errorMessage) . '");
            window.location.href = "index.php#solar-orcamento";
        </script>';
        exit;
    }
    
    // Connect to database
    $conn = connectDB();
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO solar_quotes (name, email, phone, roof_type, consumption, location, property_type, notes, bill_path, id_front_path, id_back_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        echo '<script>
            alert("Erro ao preparar a consulta: ' . $conn->error . '");
            window.location.href = "index.php#solar-orcamento";
        </script>';
        $conn->close();
        exit;
    }
    
    // Bind parameters
    $stmt->bind_param("ssssississs", $name, $email, $phone, $roofType, $consumption, $location, $propertyType, $notes, $uploadedFiles['solar-bill'], $uploadedFiles['solar-id-front'], $uploadedFiles['solar-id-back']);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Get the ID of the inserted quote
        $quoteId = $conn->insert_id;
        
        // Create WhatsApp message
        $message = "Novo orçamento SOLAR (#$quoteId):\n";
        $message .= "Nome: $name\n";
        $message .= "E-mail: $email\n";
        $message .= "Telefone: $phone\n";
        $message .= "Tipo de telhado: $roofType\n";
        $message .= "Consumo: $consumption kWh\n";
        $message .= "Local: $location";
        
        // Get WhatsApp URL
        $whatsappUrl = sendWhatsAppMessage($message);
        
        // Close database connection
        $stmt->close();
        $conn->close();
        
        // Redirect to success page with WhatsApp opening
        echo '<script>
            alert("Obrigado! Sua solicitação de orçamento para energia solar foi enviada com sucesso. Entraremos em contato em breve.");
            window.open("' . $whatsappUrl . '", "_blank");
            window.location.href = "index.php";
        </script>';
    } else {
        // Error handling
        echo '<script>
            alert("Erro ao salvar o orçamento: ' . $stmt->error . '");
            window.location.href = "index.php#solar-orcamento";
        </script>';
        
        // Close database connection
        $stmt->close();
        $conn->close();
    }
}
?>
