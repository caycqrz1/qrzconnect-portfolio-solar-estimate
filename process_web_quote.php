
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form fields
    $name = $_POST['web-name'] ?? '';
    $email = $_POST['web-email'] ?? '';
    $phone = $_POST['web-phone'] ?? '';
    $company = $_POST['web-company'] ?? '';
    $projectType = $_POST['web-type'] ?? '';
    $budget = $_POST['web-budget'] ?? '';
    $description = $_POST['web-description'] ?? '';
    $deadline = $_POST['web-deadline'] ?? '';
    
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
    
    // Process the form data (in a real scenario, you would save to database or send email)
    
    // Email content
    $to = "contato@qrzconnect.com"; // Change this to your email
    $subject = "Nova solicitação de orçamento web";
    
    $message = "Nova solicitação de orçamento web:\n\n";
    $message .= "Nome: " . $name . "\n";
    $message .= "E-mail: " . $email . "\n";
    $message .= "Telefone: " . $phone . "\n";
    $message .= "Empresa: " . $company . "\n";
    $message .= "Tipo de projeto: " . $projectType . "\n";
    $message .= "Orçamento: " . $budget . "\n";
    $message .= "Prazo estimado: " . $deadline . "\n";
    $message .= "Descrição: " . $description . "\n";
    
    $headers = "From: " . $email;
    
    // Uncomment to send email in production
    // mail($to, $subject, $message, $headers);
    
    // For demonstration purposes, we'll just show a success message
    echo '<script>
        alert("Obrigado! Sua solicitação de orçamento para desenvolvimento web foi enviada com sucesso. Entraremos em contato em breve.");
        window.location.href = "index.php";
    </script>';
}
