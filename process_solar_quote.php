
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form fields
    $name = $_POST['solar-name'] ?? '';
    $email = $_POST['solar-email'] ?? '';
    $phone = $_POST['solar-phone'] ?? '';
    $roofType = $_POST['solar-roof'] ?? '';
    $consumption = $_POST['solar-consumption'] ?? '';
    $location = $_POST['solar-location'] ?? '';
    $propertyType = $_POST['solar-type'] ?? '';
    $notes = $_POST['solar-notes'] ?? '';
    
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
    
    // File uploads
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
            $fileName = basename($_FILES[$fileField]['name']);
            $targetFilePath = $uploadDir . uniqid() . '_' . $fileName;
            
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            
            // Check if file is a valid image or PDF
            $validExtensions = ["jpg", "jpeg", "png", "pdf"];
            if (!in_array($fileType, $validExtensions)) {
                $fileErrors[] = "Apenas arquivos JPG, PNG e PDF são permitidos.";
                continue;
            }
            
            if (move_uploaded_file($_FILES[$fileField]['tmp_name'], $targetFilePath)) {
                $uploadedFiles[$fileField] = $targetFilePath;
            } else {
                $fileErrors[] = "Erro ao fazer upload de " . $fileName;
            }
        } else {
            $fileErrors[] = "Por favor, envie todos os arquivos necessários.";
        }
    }
    
    if (!empty($fileErrors)) {
        $errorMessage = implode("\n", $fileErrors);
        echo '<script>
            alert("' . $errorMessage . '");
            window.location.href = "index.php#solar-orcamento";
        </script>';
        exit;
    }
    
    // Process the form data (in a real scenario, you would save to database or send email)
    
    // Email content
    $to = "contato@qrzconnect.com"; // Change this to your email
    $subject = "Nova solicitação de orçamento solar";
    
    $message = "Nova solicitação de orçamento solar:\n\n";
    $message .= "Nome: " . $name . "\n";
    $message .= "E-mail: " . $email . "\n";
    $message .= "Telefone: " . $phone . "\n";
    $message .= "Tipo de telhado: " . $roofType . "\n";
    $message .= "Consumo mensal: " . $consumption . " kWh\n";
    $message .= "Local de instalação: " . $location . "\n";
    $message .= "Tipo de imóvel: " . $propertyType . "\n";
    $message .= "Observações: " . $notes . "\n";
    $message .= "Arquivos enviados: " . implode(", ", array_values($uploadedFiles)) . "\n";
    
    $headers = "From: " . $email;
    
    // Uncomment to send email in production
    // mail($to, $subject, $message, $headers);
    
    // For demonstration purposes, we'll just show a success message
    echo '<script>
        alert("Obrigado! Sua solicitação de orçamento para energia solar foi enviada com sucesso. Entraremos em contato em breve.");
        window.location.href = "index.php";
    </script>';
}
