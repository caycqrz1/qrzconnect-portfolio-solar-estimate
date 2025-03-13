<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRZConnect - Web & Solar</title>
    <meta name="description" content="Soluções em desenvolvimento web e energia solar para negócios sustentáveis">
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <header id="navbar" class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="#" class="navbar-logo">
                    <span class="logo-text">QRZ<span class="highlight">Connect</span></span>
                </a>
                
                <nav class="navbar-menu">
                    <button class="mobile-menu-btn" id="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <ul class="nav-links" id="nav-links">
                        <li><a href="#sobre" class="nav-link">Sobre</a></li>
                        <li><a href="#servicos" class="nav-link">Serviços</a></li>
                        <li><a href="#portfolio" class="nav-link">Portfólio</a></li>
                        <li><a href="#orcamento" class="nav-link">Orçamentos</a></li>
                        <li><a href="#contato" class="nav-link">Contato</a></li>
                        <li><a href="admin/login.php" class="nav-link admin-link"><i class="fas fa-lock"></i> Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Transformando ideias em<br>realidade <span class="highlight">digital</span></h1>
                <p class="hero-subtitle">
                    Desenvolvimento web personalizado e soluções em energia solar para 
                    impulsionar seu negócio de forma sustentável e inovadora.
                </p>
                <div class="hero-buttons">
                    <a href="#web-orcamento" class="btn btn-light">Orçamento Web</a>
                    <a href="#solar-orcamento" class="btn btn-primary">Orçamento Solar</a>
                </div>
            </div>
        </div>
        <a href="#sobre" class="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>

    <!-- About Section -->
    <section id="sobre" class="section">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <span class="section-tag">Sobre Nós</span>
                    <h2 class="section-title">Quem é a QRZConnect?</h2>
                    <p>
                        Somos uma empresa especializada em desenvolvimento web e energia solar, 
                        comprometida em oferecer soluções tecnológicas que impulsionam negócios 
                        e promovem a sustentabilidade.
                    </p>
                    <p>
                        Nossa equipe reúne profissionais qualificados em programação, design e 
                        engenharia, trabalhando para entregar projetos personalizados com excelência 
                        e inovação.
                    </p>
                    
                    <div class="features-grid">
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div>
                                <h3>Inovação</h3>
                                <p>Soluções atualizadas com as últimas tecnologias</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h3>Personalização</h3>
                                <p>Projetos adaptados às suas necessidades</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div>
                                <h3>Eficiência</h3>
                                <p>Resultados que geram economia real</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h3>Confiabilidade</h3>
                                <p>Garantia e suporte contínuo</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="about-image">
                    <div class="image-wrapper">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                            alt="QRZConnect Team">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="servicos" class="section bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Nossos Serviços</span>
                <h2 class="section-title">O que oferecemos</h2>
                <p class="section-subtitle">
                    Oferecemos soluções completas em desenvolvimento web e energia solar, 
                    atendendo às necessidades específicas de cada cliente.
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon web-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Desenvolvimento Web</h3>
                    <ul class="service-list">
                        <li>Websites responsivos</li>
                        <li>Lojas virtuais</li>
                        <li>Sistemas de gestão</li>
                        <li>Aplicações web personalizadas</li>
                        <li>Otimização para SEO</li>
                    </ul>
                    <a href="#web-orcamento" class="btn btn-outline">Solicitar orçamento</a>
                </div>

                <div class="service-card">
                    <div class="service-icon solar-icon">
                        <i class="fas fa-solar-panel"></i>
                    </div>
                    <h3>Energia Solar</h3>
                    <ul class="service-list">
                        <li>Projetos residenciais</li>
                        <li>Sistemas comerciais</li>
                        <li>Instalação profissional</li>
                        <li>Manutenção preventiva</li>
                        <li>Monitoramento remoto</li>
                    </ul>
                    <a href="#solar-orcamento" class="btn btn-outline">Solicitar orçamento</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Nosso Portfólio</span>
                <h2 class="section-title">Projetos realizados</h2>
                <p class="section-subtitle">
                    Conheça alguns dos nossos trabalhos em desenvolvimento web e energia solar 
                    que entregaram resultados excepcionais para nossos clientes.
                </p>
            </div>

            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <button class="filter-btn" data-filter="web">Web</button>
                <button class="filter-btn" data-filter="solar">Solar</button>
            </div>

            <div class="portfolio-grid">
                <div class="portfolio-item" data-category="web">
                    <div class="portfolio-image">
                        <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="E-commerce Premium">
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-header">
                            <h3>E-commerce Premium</h3>
                            <span class="badge web-badge">Web</span>
                        </div>
                        <p>Loja virtual completa com sistema de pagamentos integrado e gestão de estoque.</p>
                    </div>
                </div>

                <div class="portfolio-item" data-category="web">
                    <div class="portfolio-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Sistema de Gestão">
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-header">
                            <h3>Sistema de Gestão</h3>
                            <span class="badge web-badge">Web</span>
                        </div>
                        <p>Dashboard administrativo para controle completo de operações empresariais.</p>
                    </div>
                </div>

                <div class="portfolio-item" data-category="solar">
                    <div class="portfolio-image">
                        <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Instalação Residencial">
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-header">
                            <h3>Instalação Residencial</h3>
                            <span class="badge solar-badge">Solar</span>
                        </div>
                        <p>Projeto solar para residência com economia de 90% na conta de energia.</p>
                    </div>
                </div>

                <div class="portfolio-item" data-category="web">
                    <div class="portfolio-image">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Landing Page Conversão">
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-header">
                            <h3>Landing Page Conversão</h3>
                            <span class="badge web-badge">Web</span>
                        </div>
                        <p>Página de captura otimizada para conversões com alto desempenho em SEO.</p>
                    </div>
                </div>

                <div class="portfolio-item" data-category="solar">
                    <div class="portfolio-image">
                        <img src="https://images.unsplash.com/photo-1595437193398-f24279553f4f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Instalação Comercial">
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-header">
                            <h3>Instalação Comercial</h3>
                            <span class="badge solar-badge">Solar</span>
                        </div>
                        <p>Sistema solar para empresa com retorno de investimento em 36 meses.</p>
                    </div>
                </div>

                <div class="portfolio-item" data-category="web">
                    <div class="portfolio-image">
                        <img src="https://images.unsplash.com/photo-1517292987719-0369a794ec0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Website Institucional">
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-header">
                            <h3>Website Institucional</h3>
                            <span class="badge web-badge">Web</span>
                        </div>
                        <p>Site responsivo com design premium e otimizado para mecanismos de busca.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Web Quote Section -->
    <section id="web-orcamento" class="section bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Orçamento Web</span>
                <h2 class="section-title">Solicite um orçamento para seu projeto web</h2>
                <p class="section-subtitle">
                    Preencha o formulário abaixo com os detalhes do seu projeto. Nossa equipe 
                    entrará em contato com você em até 24 horas úteis.
                </p>
            </div>

            <div class="form-container">
                <form id="web-form" action="process_web_quote.php" method="POST">
                    <div class="form-group">
                        <label for="web-name">Nome completo*</label>
                        <input type="text" id="web-name" name="web-name" required>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="web-email">E-mail*</label>
                            <input type="email" id="web-email" name="web-email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="web-phone">Telefone*</label>
                            <input type="tel" id="web-phone" name="web-phone" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="web-company">Empresa</label>
                        <input type="text" id="web-company" name="web-company">
                    </div>
                    
                    <div class="form-group">
                        <label for="web-type">Tipo de projeto*</label>
                        <select id="web-type" name="web-type" required>
                            <option value="">Selecione uma opção</option>
                            <option value="website">Website institucional</option>
                            <option value="ecommerce">Loja virtual / E-commerce</option>
                            <option value="system">Sistema web</option>
                            <option value="landing">Landing page</option>
                            <option value="redesign">Redesign de site existente</option>
                            <option value="other">Outro</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="web-budget">Orçamento aproximado*</label>
                        <select id="web-budget" name="web-budget" required>
                            <option value="">Selecione uma opção</option>
                            <option value="ate-3000">Até R$ 3.000</option>
                            <option value="3000-5000">R$ 3.000 a R$ 5.000</option>
                            <option value="5000-10000">R$ 5.000 a R$ 10.000</option>
                            <option value="10000-20000">R$ 10.000 a R$ 20.000</option>
                            <option value="acima-20000">Acima de R$ 20.000</option>
                            <option value="nao-definido">Não definido</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="web-description">Descrição do projeto*</label>
                        <textarea id="web-description" name="web-description" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="web-deadline">Prazo estimado para conclusão</label>
                        <select id="web-deadline" name="web-deadline">
                            <option value="">Selecione uma opção</option>
                            <option value="urgente">Urgente (menos de 30 dias)</option>
                            <option value="1-2-meses">1 a 2 meses</option>
                            <option value="2-3-meses">2 a 3 meses</option>
                            <option value="3-6-meses">3 a 6 meses</option>
                            <option value="flexivel">Flexível</option>
                        </select>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Solicitar orçamento</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Solar Quote Section -->
    <section id="solar-orcamento" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Orçamento Solar</span>
                <h2 class="section-title">Solicite um orçamento para energia solar</h2>
                <p class="section-subtitle">
                    Preencha o formulário abaixo com os detalhes do seu projeto. Nossa equipe 
                    entrará em contato com você em até 24 horas úteis.
                </p>
            </div>

            <div class="solar-quote-container">
                <div class="solar-tips">
                    <h3>Dicas para seu orçamento solar</h3>
                    <div class="tips-content">
                        <div class="tip-item">
                            <i class="fas fa-lightbulb tip-icon"></i>
                            <p>Um ar condicionado ligado por 8h seguidas consome cerca de 150kWh.</p>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-shower tip-icon"></i>
                            <p>Chuveiros elétricos podem consumir de 70 a 130kWh por mês.</p>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-tv tip-icon"></i>
                            <p>Uma TV LED de 42" ligada 8h por dia consome cerca de 20kWh por mês.</p>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-utensils tip-icon"></i>
                            <p>Uma geladeira moderna consome entre 30 e 50kWh por mês.</p>
                        </div>
                        <div class="tip-calculator">
                            <p class="calculator-text">Some o consumo médio de sua conta de luz com esses valores para ter uma estimativa mais precisa.</p>
                        </div>
                    </div>
                </div>

                <div class="form-container">
                    <form id="solar-form" action="process_solar_quote.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="solar-name">Nome completo*</label>
                            <input type="text" id="solar-name" name="solar-name" required>
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="solar-email">E-mail*</label>
                                <input type="email" id="solar-email" name="solar-email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="solar-phone">Telefone*</label>
                                <input type="tel" id="solar-phone" name="solar-phone" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-roof">Tipo de telhado*</label>
                            <select id="solar-roof" name="solar-roof" required>
                                <option value="">Selecione uma opção</option>
                                <option value="ceramico">Cerâmico</option>
                                <option value="fibrocimento">Fibrocimento</option>
                                <option value="metalico">Metálico</option>
                                <option value="laje">Laje</option>
                                <option value="solo">Solo (terreno)</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-consumption">Consumo médio mensal (kWh)*</label>
                            <input type="number" id="solar-consumption" name="solar-consumption" min="1" required>
                            <small class="form-tip">Verifique na sua conta de luz o consumo médio mensal</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-location">Local de instalação*</label>
                            <input type="text" id="solar-location" name="solar-location" placeholder="Endereço completo" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-type">Tipo de imóvel*</label>
                            <select id="solar-type" name="solar-type" required>
                                <option value="">Selecione uma opção</option>
                                <option value="casa">Casa</option>
                                <option value="apartamento">Apartamento</option>
                                <option value="comercial">Estabelecimento comercial</option>
                                <option value="industrial">Galpão/Indústria</option>
                                <option value="rural">Área rural</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-bill">Foto da conta de luz*</label>
                            <input type="file" id="solar-bill" name="solar-bill" accept="image/*,.pdf" required>
                            <small class="form-tip">Envie uma foto da sua conta de luz mais recente</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-id-front">Foto RG (frente)*</label>
                            <input type="file" id="solar-id-front" name="solar-id-front" accept="image/*,.pdf" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-id-back">Foto RG (verso)*</label>
                            <input type="file" id="solar-id-back" name="solar-id-back" accept="image/*,.pdf" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="solar-notes">Observações adicionais</label>
                            <textarea id="solar-notes" name="solar-notes" rows="3"></textarea>
                        </div>
                        
                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary">Solicitar orçamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contato" class="section bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Contato</span>
                <h2 class="section-title">Entre em contato</h2>
                <p class="section-subtitle">
                    Estamos disponíveis para responder suas dúvidas e ajudar a encontrar a melhor 
                    solução para suas necessidades.
                </p>
            </div>

            <div class="contact-cards">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>E-mail</h3>
                    <p>Envie um e-mail para nossa equipe. Respondemos em até 24 horas úteis.</p>
                    <a href="mailto:contato@qrzconnect.com">contato@qrzconnect.com</a>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Telefone</h3>
                    <p>Ligue para falar diretamente com um de nossos consultores.</p>
                    <a href="tel:+551199999999">(11) 99999-9999</a>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Endereço</h3>
                    <p>Visite nosso escritório para um atendimento personalizado.</p>
                    <address>
                        Av. Paulista, 1000 - Bela Vista<br>
                        São Paulo - SP, 01310-100
                    </address>
                </div>
            </div>

            <div class="contact-info-container">
                <div class="contact-info">
                    <h3>Horário de atendimento</h3>
                    
                    <div class="hours-list">
                        <div class="hours-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <p class="day">Segunda a Sexta</p>
                                <p class="time">09:00 - 18:00</p>
                            </div>
                        </div>
                        
                        <div class="hours-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <p class="day">Sábado</p>
                                <p class="time">09:00 - 13:00</p>
                            </div>
                        </div>
                        
                        <div class="hours-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <p class="day">Domingo e Feriados</p>
                                <p class="time">Fechado</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-cta">
                        <h4>Agende uma visita</h4>
                        <p>Para um atendimento personalizado, agende uma visita em nosso escritório.</p>
                        <a href="tel:+551199999999" class="btn btn-primary">
                            <i class="fas fa-phone"></i> Agendar visita
                        </a>
                    </div>
                </div>
                
                <div class="contact-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.0825097332897!2d-46.6548701!3d-23.5653691!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0aa315%3A0xd59f9431f2c9776a!2sAv.%20Paulista%2C%20S%C3%A3o%20Paulo%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1636139103313!5m2!1spt-BR!2sbr" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="QRZConnect Location">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <h2 class="footer-logo">
                        QRZ<span class="highlight">Connect</span>
                    </h2>
                    <p>
                        Soluções em desenvolvimento web e energia solar para impulsionar 
                        seu negócio de forma sustentável.
                    </p>
                </div>
                
                <div class="footer-nav">
                    <h3>Navegação</h3>
                    <ul>
                        <li><a href="#home">Início</a></li>
                        <li><a href="#sobre">Sobre</a></li>
                        <li><a href="#servicos">Serviços</a></li>
                        <li><a href="#portfolio">Portfólio</a></li>
                        <li><a href="#contato">Contato</a></li>
                        <li><a href="admin/login.php">Área Administrativa</a></li>
                    </ul>
                </div>
                
                <div class="footer-quotes">
                    <h3>Orçamentos</h3>
                    <ul>
                        <li><a href="#web-orcamento">Desenvolvimento Web</a></li>
                        <li><a href="#solar-orcamento">Energia Solar</a></li>
                    </ul>
                </div>
                
                <div class="footer-contact">
                    <h3>Contato</h3>
                    <ul>
                        <li>contato@qrzconnect.com</li>
                        <li>(11) 99999-9999</li>
                        <li>
                            Av. Paulista, 1000 - Bela Vista<br>
                            São Paulo - SP, 01310-100
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> QRZConnect. Todos os direitos reservados.</p>
                
                <div class="footer-links">
                    <a href="#">Política de Privacidade</a>
                    <a href="#">Termos de Uso</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
