<?php
error_reporting(0);
ini_set('display_errors', 0);

$site_name = "AGDATASUB";
$site_email = "support@agdatasub.com";
$phone = "+2348104042332";

try {
    require_once("mobile/home/includes/auto_loader.php");
    $model = new Model();
    $dbh = $model->connectDb();
    if ($dbh) {
        $query = $dbh->query("SELECT * FROM sitesettings WHERE sId=1");
        $settings = $query->fetch(PDO::FETCH_OBJ);
        if ($settings) {
            $site_name = !empty($settings->sitename) ? $settings->sitename : "AGDATASUB";
            $site_email = !empty($settings->email) ? $settings->email : "support@agdatasub.com";
            $phone = !empty($settings->phone) ? $settings->phone : "+2348104042332";
        }
    }
} catch (Exception $e) {
    // Fail silently, use defaults
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="AGDATASUB - Fast, reliable and affordable data, airtime, cable TV subscriptions, electricity bill payments, and educational pins.">
  <title><?php echo htmlspecialchars($site_name); ?> — Cheap Data, Airtime & Bill Payments</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="Logo1.png" />
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- FontAwesome CDN for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --bg-dark: #030712;
      --bg-card: rgba(255, 255, 255, 0.03);
      --bg-card-hover: rgba(255, 255, 255, 0.06);
      --primary: #3b82f6;
      --primary-glow: rgba(59, 130, 246, 0.5);
      --secondary: #8b5cf6;
      --accent: #10b981;
      --text-main: #f3f4f6;
      --text-muted: #9ca3af;
      --border-color: rgba(255, 255, 255, 0.08);
      --glass-blur: 16px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-dark);
      color: var(--text-main);
      line-height: 1.6;
      overflow-x: hidden;
    }

    h1, h2, h3, h4 {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
    }

    /* Gradients and Background Blobs */
    .bg-blobs {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
      pointer-events: none;
    }

    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(120px);
      opacity: 0.15;
    }

    .blob-1 {
      top: -10%;
      left: -10%;
      width: 600px;
      height: 600px;
      background: var(--primary);
    }

    .blob-2 {
      top: 30%;
      right: -10%;
      width: 500px;
      height: 500px;
      background: var(--secondary);
    }

    .blob-3 {
      bottom: -10%;
      left: 20%;
      width: 600px;
      height: 600px;
      background: var(--primary);
    }

    /* Navigation */
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 100;
      background: rgba(3, 7, 18, 0.7);
      backdrop-filter: blur(var(--glass-blur));
      -webkit-backdrop-filter: blur(var(--glass-blur));
      border-bottom: 1px solid var(--border-color);
      transition: all 0.3s ease;
    }

    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 15px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo-area {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: var(--text-main);
    }

    .logo-img {
      height: 42px;
      width: auto;
      object-fit: contain;
      margin-right: 10px;
    }

    .logo-text {
      font-size: 22px;
      font-weight: 800;
      background: linear-gradient(to right, #ffffff, #9ca3af);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 0.5px;
    }

    .nav-menu {
      display: flex;
      list-style: none;
      align-items: center;
      gap: 30px;
    }

    .nav-item a {
      text-decoration: none;
      color: var(--text-muted);
      font-size: 15px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-item a:hover {
      color: var(--primary);
    }

    .nav-buttons {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .btn-login {
      text-decoration: none;
      color: var(--text-main);
      font-size: 15px;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 30px;
      border: 1px solid var(--border-color);
      background: rgba(255, 255, 255, 0.02);
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background: rgba(255, 255, 255, 0.08);
      border-color: var(--text-muted);
    }

    .btn-register {
      text-decoration: none;
      color: #ffffff;
      font-size: 15px;
      font-weight: 600;
      padding: 10px 24px;
      border-radius: 30px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      box-shadow: 0 4px 15px var(--primary-glow);
      transition: all 0.3s ease;
    }

    .btn-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(59, 130, 246, 0.7);
    }

    .menu-toggle {
      display: none;
      font-size: 24px;
      background: none;
      border: none;
      color: var(--text-main);
      cursor: pointer;
    }

    /* Hero Section */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 120px 25px 80px 25px;
      position: relative;
    }

    .hero-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 50px;
      align-items: center;
      width: 100%;
    }

    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 16px;
      border-radius: 50px;
      background: rgba(59, 130, 246, 0.1);
      border: 1px solid rgba(59, 130, 246, 0.2);
      color: #60a5fa;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 25px;
    }

    .hero-tag i {
      font-size: 12px;
    }

    .hero-title {
      font-size: 54px;
      line-height: 1.15;
      margin-bottom: 20px;
      letter-spacing: -1px;
    }

    .hero-title span {
      background: linear-gradient(135deg, #60a5fa, #a78bfa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-desc {
      font-size: 18px;
      color: var(--text-muted);
      margin-bottom: 35px;
      max-width: 550px;
    }

    .hero-ctas {
      display: flex;
      gap: 20px;
    }

    .hero-features-list {
      margin-top: 40px;
      display: flex;
      gap: 25px;
    }

    .hero-feature-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: var(--text-main);
      font-weight: 500;
    }

    .hero-feature-item i {
      color: var(--accent);
    }

    /* Hero Image Graphic */
    .hero-graphic {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .glow-circle {
      position: absolute;
      width: 350px;
      height: 350px;
      border-radius: 50%;
      background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%);
      animation: pulse 4s infinite alternate;
      z-index: 1;
    }

    .phone-mockup {
      width: 300px;
      height: 600px;
      background: #0f172a;
      border: 12px solid #1e293b;
      border-radius: 40px;
      box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), 0 0 40px rgba(59, 130, 246, 0.2);
      position: relative;
      z-index: 2;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .phone-notch {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 140px;
      height: 25px;
      background: #1e293b;
      border-bottom-left-radius: 18px;
      border-bottom-right-radius: 18px;
      z-index: 10;
    }

    .phone-screen {
      flex: 1;
      padding: 40px 20px 20px 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);
    }

    .mock-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .mock-logo {
      height: 24px;
      width: auto;
    }

    .mock-profile {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #3b82f6;
    }

    .mock-wallet {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 16px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .mock-wallet-title {
      font-size: 11px;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .mock-wallet-bal {
      font-size: 24px;
      font-weight: 700;
      color: #fff;
      margin-top: 5px;
      font-family: 'Outfit', sans-serif;
    }

    .mock-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin-bottom: 20px;
    }

    .mock-grid-item {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 12px;
      padding: 12px 5px;
      text-align: center;
      font-size: 10px;
      font-weight: 600;
      color: var(--text-muted);
    }

    .mock-grid-item i {
      font-size: 16px;
      color: var(--primary);
      margin-bottom: 6px;
      display: block;
    }

    .mock-footer-nav {
      background: rgba(255,255,255,0.05);
      border-radius: 30px;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
    }

    .mock-footer-item {
      font-size: 16px;
      color: var(--text-muted);
    }

    .mock-footer-item.active {
      color: var(--primary);
    }

    /* Floating Badges */
    .floating-badge {
      position: absolute;
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      z-index: 5;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .floating-badge-1 {
      top: 15%;
      left: -15%;
      animation: float 5s infinite ease-in-out;
    }

    .floating-badge-2 {
      bottom: 20%;
      right: -10%;
      animation: float 6s infinite ease-in-out 1s;
    }

    .badge-icon {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: rgba(16, 185, 129, 0.15);
      color: var(--accent);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .floating-badge-2 .badge-icon {
      background: rgba(59, 130, 246, 0.15);
      color: var(--primary);
    }

    .badge-details h4 {
      font-size: 14px;
      color: #fff;
    }

    .badge-details p {
      font-size: 11px;
      color: var(--text-muted);
    }

    /* Services Section */
    .services {
      padding: 100px 25px;
      position: relative;
    }

    .section-header {
      text-align: center;
      max-width: 600px;
      margin: 0 auto 60px auto;
    }

    .section-tag {
      font-size: 14px;
      font-weight: 700;
      color: var(--primary);
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-bottom: 12px;
      display: block;
    }

    .section-title {
      font-size: 38px;
      margin-bottom: 15px;
    }

    .section-desc {
      color: var(--text-muted);
      font-size: 16px;
    }

    .services-grid {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
    }

    .service-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 24px;
      padding: 35px 30px;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .service-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1) 0%, transparent 60%);
      z-index: 1;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-5px);
      background: var(--bg-card-hover);
      border-color: rgba(59, 130, 246, 0.25);
      box-shadow: 0 10px 30px -10px rgba(3, 7, 18, 0.8), 0 0 15px rgba(59, 130, 246, 0.05);
    }

    .service-card:hover::before {
      opacity: 1;
    }

    .service-icon {
      width: 54px;
      height: 54px;
      border-radius: 16px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      color: var(--primary);
      margin-bottom: 25px;
      position: relative;
      z-index: 2;
      transition: all 0.3s ease;
    }

    .service-card:hover .service-icon {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 4px 15px var(--primary-glow);
    }

    .service-title {
      font-size: 20px;
      margin-bottom: 12px;
      position: relative;
      z-index: 2;
    }

    .service-desc {
      color: var(--text-muted);
      font-size: 14px;
      position: relative;
      z-index: 2;
    }

    /* Features Section */
    .features {
      padding: 100px 25px;
      background: rgba(0,0,0,0.2);
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }

    .features-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
    }

    .features-content {
      padding-right: 20px;
    }

    .feature-list {
      margin-top: 40px;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .feature-row {
      display: flex;
      gap: 20px;
    }

    .feature-row-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: rgba(139, 92, 246, 0.1);
      border: 1px solid rgba(139, 92, 246, 0.2);
      color: var(--secondary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .feature-row-details h3 {
      font-size: 18px;
      margin-bottom: 6px;
    }

    .feature-row-details p {
      font-size: 14px;
      color: var(--text-muted);
    }

    /* Stats Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
    }

    .stat-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 20px;
      padding: 35px 25px;
      text-align: center;
    }

    .stat-number {
      font-family: 'Outfit', sans-serif;
      font-size: 42px;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 8px;
    }

    .stat-label {
      font-size: 14px;
      color: var(--text-muted);
      font-weight: 500;
    }

    /* Contact Section */
    .contact {
      padding: 100px 25px;
      position: relative;
    }

    .contact-container {
      max-width: 1000px;
      margin: 0 auto;
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 30px;
      padding: 50px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      backdrop-filter: blur(var(--glass-blur));
      -webkit-backdrop-filter: blur(var(--glass-blur));
    }

    .contact-info {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .contact-title {
      font-size: 32px;
      margin-bottom: 15px;
    }

    .contact-desc {
      color: var(--text-muted);
      font-size: 15px;
      margin-bottom: 40px;
    }

    .contact-links {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .contact-link-item {
      display: flex;
      align-items: center;
      gap: 15px;
      color: var(--text-main);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .contact-link-item:hover {
      color: var(--primary);
    }

    .contact-link-item i {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 16px;
    }

    .contact-form form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-size: 13px;
      font-weight: 500;
      color: var(--text-muted);
    }

    .form-input {
      background: rgba(255,255,255,0.02);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 12px 16px;
      color: var(--text-main);
      font-family: inherit;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 10px rgba(59, 130, 246, 0.15);
      background: rgba(255,255,255,0.04);
    }

    textarea.form-input {
      resize: vertical;
      min-height: 120px;
    }

    .btn-submit {
      border: none;
      font-family: inherit;
      cursor: pointer;
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      padding: 14px;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all 0.3s ease;
    }

    .btn-submit:hover {
      box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
    }

    /* Footer */
    footer {
      background: #020617;
      border-top: 1px solid var(--border-color);
      padding: 60px 25px 30px 25px;
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr;
      gap: 50px;
      margin-bottom: 50px;
    }

    .footer-brand p {
      color: var(--text-muted);
      font-size: 14px;
      margin-top: 15px;
      max-width: 320px;
    }

    .footer-links h4 {
      font-size: 16px;
      margin-bottom: 20px;
      color: #fff;
    }

    .footer-links ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .footer-links a {
      text-decoration: none;
      color: var(--text-muted);
      font-size: 14px;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--primary);
    }

    .footer-bottom {
      max-width: 1200px;
      margin: 0 auto;
      padding-top: 30px;
      border-top: 1px solid var(--border-color);
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      color: var(--text-muted);
    }

    /* Animations */
    @keyframes pulse {
      0% { transform: scale(0.9); opacity: 0.5; }
      100% { transform: scale(1.1); opacity: 0.8; }
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }

    /* Responsiveness */
    @media (max-width: 1024px) {
      .hero-title {
        font-size: 42px;
      }
      .hero-container {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 60px;
      }
      .hero-desc {
        margin-left: auto;
        margin-right: auto;
      }
      .hero-ctas {
        justify-content: center;
      }
      .hero-features-list {
        justify-content: center;
      }
      .features-container {
        grid-template-columns: 1fr;
        gap: 50px;
      }
      .features-content {
        padding-right: 0;
        text-align: center;
      }
      .feature-row {
        text-align: left;
      }
      .contact-container {
        grid-template-columns: 1fr;
        padding: 40px 30px;
      }
    }

    @media (max-width: 768px) {
      .nav-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #030712;
        border-bottom: 1px solid var(--border-color);
        padding: 25px;
        flex-direction: column;
        gap: 20px;
        z-index: 99;
      }
      .nav-menu.active {
        display: flex;
      }
      .nav-buttons {
        width: 100%;
        flex-direction: column;
        margin-top: 10px;
      }
      .nav-buttons a {
        width: 100%;
        text-align: center;
      }
      .menu-toggle {
        display: block;
      }
      .footer-container {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .footer-bottom {
        flex-direction: column;
        gap: 15px;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <!-- Background Blobs -->
  <div class="bg-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Header Area -->
  <header>
    <div class="nav-container">
      <a href="#" class="logo-area">
        <img src="Logo1.png" alt="<?php echo htmlspecialchars($site_name); ?>" class="logo-img">
        <span class="logo-text"><?php echo htmlspecialchars($site_name); ?></span>
      </a>
      
      <button class="menu-toggle" id="menuToggle">
        <i class="fa-solid fa-bars"></i>
      </button>

      <ul class="nav-menu" id="navMenu">
        <li class="nav-item"><a href="#">Home</a></li>
        <li class="nav-item"><a href="#services">Services</a></li>
        <li class="nav-item"><a href="#features">Features</a></li>
        <li class="nav-item"><a href="#contact">Contact</a></li>
        <li class="nav-buttons">
          <a href="mobile/#/login" class="btn-login">Login</a>
          <a href="mobile/#/register" class="btn-register">Get Started</a>
        </li>
      </ul>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-container">
      <div class="hero-content">
        <div class="hero-tag">
          <i class="fa-solid fa-bolt"></i>
          <span>Instant Bill Payments & Recharge Portal</span>
        </div>
        <h1 class="hero-title">Experience Fast & <span>Affordable</span> VTU Services</h1>
        <p class="hero-desc">Top up your mobile, buy cheap data bundles, pay cable TV subscriptions, settle electricity bills, and verify NIN/BVN parameters instantly with the best rates in Nigeria.</p>
        
        <div class="hero-ctas">
          <a href="mobile/#/register" class="btn-register">Register Now</a>
          <a href="mobile/#/login" class="btn-login">Login to Portal</a>
        </div>
        
        <div class="hero-features-list">
          <div class="hero-feature-item">
            <i class="fa-solid fa-circle-check"></i>
            <span>Instant Processing</span>
          </div>
          <div class="hero-feature-item">
            <i class="fa-solid fa-circle-check"></i>
            <span>Secure Database</span>
          </div>
          <div class="hero-feature-item">
            <i class="fa-solid fa-circle-check"></i>
            <span>24/7 Portal Support</span>
          </div>
        </div>
      </div>
      
      <div class="hero-graphic">
        <div class="glow-circle"></div>
        <div class="phone-mockup">
          <div class="phone-notch"></div>
          <div class="phone-screen">
            <div class="mock-header">
              <img src="Logo1.png" alt="Logo" class="mock-logo">
              <div class="mock-profile"></div>
            </div>
            
            <div class="mock-wallet">
              <span class="mock-wallet-title">Wallet Balance</span>
              <h2 class="mock-wallet-bal">₦12,500.00</h2>
            </div>
            
            <div class="mock-grid">
              <div class="mock-grid-item">
                <i class="fa-solid fa-wifi"></i>
                Buy Data
              </div>
              <div class="mock-grid-item">
                <i class="fa-solid fa-phone"></i>
                Airtime
              </div>
              <div class="mock-grid-item">
                <i class="fa-solid fa-tv"></i>
                Cable TV
              </div>
              <div class="mock-grid-item">
                <i class="fa-solid fa-lightbulb"></i>
                Electricity
              </div>
              <div class="mock-grid-item">
                <i class="fa-solid fa-graduation-cap"></i>
                Exam PIN
              </div>
              <div class="mock-grid-item">
                <i class="fa-solid fa-id-card"></i>
                KYC NIN
              </div>
            </div>
            
            <div class="mock-footer-nav">
              <i class="fa-solid fa-house mock-footer-item active"></i>
              <i class="fa-solid fa-list mock-footer-item"></i>
              <i class="fa-solid fa-clock-rotate-left mock-footer-item"></i>
              <i class="fa-solid fa-user mock-footer-item"></i>
            </div>
          </div>
        </div>
        
        <!-- Floating Badges -->
        <div class="floating-badge floating-badge-1">
          <div class="badge-icon">
            <i class="fa-solid fa-circle-check"></i>
          </div>
          <div class="badge-details">
            <h4>API Integration</h4>
            <p>Ready for developers</p>
          </div>
        </div>
        
        <div class="floating-badge floating-badge-2">
          <div class="badge-icon">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <div class="badge-details">
            <h4>Secure System</h4>
            <p>Fully SSL Encrypted</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="services" id="services">
    <div class="section-header">
      <span class="section-tag">Our Services</span>
      <h2 class="section-title">What We Offer</h2>
      <p class="section-desc">Get fast access to high-quality telecom and utility solutions tailored specifically for your lifestyle and business.</p>
    </div>
    
    <div class="services-grid">
      <div class="service-card" onclick="window.location.href='mobile/#/login'">
        <div class="service-icon">
          <i class="fa-solid fa-wifi"></i>
        </div>
        <h3 class="service-title">Cheap Mobile Data</h3>
        <p class="service-desc">Buy affordable internet data packages for MTN, Airtel, GLO, and 9mobile at highly competitive prices.</p>
      </div>

      <div class="service-card" onclick="window.location.href='mobile/#/login'">
        <div class="service-icon">
          <i class="fa-solid fa-phone"></i>
        </div>
        <h3 class="service-title">Airtime Top-up</h3>
        <p class="service-desc">Refill your mobile airtime instantly with huge discount percentages on all major telecommunication networks.</p>
      </div>

      <div class="service-card" onclick="window.location.href='mobile/#/login'">
        <div class="service-icon">
          <i class="fa-solid fa-tv"></i>
        </div>
        <h3 class="service-title">Cable TV Sub</h3>
        <p class="service-desc">Renew your DSTV, GOTV, and StarTimes subscriptions instantly without any extra handling fees.</p>
      </div>

      <div class="service-card" onclick="window.location.href='mobile/#/login'">
        <div class="service-icon">
          <i class="fa-solid fa-lightbulb"></i>
        </div>
        <h3 class="service-title">Electricity Bill</h3>
        <p class="service-desc">Purchase prepaid and postpaid electricity meter tokens for AEDC, EKEDC, IKEDC, IBEDC, and more.</p>
      </div>

      <div class="service-card" onclick="window.location.href='mobile/#/login'">
        <div class="service-icon">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <h3 class="service-title">Education PINs</h3>
        <p class="service-desc">Get instant WAEC, NECO, and NABTEB result checker PIN tokens delivered straight to your portal screen.</p>
      </div>

      <div class="service-card" onclick="window.location.href='mobile/#/login'">
        <div class="service-icon">
          <i class="fa-solid fa-id-card"></i>
        </div>
        <h3 class="service-title">Identity Verification</h3>
        <p class="service-desc">Validate your BVN and NIN records instantly via our advanced integrated KYC verification gateways.</p>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="features-container">
      <div class="features-content">
        <span class="section-tag">Why Choose Us</span>
        <h2 class="section-title">Reliable Services You Can Always Rely On</h2>
        <p class="section-desc">We build our system utilizing state of the art automated processing protocols to ensure all purchase requests are processed in milliseconds.</p>
        
        <div class="feature-list">
          <div class="feature-row">
            <div class="feature-row-icon">
              <i class="fa-solid fa-clock"></i>
            </div>
            <div class="feature-row-details">
              <h3>100% Automated System</h3>
              <p>All data orders, bill payments, and top-ups occur instantly without manual intervention.</p>
            </div>
          </div>

          <div class="feature-row">
            <div class="feature-row-icon">
              <i class="fa-solid fa-lock"></i>
            </div>
            <div class="feature-row-details">
              <h3>Secure Transactions</h3>
              <p>All wallets are protected by modern encryption parameters, PIN confirmations, and secure session management.</p>
            </div>
          </div>

          <div class="feature-row">
            <div class="feature-row-icon">
              <i class="fa-solid fa-code"></i>
            </div>
            <div class="feature-row-details">
              <h3>Developer Friendly API</h3>
              <p>Integrate our fast, high-performance API endpoints to sell data and airtime directly on your own custom websites.</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-number">99.9%</div>
          <div class="stat-label">System Uptime</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">24/7</div>
          <div class="stat-label">Instant Deliveries</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">10k+</div>
          <div class="stat-label">Active Users</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">₦0</div>
          <div class="stat-label">Hidden Fees</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="contact" id="contact">
    <div class="contact-container">
      <div class="contact-info">
        <div>
          <h2 class="contact-title">Get in Touch</h2>
          <p class="contact-desc">Have questions about our rates or API integration? Send us a message and our support team will respond promptly.</p>
        </div>
        
        <div class="contact-links">
          <a href="mailto:<?php echo htmlspecialchars($site_email); ?>" class="contact-link-item">
            <i class="fa-solid fa-envelope"></i>
            <span><?php echo htmlspecialchars($site_email); ?></span>
          </a>
          <a href="tel:<?php echo htmlspecialchars($phone); ?>" class="contact-link-item">
            <i class="fa-solid fa-phone"></i>
            <span><?php echo htmlspecialchars($phone); ?></span>
          </a>
          <a href="#" class="contact-link-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>Nigeria</span>
          </a>
        </div>
      </div>
      
      <div class="contact-form">
        <form onsubmit="event.preventDefault(); alert('Message sent successfully! We will contact you soon.'); this.reset();">
          <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" class="form-input" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" class="form-input" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" class="form-input" placeholder="Write your message here..." required></textarea>
          </div>
          <button type="submit" class="btn-submit">
            <span>Send Message</span>
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-brand">
        <a href="#" class="logo-area">
          <img src="Logo1.png" alt="<?php echo htmlspecialchars($site_name); ?>" class="logo-img">
          <span class="logo-text"><?php echo htmlspecialchars($site_name); ?></span>
        </a>
        <p>AGDATASUB is a leading tech portal providing instant mobile recharges, extremely cheap internet bundles, utility bill clearances, and educational cards.</p>
      </div>
      
      <div class="footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#services">Our Services</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#contact">Contact Support</a></li>
        </ul>
      </div>

      <div class="footer-links">
        <h4>User Portal</h4>
        <ul>
          <li><a href="mobile/#/login">Sign In</a></li>
          <li><a href="mobile/#/register">Create Account</a></li>
          <li><a href="mobile/#/recovery">Retrieve Account</a></li>
        </ul>
      </div>
    </div>
    
    <div class="footer-bottom">
      <p>&copy; <?php echo date("Y"); ?> <?php echo htmlspecialchars($site_name); ?>. All rights reserved.</p>
      <p>Powered by Algoprime</p>
    </div>
  </footer>

  <script>
    // Responsive Mobile Menu
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    menuToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
      const icon = menuToggle.querySelector('i');
      if (navMenu.classList.contains('active')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark');
      } else {
        icon.classList.remove('fa-xmark');
        icon.classList.add('fa-bars');
      }
    });

    // Close menu when link is clicked
    document.querySelectorAll('.nav-menu a').forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        const icon = menuToggle.querySelector('i');
        icon.classList.remove('fa-xmark');
        icon.classList.add('fa-bars');
      });
    });
  </script>
</body>
</html>