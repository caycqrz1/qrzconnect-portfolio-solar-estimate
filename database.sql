
-- Criar o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS qrzconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE qrzconnect;

-- Tabela para orçamentos web
CREATE TABLE IF NOT EXISTS web_quotes (
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
);

-- Tabela para orçamentos solar
CREATE TABLE IF NOT EXISTS solar_quotes (
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
);

-- Tabela para usuários admin
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir usuário admin padrão (senha: admin123)
-- Em produção, altere o nome de usuário e senha
INSERT INTO admin_users (username, password) 
VALUES ('admin', '$2y$10$qJlmM.ZXoIFsMixjAkVbruNw0tQvWq/XtCKMPWUHz5Jk5ROVKQUlO');
