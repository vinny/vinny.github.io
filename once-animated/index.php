<?php
// Script de envio de e-mail em PHP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- CONFIGURAÇÃO ---
    $toEmail = 'vinny@vinny.quest'; // O e-mail que receberá a mensagem
    $fromName = 'Contato Site'; // Nome do remetente
    $fromEmail = 'contato@seusite.com'; // E-mail do remetente (deve ser do seu domínio)
    
    // --- DADOS DO FORMULÁRIO ---
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    
    // --- VALIDAÇÃO ---
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // --- PREPARA O E-MAIL ---
        $subject = "Nova mensagem de contato de $name";
        $htmlContent = "
            <h2>Nova Mensagem do Site</h2>
            <p><b>Nome:</b> " . htmlspecialchars($name) . "</p>
            <p><b>Email:</b> " . htmlspecialchars($email) . "</p>
            <p><b>Mensagem:</b><br/>" . nl2br(htmlspecialchars($message)) . "</p>
        ";
        
        // --- CABEÇALHOS ---
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From:' . $fromName . ' <' . $fromEmail . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";
        
        // --- ENVIA O E-MAIL E REDIRECIONA ---
        if (mail($toEmail, $subject, $htmlContent, $headers)) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?status=success#contact');
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?status=error#contact');
        }
    } else {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?status=validation_error#contact');
    }
    exit(); // Para a execução do script após o redirecionamento
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="page_title">Once Animated - Criador de Storybooks Infantis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #14b3ab;
            --secondary: #4169e1;
            --accent: #ff6b6b;
            --light: #fff9f0;
            --dark: #212529;
            --success: #4ade80;
            --warning: #fbbf24;
            --info: #60a5fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff5e6 0%, #e6f7ff 100%);
            color: var(--dark);
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .navbar-brand span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--dark) !important;
            transition: all 0.3s ease;
            border-radius: 50px;
            padding: 8px 20px;
            margin: 0 2px;
        }

        .nav-link:hover, .language-switcher .dropdown-toggle:hover {
            color: white !important;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 4px 15px rgba(20, 179, 171, 0.3);
        }
        
        /* Language Switcher */
        .language-switcher .dropdown-toggle {
            border-radius: 50px;
            padding: 8px 12px !important;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .language-switcher .dropdown-toggle::after {
            display: none;
        }
        .language-switcher .dropdown-menu {
            min-width: auto;
        }
        .language-switcher .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .lang-flag {
            width: 24px;
            height: auto;
        }

        /* Hero Section */
        .hero-section {
            padding: 150px 0 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%2314b3ab" fill-opacity="0.1" d="M0,128L48,138.7C96,149,192,171,288,165.3C384,160,480,128,576,128C672,128,768,160,864,176C960,192,1056,192,1152,181.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') bottom no-repeat;
            background-size: cover;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            color: var(--dark);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: var(--dark);
            margin-bottom: 30px;
            max-width: 700px;
        }

        .btn-custom {
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(20, 179, 171, 0.4);
        }

        .btn-secondary-custom {
            background: white;
            color: var(--primary);
            border: 3px solid var(--primary);
        }

        .btn-secondary-custom:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-5px);
        }

        .app-screenshot {
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            transform: perspective(1000px) rotateY(-10deg);
            transition: transform 0.5s ease;
            border: 10px solid white;
        }

        .app-screenshot:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        .floating-element {
            position: absolute;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 30px;
            bottom: -40px;
            left: -40px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Features */
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .section-title p {
            font-size: 1.3rem;
            color: var(--dark);
            max-width: 800px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            border-radius: 25px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .feature-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(20, 179, 171, 0.1), rgba(65, 105, 225, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 40px;
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .feature-card h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--dark);
            font-size: 1.1rem;
        }

        /* Steps */
        .steps-section {
            background: linear-gradient(135deg, #fff0f5 0%, #e6f7ff 100%);
            padding: 100px 0;
        }

        .step-card {
            background: white;
            border-radius: 25px;
            padding: 50px 30px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: all 0.4s ease;
            border: none;
            height: 100%;
        }

        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .step-number {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            box-shadow: 0 10px 20px rgba(20, 179, 171, 0.3);
        }

        .step-icon {
            font-size: 4rem;
            margin-bottom: 30px;
            color: var(--primary);
        }

        .step-card h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .step-card p {
            color: var(--dark);
            font-size: 1.2rem;
        }

        /* Pricing */
        .pricing-section {
            padding: 100px 0;
            background: white;
        }

        .pricing-card {
            background: white;
            border-radius: 30px;
            padding: 50px 30px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: all 0.4s ease;
            border: 3px solid transparent;
            height: 100%;
        }

        .pricing-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.popular {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .popular-tag {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 8px 25px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(20, 179, 171, 0.3);
        }

        .pricing-card.popular:hover {
            transform: scale(1.05) translateY(-15px);
        }

        .pricing-card h3 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .price {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            color: var(--primary);
        }

        .price span {
            font-size: 1.2rem;
            color: var(--dark);
        }

        .pricing-features {
            list-style: none;
            margin: 40px 0;
            text-align: left;
        }

        .pricing-features li {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.1rem;
        }

        .pricing-features li:last-child {
            border-bottom: none;
        }

        .check-icon {
            color: var(--success);
            font-size: 1.2rem;
        }

        /* CTA */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 3rem;
            margin-bottom: 25px;
        }

        .cta-section p {
            font-size: 1.4rem;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-btn {
            background: white;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
            padding: 18px 40px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            background: var(--light);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 70px 0 30px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .footer-logo span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }

        .footer-logo img {
            height: 40px;
        }

        .footer-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 1.1rem;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid #343a40;
            color: #adb5bd;
            font-size: 1rem;
            margin-top: 50px;
        }
        
        /* Modals */
        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .modal-title {
            font-weight: 700;
        }
        .accordion-button:not(.collapsed) {
            color: var(--dark);
            background-color: rgba(20, 179, 171, 0.1);
        }
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(20, 179, 171, 0.25);
        }

        #contactForm .form-control {
            border-radius: 15px;
            padding: 12px 20px;
        }
        #contactForm .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(20, 179, 171, 0.25);
        }
        
        #contact-status .status-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        #contact-status .text-success {
            color: var(--success) !important;
        }
        #contact-status .text-danger {
            color: var(--accent) !important;
        }


        /* Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .app-screenshot {
                transform: none;
                margin-top: 50px;
            }
            
            .floating-element {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 120px 0 80px;
            }
            
            .hero-title {
                font-size: 2.3rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn-custom {
                width: 100%;
            }
            
            .section-title h2 {
                font-size: 2.2rem;
            }
            
            .pricing-card.popular {
                transform: scale(1);
            }
            
            .pricing-card.popular:hover {
                transform: translateY(-15px);
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .section-title p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./img/logo.png" alt="Once Animated Logo">
                <span data-key="app_name">Once Animated</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home" data-key="nav_home">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features" data-key="nav_features">Recursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works" data-key="nav_how_it_works">Como Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing" data-key="nav_pricing">Planos</a>
                    </li>
                    <li class="nav-item dropdown language-switcher">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="#" onclick="setLanguage('pt-BR')"><img src="https://flagcdn.com/w20/br.png" class="lang-flag"> Português</a></li>
                            <li><a class="dropdown-item" href="#" onclick="setLanguage('en-US')"><img src="https://flagcdn.com/w20/us.png" class="lang-flag"> English</a></li>
                            <li><a class="dropdown-item" href="#" onclick="setLanguage('es-ES')"><img src="https://flagcdn.com/w20/es.png" class="lang-flag"> Español</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title" data-key="hero_title">Crie Histórias <span>Mágicas</span> para Crianças</h1>
                    <p class="hero-subtitle" data-key="hero_subtitle">Transforme a imaginação das crianças em histórias encantadoras com nosso aplicativo de criação de storybooks interativos.</p>
                    <div class="d-flex flex-wrap gap-3 mb-4 hero-buttons">
                        <a href="https://play.google.com/store/apps/details?id=com.vinny.onceanimated" target="_blank" class="btn btn-custom btn-primary-custom" data-key="download_button"><i class="fas fa-rocket me-2"></i>Baixar Agora</a>
                    </div>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-mobile-alt text-primary me-2" style="font-size: 1.5rem;"></i>
                            <span data-key="availability">Disponível para Android</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 position-relative">
                    <div class="app-screenshot">
                        <div id="appCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="./img/img1.png" class="d-block w-100" alt="Interface do aplicativo Once Animated - Tela de Criação">
                                </div>
                                <div class="carousel-item">
                                    <img src="./img/img2.png" class="d-block w-100" alt="Interface do aplicativo Once Animated - Tela de Leitura">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="floating-element">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="features">
        <div class="container py-5">
            <div class="section-title animate-on-scroll">
                <h2 data-key="features_title">Recursos Mágicos</h2>
                <p data-key="features_subtitle">Descubra como o Once Animated transforma a imaginação das crianças em histórias encantadoras com nossos recursos exclusivos.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h3 data-key="feature1_title">Personagens Mágicos</h3>
                        <p data-key="feature1_text">Escolha até 5 personagens encantadores para sua história</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-mountain"></i>
                        </div>
                        <h3 data-key="feature2_title">Cenários Encantados</h3>
                        <p data-key="feature2_text">Selecione um cenário mágico para a aventura começar</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 data-key="feature3_title">Objetos Mágicos</h3>
                        <p data-key="feature3_text">Adicione até 5 objetos mágicos com poderes especiais</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 data-key="feature4_title">Efeitos Especiais</h3>
                        <p data-key="feature4_text">Inclua efeitos mágicos para tornar sua história ainda mais emocionante</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="steps-section" id="how-it-works">
        <div class="container py-5">
            <div class="section-title animate-on-scroll">
                <h2 data-key="how_it_works_title">Como Funciona</h2>
                <p data-key="how_it_works_subtitle">Criar histórias mágicas nunca foi tão fácil. Siga estes passos simples:</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card animate-on-scroll">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h3 data-key="step1_title">Escolha seus Personagens</h3>
                        <p data-key="step1_text">Selecione até 5 personagens encantadores que serão protagonistas da sua história.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card animate-on-scroll">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-mountain"></i>
                        </div>
                        <h3 data-key="step2_title">Defina o Cenário</h3>
                        <p data-key="step2_text">Escolha um cenário mágico onde a aventura acontecerá, desde florestas encantadas até castelos do céu.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card animate-on-scroll">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 data-key="step3_title">Crie e Leia</h3>
                        <p data-key="step3_text">Adicione efeitos especiais, objetos mágicos e nomeie sua história. Em seguida, leia ou escute a narração automática.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section" id="pricing">
        <div class="container py-5">
            <div class="section-title animate-on-scroll">
                <h2 data-key="pricing_title">Planos</h2>
                <p data-key="pricing_subtitle">Escolha o plano perfeito para você e suas crianças. Todos os planos incluem acesso a todas as funcionalidades básicas.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-5">
                    <div class="pricing-card animate-on-scroll">
                        <h3 data-key="free_plan_title">Grátis</h3>
                        <ul class="pricing-features">
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature1">Narração automática</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature2">Até 10 histórias guardadas na sua biblioteca</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature4">25 personagens</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature5">15 cenários</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature6">15 objetos mágicos</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature7">15 efeitos especiais</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="free_feature8">Totalizando 70 itens gratuitos disponíveis no app</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="pricing-card popular animate-on-scroll">
                        <div class="popular-tag" data-key="pro_tag">Mais Popular</div>
                        <h3 data-key="pro_plan_title">Pro</h3>
                        <ul class="pricing-features">
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature1">Narração automática</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature2">Inclui todos os itens do plano Grátis</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature3">Criação ilimitada de historias</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature5">Exportar para MP3</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature6">Exportar para PDF</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature7">60 personagens exclusivos</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature8">12 cenários exclusivos</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature9">12 objetos mágicos exclusivos</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature10">12 efeitos especiais exclusivos</span></li>
                            <li><i class="fas fa-check check-icon"></i> <span data-key="pro_feature11">Totalizando 96 itens exclusivos adicionados ao app com a compra do pacote PRO.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container py-5">
            <h2 class="animate-on-scroll" data-key="cta_title">Pronto para Criar Histórias Mágicas?</h2>
            <p class="animate-on-scroll" data-key="cta_subtitle">Junte-se a milhares de pais, professores e crianças que já estão usando o Once Animated para estimular a imaginação e o amor pela leitura.</p>
            <a href="https://play.google.com/store/apps/details?id=com.vinny.onceanimated" target="_blank" class="cta-btn animate-on-scroll" data-key="download_button"><i class="fas fa-rocket me-2"></i>Baixar Agora</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <a href="#" class="footer-logo mb-4 d-inline-block text-decoration-none">
                        <img src="./img/logo.png" alt="Once Animated Logo">
                        <span data-key="app_name">Once Animated</span>
                    </a>
                    <p class="mb-4" data-key="footer_description">Criando histórias mágicas para inspirar a imaginação das crianças.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-title text-white" data-key="footer_support">Suporte</h4>
                    <ul class="footer-links">
                        <li><a href="#faq" data-key="footer_faq" data-bs-toggle="modal" data-bs-target="#faqModal">FAQ</a></li>
                        <li><a href="#privacy" data-key="footer_privacy" data-bs-toggle="modal" data-bs-target="#privacyModal">Política de Privacidade</a></li>
                        <li><a href="#terms" data-key="footer_terms" data-bs-toggle="modal" data-bs-target="#termsModal">Termos de Serviço</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-title text-white" data-key="footer_contact">Contato</h4>
                    <ul class="footer-links">
                         <li><a href="#contact" data-bs-toggle="modal" data-bs-target="#contactModal"><i class="fas fa-envelope me-2"></i>vinny@vinny.quest</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- FAQ Modal -->
    <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel" data-key="faq_title">FAQ das Funcionalidades do Once Animated</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="faqAccordion">
                        <!-- Item 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" data-key="faq_q1">
                                    1. Como funciona a geração de histórias no app?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a1">
                                    O Once Animated utiliza tecnologia de ponta para criar histórias personalizadas de forma automática. Você seleciona personagens, cenários, objetos mágicos e efeitos especiais, e nosso sistema gera uma história única com 10 páginas, cada uma contendo um título cativante e texto descritivo.
                                </div>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" data-key="faq_q2">
                                    2. Quais são os recursos gratuitos disponíveis?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a2">
                                    O app oferece uma variedade de conteúdos gratuitos, incluindo: 25 personagens diversos, 15 cenários diferentes, 15 objetos mágicos e 15 efeitos especiais.
                                </div>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" data-key="faq_q3">
                                    3. O que o pacote PRO oferece a mais?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a3">
                                    Com o pacote PRO, você desbloqueia conteúdos exclusivos: 60 personagens premium, 12 cenários especiais, 12 objetos mágicos únicos e 12 efeitos especiais adicionais.
                                </div>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" data-key="faq_q4">
                                    4. Como funciona a narração das histórias?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a4">
                                    Basta tocar no botão de play na tela de leitura para ouvir a história sendo contada com voz clara e expressiva.
                                </div>
                            </div>
                        </div>
                        <!-- Item 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" data-key="faq_q5">
                                    5. É possível ler as histórias off-line?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a5">
                                    Sim, após gerar uma história com conexão à internet, você pode acessá-la e ler off-line a qualquer momento na sua biblioteca pessoal.
                                </div>
                            </div>
                        </div>
                        <!-- Item 6 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" data-key="faq_q6">
                                    6. Como salvo minhas histórias favoritas?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a6">
                                    Todas as histórias que você gera são automaticamente salvas na sua biblioteca. Para marcar como favorita, basta tocar no ícone de coração na tela da história.
                                </div>
                            </div>
                        </div>
                        <!-- Item 7 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" data-key="faq_q7">
                                    7. O app funciona em tablets?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a7">
                                    Sim, o Once Animated é compatível com dispositivos Android, incluindo smartphones e tablets.
                                </div>
                            </div>
                        </div>
                        <!-- Item 8 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight" data-key="faq_q8">
                                    8. Onde posso encontrar minhas histórias geradas?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a8">
                                    Todas as suas histórias ficam armazenadas na Biblioteca, acessível através da aba inferior do app.
                                </div>
                            </div>
                        </div>
                        <!-- Item 9 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine" data-key="faq_q9">
                                    9. Como compartilho minhas histórias?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a9">
                                    Com o pacote PRO adquirido, você pode compartilhar suas histórias usando o botão de compartilhamento, que permite enviar como PDF ou MP3.
                                </div>
                            </div>
                        </div>
                        <!-- Item 10 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen" data-key="faq_q10">
                                    10. O app consome muitos dados?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a10">
                                    A geração de histórias requer conexão com a internet e consome dados. A leitura off-line não consome dados adicionais.
                                </div>
                            </div>
                        </div>
                        <!-- Item 11 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEleven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven" data-key="faq_q11">
                                    11. Como faço para comprar o pacote PRO?
                                </button>
                            </h2>
                            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a11">
                                    Você pode adquirir pacotes PRO na Loja do app usando pagamento via Google Play. Após a compra, os conteúdos ficam imediatamente disponíveis.
                                </div>
                            </div>
                        </div>
                        <!-- Item 12 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwelve">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve" data-key="faq_q12">
                                    12. É possível personalizar o tamanho da fonte?
                                </button>
                            </h2>
                            <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a12">
                                    Sim, nas configurações do app você pode ajustar o tamanho da fonte para tornar a leitura mais confortável.
                                </div>
                            </div>
                        </div>
                         <!-- Item 13 -->
                         <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThirteen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen" data-key="faq_q13">
                                    13. O app é adequado para quais idades?
                                </button>
                            </h2>
                            <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a13">
                                    O Once Animated é projetado para crianças de 4 a 10 anos, mas pode ser apreciado por toda a família.
                                </div>
                            </div>
                        </div>
                         <!-- Item 14 -->
                         <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFourteen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen" data-key="faq_q14">
                                    14. Como posso entrar em contato com o suporte?
                                </button>
                            </h2>
                            <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" data-key="faq_a14">
                                    Você pode entrar em contato através do e-mail no rodapé da página.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel" data-key="privacy_title">Política de Privacidade</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" data-key="privacy_content">
                    <!-- Content will be injected by script -->
                </div>
            </div>
        </div>
    </div>

    <!-- Terms of Service Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel" data-key="terms_title">Termos de Serviço</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" data-key="terms_content">
                    <!-- Content will be injected by script -->
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactModalLabel" data-key="contact_modal_title">Entre em Contato</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="contact-status" class="text-center mb-3" style="display: none;">
                            <!-- Status icon and message will be injected here -->
                        </div>
                        <div class="mb-3">
                            <label for="contact-name" class="form-label" data-key="contact_name_label">Nome</label>
                            <input type="text" class="form-control" id="contact-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact-email" class="form-label" data-key="contact_email_label">E-mail</label>
                            <input type="email" class="form-control" id="contact-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact-message" class="form-label" data-key="contact_message_label">Mensagem</label>
                            <textarea class="form-control" id="contact-message" name="message" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-key="contact_close_button">Fechar</button>
                        <button type="submit" class="btn btn-primary-custom" data-key="contact_send_button">Enviar Mensagem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href && href.length > 1 && !this.hasAttribute('data-bs-toggle')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Animation on scroll
        function animateElements() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        }
        
        window.addEventListener('scroll', animateElements);
        window.addEventListener('load', animateElements);

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('shadow');
            } else {
                navbar.classList.remove('shadow');
            }
        });

        // Internationalization (i18n) script
        const translationsData = {
            'pt-BR': {
                "app_name": "Uma Vez Animado",
                "page_title": "Uma Vez Animado - Criador de Histórias Infantis",
                "nav_home": "Início",
                "nav_features": "Recursos",
                "nav_how_it_works": "Como Funciona",
                "nav_pricing": "Planos",
                "hero_title": "Crie Histórias <span>Mágicas</span> para Crianças",
                "hero_subtitle": "Transforme a imaginação das crianças em histórias encantadoras com nosso aplicativo de criação de storybooks interativos.",
                "download_button": "<i class='fas fa-rocket me-2'></i>Baixar Agora",
                "availability": "Disponível para Android",
                "features_title": "Recursos Mágicos",
                "features_subtitle": "Descubra como o Uma Vez Animado transforma a imaginação das crianças em histórias encantadoras com nossos recursos exclusivos.",
                "feature1_title": "Personagens Mágicos",
                "feature1_text": "Escolha até 5 personagens encantadores para sua história",
                "feature2_title": "Cenários Encantados",
                "feature2_text": "Selecione um cenário mágico para a aventura começar",
                "feature3_title": "Objetos Mágicos",
                "feature3_text": "Adicione até 5 objetos mágicos com poderes especiais",
                "feature4_title": "Efeitos Especiais",
                "feature4_text": "Inclua efeitos mágicos para tornar sua história ainda mais emocionante",
                "how_it_works_title": "Como Funciona",
                "how_it_works_subtitle": "Criar histórias mágicas nunca foi tão fácil. Siga estes passos simples:",
                "step1_title": "Escolha seus Personagens",
                "step1_text": "Selecione até 5 personagens encantadores que serão protagonistas da sua história.",
                "step2_title": "Defina o Cenário",
                "step2_text": "Escolha um cenário mágico onde a aventura acontecerá, desde florestas encantadas até castelos do céu.",
                "step3_title": "Crie e Leia",
                "step3_text": "Adicione efeitos especiais, objetos mágicos e nomeie sua história. Em seguida, leia ou escute a narração automática.",
                "pricing_title": "Planos",
                "pricing_subtitle": "Escolha o plano perfeito para você e suas crianças. Todos os planos incluem acesso a todas as funcionalidades básicas.",
                "free_plan_title": "Grátis",
                "free_feature1": "Narração automática",
                "free_feature2": "Até 10 histórias guardadas na sua biblioteca",
                "free_feature4": "25 personagens",
                "free_feature5": "15 cenários",
                "free_feature6": "15 objetos mágicos",
                "free_feature7": "15 efeitos especiais",
                "free_feature8": "Totalizando 70 itens gratuitos disponíveis no app",
                "pro_plan_title": "Pro",
                "pro_tag": "Mais Popular",
                "pro_feature1": "Narração automática",
                "pro_feature2": "Inclui todos os itens do plano Grátis",
                "pro_feature3": "Criação ilimitada de historias",
                "pro_feature5": "Exportar para MP3",
                "pro_feature6": "Exportar para PDF",
                "pro_feature7": "60 personagens exclusivos",
                "pro_feature8": "12 cenários exclusivos",
                "pro_feature9": "12 objetos mágicos exclusivos",
                "pro_feature10": "12 efeitos especiais exclusivos",
                "pro_feature11": "Totalizando 96 itens exclusivos adicionados ao app com a compra do pacote PRO.",
                "cta_title": "Pronto para Criar Histórias Mágicas?",
                "cta_subtitle": "Junte-se a milhares de pais, professores e crianças que já estão usando o Uma Vez Animado para estimular a imaginação e o amor pela leitura.",
                "footer_description": "Criando histórias mágicas para inspirar a imaginação das crianças.",
                "footer_support": "Suporte",
                "footer_faq": "FAQ",
                "footer_contact": "Contato",
                "contact_modal_title": "Entre em Contato",
                "contact_name_label": "Nome",
                "contact_email_label": "Seu E-mail",
                "contact_message_label": "Mensagem",
                "contact_send_button": "Enviar Mensagem",
                "contact_close_button": "Fechar",
                "contact_success_msg": "Mensagem enviada com sucesso!",
                "contact_error_msg": "Ocorreu um erro, tente novamente.",
                "contact_validation_error_msg": "Por favor, preencha todos os campos corretamente.",
                "faq_title": "FAQ - Perguntas Frequentes",
                "faq_q1": "1. Como funciona a geração de histórias no app?",
                "faq_a1": "O Uma Vez Animado usa inteligência artificial para criar histórias personalizadas. Você seleciona personagens, cenários e objetos, e nosso sistema gera uma história única de 10 páginas, com título e texto para cada uma.",
                "faq_q2": "2. Quais são os recursos gratuitos disponíveis?",
                "faq_a2": "O app oferece uma variedade de conteúdos gratuitos, incluindo: 25 personagens, 15 cenários, 15 objetos mágicos e 15 efeitos especiais.",
                "faq_q3": "3. O que o pacote PRO oferece a mais?",
                "faq_a3": "Com o pacote PRO, você desbloqueia conteúdos exclusivos: 60 personagens premium, 12 cenários especiais, 12 objetos mágicos únicos e 12 efeitos especiais adicionais.",
                "faq_q4": "4. Como funciona a narração das histórias?",
                "faq_a4": "Basta tocar no botão de play na tela de leitura para ouvir a história sendo contada com uma voz clara e expressiva.",
                "faq_q5": "5. É possível ler as histórias off-line?",
                "faq_a5": "Sim! Após gerar uma história online, ela fica salva na sua biblioteca para você ler a qualquer momento, mesmo sem internet.",
                "faq_q6": "6. Como salvo minhas histórias favoritas?",
                "faq_a6": "Todas as histórias que você cria são salvas automaticamente na sua biblioteca. Para marcar uma como favorita, toque no ícone de coração.",
                "faq_q7": "7. O app funciona em tablets?",
                "faq_a7": "Sim, o Uma Vez Animado é compatível com todos os dispositivos Android, incluindo smartphones e tablets.",
                "faq_q8": "8. Onde encontro minhas histórias?",
                "faq_a8": "Todas as suas histórias ficam guardadas na seção 'Biblioteca', que você pode acessar pelo menu inferior do aplicativo.",
                "faq_q9": "9. Como posso compartilhar minhas histórias?",
                "faq_a9": "Com o pacote PRO, você pode usar o botão de compartilhamento para exportar e enviar suas histórias como arquivos PDF ou MP3.",
                "faq_q10": "10. O app consome muitos dados de internet?",
                "faq_a10": "Apenas a criação de uma nova história precisa de internet e consome um pouco de dados. Ler as histórias que já estão salvas não gasta sua internet.",
                "faq_q11": "11. Como faço para comprar o pacote PRO?",
                "faq_a11": "Você pode comprar o pacote PRO diretamente na Loja do app, com pagamento seguro através da Google Play. O acesso é liberado na hora!",
                "faq_q12": "12. Posso mudar o tamanho da letra?",
                "faq_a12": "Sim, nas configurações do app você pode ajustar o tamanho da fonte para uma leitura mais confortável.",
                "faq_q13": "13. Para qual idade o app é recomendado?",
                "faq_a13": "O Uma Vez Animado foi pensado para crianças de 4 a 10 anos, mas a diversão é garantida para toda a família.",
                "faq_q14": "14. Como posso falar com o suporte?",
                "faq_a14": "Você pode entrar em contato conosco pelo e-mail de contato listado no rodapé desta página.",
                "footer_privacy": "Política de Privacidade",
                "footer_terms": "Termos de Serviço",
                "privacy_title": "Política de Privacidade",
                "privacy_content": "<p><strong>Última atualização: 13 de Setembro de 2025</strong></p><p>A sua privacidade e a do seu filho são muito importantes para nós. O Uma Vez Animado foi criado para ser um lugar seguro e divertido.</p><h6>Que informações coletamos?</h6><p>Nós <strong>não</strong> coletamos informações pessoais identificáveis de crianças, como nome, endereço ou fotos.</p><p>Coletamos apenas dados anónimos de uso do aplicativo para nos ajudar a melhorar a experiência, como quais recursos são mais populares e se o aplicativo está a funcionar corretamente. Esses dados não estão ligados a si ou ao seu filho.</p><h6>Como usamos as informações?</h6><p>Os dados anónimos que coletamos são usados exclusivamente para melhorar o nosso aplicativo e corrigir problemas.</p><h6>Contato</h6><p>Se tiver alguma dúvida sobre nossa Política de Privacidade, entre em contato conosco pelo e-mail: vinny@vinny.quest.</p>",
                "terms_title": "Termos de Serviço",
                "terms_content": "<p><strong>Última atualização: 13 de Setembro de 2025</strong></p><p>Bem-vindo ao Uma Vez Animado! Ao usar nosso aplicativo, você concorda com estes termos.</p><h6>Uso do Aplicativo</h6><p>Você pode usar o Uma Vez Animado para criar e ler histórias. É proibido usar o aplicativo para criar conteúdo ofensivo, prejudicial ou inadequado.</p><h6>Conteúdo PRO</h6><p>A compra do pacote PRO dá acesso a itens exclusivos. Essa compra é única e o conteúdo é seu para usar dentro do aplicativo. Não é permitido compartilhar ou vender esses itens.</p><h6>Mudanças nos Termos</h6><p>Podemos atualizar estes termos de tempos em tempos. Notificaremos sobre mudanças importantes.</p><h6>Contato</h6><p>Se tiver alguma dúvida sobre nossos Termos de Serviço, entre em contato conosco pelo e-mail: vinny@vinny.quest.</p>"
              },
            'en-US': {
                "app_name": "Once Animated",
                "page_title": "Once Animated - Kids' Storybook Creator",
                "nav_home": "Home",
                "nav_features": "Features",
                "nav_how_it_works": "How It Works",
                "nav_pricing": "Plans",
                "hero_title": "Create <span>Magical</span> Stories for Kids",
                "hero_subtitle": "Turn children's imagination into enchanting stories with our interactive storybook creation app.",
                "download_button": "<i class='fas fa-rocket me-2'></i>Download Now",
                "availability": "Available for Android",
                "features_title": "Magical Features",
                "features_subtitle": "Discover how Once Animated turns children's imagination into enchanting stories with our exclusive features.",
                "feature1_title": "Magical Characters",
                "feature1_text": "Choose up to 5 charming characters for your story",
                "feature2_title": "Enchanted Scenarios",
                "feature2_text": "Select a magical setting for the adventure to begin",
                "feature3_title": "Magic Objects",
                "feature3_text": "Add up to 5 magic objects with special powers",
                "feature4_title": "Special Effects",
                "feature4_text": "Include magical effects to make your story even more exciting",
                "how_it_works_title": "How It Works",
                "how_it_works_subtitle": "Creating magical stories has never been easier. Follow these simple steps:",
                "step1_title": "Choose your Characters",
                "step1_text": "Select up to 5 charming characters who will be the protagonists of your story.",
                "step2_title": "Set the Scene",
                "step2_text": "Choose a magical scenario where the adventure will take place, from enchanted forests to sky castles.",
                "step3_title": "Create and Read",
                "step3_text": "Add special effects, magic objects, and name your story. Then, read or listen to the automatic narration.",
                "pricing_title": "Plans",
                "pricing_subtitle": "Choose the perfect plan for you and your children. All plans include access to all basic features.",
                "free_plan_title": "Free",
                "free_feature1": "Automatic narration",
                "free_feature2": "Up to 10 stories saved in your library",
                "free_feature4": "25 characters",
                "free_feature5": "15 scenarios",
                "free_feature6": "15 magic objects",
                "free_feature7": "15 special effects",
                "free_feature8": "Totaling 70 free items available in the app",
                "pro_plan_title": "Pro",
                "pro_tag": "Most Popular",
                "pro_feature1": "Automatic narration",
                "pro_feature2": "Includes all items from the Free plan",
                "pro_feature3": "Unlimited story creation",
                "pro_feature5": "Export to MP3",
                "pro_feature6": "Export to PDF",
                "pro_feature7": "60 exclusive characters",
                "pro_feature8": "12 exclusive scenarios",
                "pro_feature9": "12 exclusive magic objects",
                "pro_feature10": "12 exclusive special effects",
                "pro_feature11": "Totaling 96 exclusive items added to the app with the purchase of the PRO package.",
                "cta_title": "Ready to Create Magical Stories?",
                "cta_subtitle": "Join thousands of parents, teachers, and children who are already using Once Animated to stimulate imagination and the love of reading.",
                "footer_description": "Creating magical stories to inspire children's imagination.",
                "footer_support": "Support",
                "footer_faq": "FAQ",
                "footer_contact": "Contact",
                "contact_modal_title": "Get in Touch",
                "contact_name_label": "Name",
                "contact_email_label": "Your Email",
                "contact_message_label": "Message",
                "contact_send_button": "Send Message",
                "contact_close_button": "Close",
                "contact_success_msg": "Message sent successfully!",
                "contact_error_msg": "An error occurred, please try again.",
                "contact_validation_error_msg": "Please fill in all fields correctly.",
                "faq_title": "FAQ - Frequently Asked Questions",
                "faq_q1": "1. How does story generation work in the app?",
                "faq_a1": "Once Animated uses artificial intelligence to create personalized stories. You select characters, scenarios, and objects, and our system generates a unique 10-page story, complete with a title and text for each page.",
                "faq_q2": "2. What free features are available?",
                "faq_a2": "The app offers a variety of free content, including: 25 characters, 15 scenarios, 15 magic objects, and 15 special effects.",
                "faq_q3": "3. What does the PRO package offer extra?",
                "faq_a3": "With the PRO package, you unlock exclusive content: 60 premium characters, 12 special scenarios, 12 unique magic objects, and 12 additional special effects.",
                "faq_q4": "4. How does the story narration work?",
                "faq_a4": "Just tap the play button on the reading screen to hear the story told in a clear and expressive voice.",
                "faq_q5": "5. Can I read stories offline?",
                "faq_a5": "Yes! After generating a story online, it's saved to your library for you to read anytime, even without an internet connection.",
                "faq_q6": "6. How do I save my favorite stories?",
                "faq_a6": "All stories you create are automatically saved to your library. To mark one as a favorite, just tap the heart icon.",
                "faq_q7": "7. Does the app work on tablets?",
                "faq_a7": "Yes, Once Animated is compatible with all Android devices, including smartphones and tablets.",
                "faq_q8": "8. Where do I find my stories?",
                "faq_a8": "All your stories are kept in the 'Library' section, which you can access from the bottom menu of the app.",
                "faq_q9": "9. How can I share my stories?",
                "faq_a9": "With the PRO package, you can use the share button to export and send your stories as PDF or MP3 files.",
                "faq_q10": "10. Does the app use a lot of internet data?",
                "faq_a10": "Only creating a new story requires an internet connection and uses a little bit of data. Reading stories that are already saved does not use your data.",
                "faq_q11": "11. How do I buy the PRO package?",
                "faq_a11": "You can purchase the PRO package directly from the in-app Store, with secure payment through Google Play. Access is granted instantly!",
                "faq_q12": "12. Can I change the font size?",
                "faq_a12": "Yes, in the app's settings, you can adjust the font size for a more comfortable reading experience.",
                "faq_q13": "13. What age is the app recommended for?",
                "faq_a13": "Once Animated is designed for children ages 4 to 10, but it guarantees fun for the whole family.",
                "faq_q14": "14. How can I contact support?",
                "faq_a14": "You can contact us via the contact email listed in the footer of this page.",
                "footer_privacy": "Privacy Policy",
                "footer_terms": "Terms of Service",
                "privacy_title": "Privacy Policy",
                "privacy_content": "<p><strong>Last updated: September 13, 2025</strong></p><p>Your privacy and your child's privacy are very important to us. Once Animated was created to be a safe and fun place.</p><h6>What information do we collect?</h6><p>We <strong>do not</strong> collect personally identifiable information from children, such as name, address, or photos.</p><p>We only collect anonymous app usage data to help us improve the experience, such as which features are most popular and if the app is working correctly. This data is not linked to you or your child.</p><h6>How do we use the information?</h6><p>The anonymous data we collect is used exclusively to improve our application and fix problems.</p><h6>Contact</h6><p>If you have any questions about our Privacy Policy, please contact us at: vinny@vinny.quest.</p>",
                "terms_title": "Terms of Service",
                "terms_content": "<p><strong>Last updated: September 13, 2025</strong></p><p>Welcome to Once Animated! By using our app, you agree to these terms.</p><h6>Use of the Application</h6><p>You may use Once Animated to create and read stories. It is prohibited to use the app to create offensive, harmful, or inappropriate content.</p><h6>PRO Content</h6><p>Purchasing the PRO package gives you access to exclusive items. This is a one-time purchase, and the content is yours to use within the app. Sharing or selling these items is not permitted.</p><h6>Changes to the Terms</h6><p>We may update these terms from time to time. We will notify you of any significant changes.</p><h6>Contact</h6><p>If you have any questions about our Terms of Service, please contact us at: vinny@vinny.quest.</p>"
              },
            'es-ES': {
                "app_name": "Érase Animado",
                "page_title": "Érase Animado - Creador de Cuentos Infantiles",
                "nav_home": "Inicio",
                "nav_features": "Recursos",
                "nav_how_it_works": "Cómo Funciona",
                "nav_pricing": "Planes",
                "hero_title": "Crea Historias <span>Mágicas</span> para Niños",
                "hero_subtitle": "Transforma la imaginación de los niños en cuentos encantadores con nuestra aplicación interactiva para crear libros de cuentos.",
                "download_button": "<i class='fas fa-rocket me-2'></i>Descargar Ahora",
                "availability": "Disponible para Android",
                "features_title": "Recursos Mágicos",
                "features_subtitle": "Descubre cómo Érase Animado transforma la imaginación de los niños en cuentos encantadores con nuestros recursos exclusivos.",
                "feature1_title": "Personajes Mágicos",
                "feature1_text": "Elige hasta 5 personajes encantadores para tu historia",
                "feature2_title": "Escenarios Encantados",
                "feature2_text": "Selecciona un escenario mágico para que comience la aventura",
                "feature3_title": "Objetos Mágicos",
                "feature3_text": "Añade hasta 5 objetos mágicos con poderes especiales",
                "feature4_title": "Efectos Especiales",
                "feature4_text": "Incluye efectos mágicos para que tu historia sea aún más emocionante",
                "how_it_works_title": "Cómo Funciona",
                "how_it_works_subtitle": "Crear historias mágicas nunca ha sido tan fácil. Sigue estos sencillos pasos:",
                "step1_title": "Elige tus Personajes",
                "step1_text": "Selecciona hasta 5 personajes encantadores que serán los protagonistas de tu historia.",
                "step2_title": "Define el Escenario",
                "step2_text": "Elige un escenario mágico donde transcurrirá la aventura, desde bosques encantados hasta castillos en el cielo.",
                "step3_title": "Crea y Lee",
                "step3_text": "Añade efectos especiales, objetos mágicos y dale un nombre a tu historia. Luego, lee o escucha la narración automática.",
                "pricing_title": "Planes",
                "pricing_subtitle": "Elige el plan perfecto para ti y tus hijos. Todos los planes incluyen acceso a todas las funciones básicas.",
                "free_plan_title": "Gratis",
                "free_feature1": "Narración automática",
                "free_feature2": "Hasta 10 historias guardadas en tu biblioteca",
                "free_feature4": "25 personajes",
                "free_feature5": "15 escenarios",
                "free_feature6": "15 objetos mágicos",
                "free_feature7": "15 efectos especiales",
                "free_feature8": "Total de 70 artículos gratuitos disponibles en la aplicación",
                "pro_plan_title": "Pro",
                "pro_tag": "Más Popular",
                "pro_feature1": "Narración automática",
                "pro_feature2": "Incluye todos los artículos del plan Gratis",
                "pro_feature3": "Creación ilimitada de historias",
                "pro_feature5": "Exportar a MP3",
                "pro_feature6": "Exportar a PDF",
                "pro_feature7": "60 personajes exclusivos",
                "pro_feature8": "12 escenarios exclusivos",
                "pro_feature9": "12 objetos mágicos exclusivos",
                "pro_feature10": "12 efectos especiales exclusivos",
                "pro_feature11": "Total de 96 artículos exclusivos añadidos a la aplicación con la compra del paquete PRO.",
                "cta_title": "¿Listo para Crear Historias Mágicas?",
                "cta_subtitle": "Únete a miles de padres, profesores y niños que ya utilizan Érase Animado para estimular la imaginación y el amor por la lectura.",
                "footer_description": "Creando historias mágicas para inspirar la imaginación de los niños.",
                "footer_support": "Soporte",
                "footer_faq": "FAQ",
                "footer_contact": "Contacto",
                "contact_modal_title": "Ponte en Contacto",
                "contact_name_label": "Nombre",
                "contact_email_label": "Tu Email",
                "contact_message_label": "Mensaje",
                "contact_send_button": "Enviar Mensaje",
                "contact_close_button": "Cerrar",
                "contact_success_msg": "¡Mensaje enviado con éxito!",
                "contact_error_msg": "Ocurrió un error, por favor intente de nuevo.",
                "contact_validation_error_msg": "Por favor, rellene todos los campos correctamente.",
                "faq_title": "FAQ - Preguntas Frequentes",
                "faq_q1": "1. ¿Cómo funciona la generación de historias en la app?",
                "faq_a1": "Érase Animado utiliza inteligencia artificial para crear historias personalizadas. Seleccionas personajes, escenarios y objetos, y nuestro sistema genera una historia única de 10 páginas, con un título y texto para cada una.",
                "faq_q2": "2. ¿Qué recursos gratuitos están disponibles?",
                "faq_a2": "La app ofrece una variedad de contenido gratuito, que incluye: 25 personajes, 15 escenarios, 15 objetos mágicos y 15 efectos especiales.",
                "faq_q3": "3. ¿Qué extra ofrece el paquete PRO?",
                "faq_a3": "Con el paquete PRO, desbloqueas contenido exclusivo: 60 personajes premium, 12 escenarios especiales, 12 objetos mágicos únicos y 12 efectos especiales adicionales.",
                "faq_q4": "4. ¿Cómo funciona la narración de las historias?",
                "faq_a4": "Simplemente toca el botón de reproducción en la pantalla de lectura para escuchar la historia contada con una voz clara y expresiva.",
                "faq_q5": "5. ¿Puedo leer las historias sin conexión?",
                "faq_a5": "¡Sí! Después de generar una historia en línea, se guarda en tu biblioteca para que la leas en cualquier momento, incluso sin conexión a internet.",
                "faq_q6": "6. ¿Cómo guardo mis historias favoritas?",
                "faq_a6": "Todas las historias que creas se guardan automáticamente en tu biblioteca. Para marcar una como favorita, solo tienes que tocar el ícono del corazón.",
                "faq_q7": "7. ¿La app funciona en tabletas?",
                "faq_a7": "Sí, Érase Animado es compatible con todos los dispositivos Android, incluidos smartphones y tabletas.",
                "faq_q8": "8. ¿Dónde encuentro mis historias?",
                "faq_a8": "Todas tus historias se guardan en la sección 'Biblioteca', a la que puedes acceder desde el menú inferior de la aplicación.",
                "faq_q9": "9. ¿Cómo puedo compartir mis historias?",
                "faq_a9": "Con el paquete PRO, puedes usar el botón de compartir para exportar y enviar tus historias como archivos PDF o MP3.",
                "faq_q10": "10. ¿La app consume muchos datos de internet?",
                "faq_a10": "Solo la creación de una nueva historia requiere conexión a internet y consume un poco de datos. Leer las historias que ya están guardadas no gasta tus datos.",
                "faq_q11": "11. ¿Cómo compro el paquete PRO?",
                "faq_a11": "Puedes comprar el paquete PRO directamente en la Tienda de la app, con pago seguro a través de Google Play. ¡El acceso se concede al instante!",
                "faq_q12": "12. ¿Puedo cambiar el tamaño de la letra?",
                "faq_a12": "Sí, en los ajustes de la app puedes cambiar el tamaño de la fuente para una lectura más cómoda.",
                "faq_q13": "13. ¿Para qué edad se recomienda la app?",
                "faq_a13": "Érase Animado está diseñado para niños de 4 a 10 años, pero garantiza diversión para toda la familia.",
                "faq_q14": "14. ¿Cómo puedo contactar con el soporte?",
                "faq_a14": "Puedes contactarnos a través del correo electrónico de contacto que aparece en el pie de página de esta página.",
                "footer_privacy": "Política de Privacidad",
                "footer_terms": "Términos de Servicio",
                "privacy_title": "Política de Privacidad",
                "privacy_content": "<p><strong>Última actualización: 13 de septiembre de 2025</strong></p><p>Su privacidad y la de su hijo son muy importantes para nosotros. Érase Animado fue creado para ser un lugar seguro y divertido.</p><h6>¿Qué información recopilamos?</h6><p><strong>No</strong> recopilamos información de identificación personal de niños, como nombre, dirección o fotos.</p><p>Solo recopilamos datos anónimos de uso de la aplicación para ayudarnos a mejorar la experiencia, como qué funciones son más populares y si la aplicación funciona correctamente. Estos datos no están vinculados a usted ni a su hijo.</p><h6>¿Cómo usamos la información?</h6><p>Los datos anónimos que recopilamos se utilizan exclusivamente para mejorar nuestra aplicación y solucionar problemas.</p><h6>Contacto</h6><p>Si tiene alguna pregunta sobre nuestra Política de Privacidad, contáctenos en: vinny@vinny.quest.</p>",
                "terms_title": "Términos de Servicio",
                "terms_content": "<p><strong>Última actualización: 13 de septiembre de 2025</strong></p><p>¡Bienvenido a Érase Animado! Al usar nuestra aplicación, usted acepta estos términos.</p><h6>Uso de la Aplicación</h6><p>Puede usar Érase Animado para crear y leer historias. Está prohibido usar la aplicación para crear contenido ofensivo, dañino o inapropiado.</p><h6>Contenido PRO</h6><p>La compra del paquete PRO le da acceso a artículos exclusivos. Esta es una compra única y el contenido es suyo para usarlo dentro de la aplicación. No se permite compartir ni vender estos artículos.</p><h6>Cambios en los Términos</h6><p>Podemos actualizar estos términos de vez en cuando. Le notificaremos sobre cualquier cambio importante.</p><h6>Contacto</h6><p>Si tiene alguna pregunta sobre nuestros Términos de Servicio, contáctenos en: vinny@vinny.quest.</p>"
              }
        };

        const supportedLangs = ['pt-BR', 'en-US', 'es-ES'];
        let currentLang = 'en-US'; // Default language

        function applyTranslations(translations) {
            document.querySelectorAll('[data-key]').forEach(element => {
                const key = element.getAttribute('data-key');
                if (translations[key]) {
                    element.innerHTML = translations[key];
                }
            });
        }

        function setLanguage(lang) {
            if (!supportedLangs.includes(lang)) {
                lang = currentLang; // Fallback to default
            }
            
            const translations = translationsData[lang];
            applyTranslations(translations);
            
            // Update page language attribute
            document.documentElement.lang = lang;
            
            // Save user preference
            localStorage.setItem('preferredLanguage', lang);
            currentLang = lang;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const userLang = localStorage.getItem('preferredLanguage') || navigator.language || navigator.userLanguage;
            
            let initialLang = 'en-US';
            if (supportedLangs.includes(userLang)) {
                initialLang = userLang;
            } else if (supportedLangs.some(lang => userLang.startsWith(lang.split('-')[0]))) {
                initialLang = supportedLangs.find(lang => userLang.startsWith(lang.split('-')[0]));
            }

            setLanguage(initialLang);

            // Check for hash in URL to open modals
            const hash = window.location.hash;
            const modalMap = {
                '#faq': '#faqModal',
                '#privacy': '#privacyModal',
                '#terms': '#termsModal',
                '#contact': '#contactModal'
            };

            if (modalMap[hash]) {
                const modalId = modalMap[hash];
                const targetModalElement = document.querySelector(modalId);
                if (targetModalElement) {
                    const modal = new bootstrap.Modal(targetModalElement);
                    modal.show();
                    
                    // Handle contact form status display
                    const params = new URLSearchParams(window.location.search);
                    const status = params.get('status');

                    if (modalId === '#contactModal' && status) {
                        const statusDiv = document.getElementById('contact-status');
                        const translations = translationsData[currentLang];
                        let statusIcon = '';
                        let statusMessage = '';
                        let statusClass = '';

                        if (status === 'success') {
                            statusIcon = '<i class="fas fa-check-circle status-icon text-success"></i>';
                            statusMessage = translations.contact_success_msg;
                            statusClass = 'text-success';
                            
                            document.querySelector('#contactForm').querySelectorAll('input, textarea, button').forEach(el => el.disabled = true);
                            
                            setTimeout(() => {
                                modal.hide();
                                document.querySelector('#contactForm').querySelectorAll('input, textarea, button').forEach(el => el.disabled = false);
                                // Clean URL
                                window.history.replaceState(null, null, window.location.pathname + window.location.hash);
                            }, 5000);

                        } else if (status === 'error') {
                            statusIcon = '<i class="fas fa-times-circle status-icon text-danger"></i>';
                            statusMessage = translations.contact_error_msg;
                            statusClass = 'text-danger';
                        } else if (status === 'validation_error') {
                            statusIcon = '<i class="fas fa-exclamation-triangle status-icon text-danger"></i>';
                            statusMessage = translations.contact_validation_error_msg;
                            statusClass = 'text-danger';
                        }
                        
                        if(statusIcon) {
                            statusDiv.innerHTML = `${statusIcon}<p class="${statusClass}">${statusMessage}</p>`;
                            statusDiv.style.display = 'block';
                        }
                    }
                }
            }
        });

    </script>
</body>
</html>

