<?php
include __DIR__ . '/../database/conn.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier Properties - Real Estate Excellence</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
            flex: 1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Ubuntu Condensed", sans-serif;
            font-weight: 400;
            font-style: normal;
            line-height: 1.6;
            color: #333;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
        }

        .container {
            max-width: 1900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            position: relative;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            transition: all 0.3s ease;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 10px;
            z-index: 1001;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #333;
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Mobile Menu Overlay */
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
        }

        /* Main Content */
        .main-content {
            padding: 4rem 0;
        }

        .hero {
            
            text-align: center;
            color: white;
            /* margin-bottom: 4rem; */
          padding: 2em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;

            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-button {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .cta-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Sections */
        .section {
            display: none;
            /* background: rgba(255, 255, 255, 0.95); */
            backdrop-filter: blur(10px);
            /* border-radius: 20px; */
            padding: 3rem;
            margin: 2rem 0;
        
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); */
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section.active {
            display: block;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Properties Grid */
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
           
        }

        .property-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .property-image {
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            position: relative;
            overflow: hidden;
        }

        .property-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .property-info {
            padding: 1.5rem;
        }

        .property-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .property-meta {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .property-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Services */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }

        /* Contact Form */
        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.2rem 2rem;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .site-footer {
            margin-top: 20em;
            background: #ffffff;
            color: #333;
            padding: 2.5rem 1rem 1rem;
            font-family: 'Segoe UI', sans-serif;
            border-top: 1px solid #ddd;
            font-size: 0.95rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Top section with 2 rows (logo + links/social) */
        .footer-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        /* Footer logo */
        .footer-logo {
            text-align: center;
        }

        .footer-logo h2 {
            font-size: 1.8rem;
            color: #667eea;
            margin-bottom: 0.4rem;
        }

        .footer-logo p {
            color: #666;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Footer links + social icons in one row on desktop */
        .footer-links,
        .footer-social {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .footer-links a,
        .footer-social a {
            color: #444;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #764ba2;
        }

        .footer-social a {
            font-size: 1.4rem;
        }

        .footer-social a:hover {
            color: #667eea;
        }

        /* Footer bottom */
        .footer-bottom {
            border-top: 1px solid #eee;
            padding-top: 1rem;
            text-align: center;
            color: #888;
            font-size: 0.85rem;
        }

        /* Responsive adjustments */
        @media (min-width: 768px) {
            .footer-top {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                text-align: left;
            }

            .footer-logo {
                text-align: left;
                flex: 1;
            }

            .footer-links,
            .footer-social {
                justify-content: flex-start;
            }

            .footer-links {
                flex: 1;
            }

            .footer-social {
                flex: 1;
                justify-content: flex-end;
            }
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 280px;
                height: 100vh;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                padding: 80px 2rem 2rem;
                box-shadow: -5px 0 20px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                gap: 0;
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links li {
                width: 100%;
                margin-bottom: 1rem;
            }

            .nav-links a {
                display: block;
                width: 100%;
                padding: 1rem;
                border-radius: 10px;
                font-size: 1.1rem;
            }

            .mobile-menu-overlay {
                display: block;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .properties-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .section {
                padding: 2rem 1rem;
                margin: 1rem 0;
            }

            .section h2 {
                font-size: 2rem;
            }

            .container {
                padding: 0 15px;
            }

            .main-content {
                padding: 2rem 0;
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 1.5rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .properties-grid {
                grid-template-columns: 1fr;
            }

            .service-card {
                padding: 1.5rem;
            }

            .nav-links {
                width: 100%;
                right: -100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="container">
            <a href="#" class="logo" onclick="showSection('home')">Premier Properties</a>

            <!-- Hamburger Menu -->
            <div class="hamburger" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Mobile Menu Overlay -->
            <div class="mobile-menu-overlay" onclick="closeMobileMenu()"></div>

            <!-- Navigation Links -->
            <ul class="nav-links">
                <li><a href="#" onclick="showSection('home')" class="active">Home</a></li>
                <li><a href="#" onclick="showSection('services')">Services</a></li>
                <li><a href="#" onclick="showSection('admin')">Admin Panel</a></li>
                <li><a href="#" onclick="showSection('contact')">About The Developer</a></li>
            </ul>
        </nav>
    </header>


    <div class="hero">
        <h1>Find Your Dream Property</h1>
        <p>Premier Properties - Your trusted partner in real estate excellence</p>

    </div>

    <!-- Home Section -->
    <section id="home" class="section active">