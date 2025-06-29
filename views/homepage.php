<?php include __DIR__ . '/../database/conn.php';
$fetch = mysqli_query($conn, "SELECT * FROM tenants WHERE deleted_at IS NULL  AND categories = 'houses' order by id DESC");
include __DIR__ . '/../partials/main.php';

?>
<style>
    .login-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 400px;
        transition: transform 0.3s ease;
        margin: 0 auto;
        position: relative;
    }

    .login-container:hover {
        transform: translateY(-5px);
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo h1 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .logo p {
        color: #7f8c8d;
        font-size: 14px;
        font-weight: 400;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
        font-weight: 500;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-group input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group input:hover {
        border-color: #c3c9d4;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 38px;
        cursor: pointer;
        color: #7f8c8d;
        font-size: 18px;
        user-select: none;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #2c3e50;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        font-size: 14px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #667eea;
    }

    .remember-me label {
        margin-bottom: 0;
        font-weight: 400;
        cursor: pointer;
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #764ba2;
    }

    .login-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        font-family: inherit;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .login-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* WhatsApp Button */
    .whatsapp-btn {
        position: fixed;
        left: 20px;
        bottom: 20px;
        background: #25D366;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
        z-index: 1000;
        animation: pulse 2s infinite;
        text-decoration: none;
    }

    .whatsapp-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.5);
    }

    .whatsapp-btn:active {
        transform: scale(0.95);
    }

    .whatsapp-icon {
        width: 32px;
        height: 32px;
        fill: white;
    }

    .tooltip {
        position: absolute;
        left: 80px;
        top: 50%;
        transform: translateY(-50%);
        font: 1rem/1.7 "Inter", sans-serif;
        background: rgb(204, 19, 204);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .tooltip::before {
        content: '';
        position: absolute;
        left: -5px;
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-right-color: rgb(204, 19, 204);
    }

    .whatsapp-btn:hover .tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateY(-50%) translateX(10px);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
        }

        50% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.6), 0 0 0 10px rgba(37, 211, 102, 0.1);
        }

        100% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
        }
    }

    /* Loading Animation */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, .3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Error Message */
    .error-message {
        background: #fee;
        color: #c53030;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        border: 1px solid #feb2b2;
        display: none;
    }

    /* Success Message */
    .success-message {
        background: #f0fff4;
        color: #38a169;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        border: 1px solid #9ae6b4;
        display: none;
    }

    /* Responsive Design */

    /* Large Desktops (1200px and up) */
    @media (min-width: 1200px) {
        .login-container {
            max-width: 450px;
            padding: 50px;
        }

        .logo h1 {
            font-size: 32px;
        }

        .whatsapp-btn {
            width: 70px;
            height: 70px;
            left: 30px;
            bottom: 30px;
        }

        .whatsapp-icon {
            width: 38px;
            height: 38px;
        }
    }

    /* Medium Desktops (992px to 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .login-container {
            max-width: 420px;
            padding: 45px;
        }
    }

    /* Tablets (768px to 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .login-container {
            max-width: 380px;
            padding: 35px;
            margin: 20px auto;
        }

        .logo h1 {
            font-size: 26px;
        }

        .form-group input {
            padding: 14px 18px;
            font-size: 15px;
        }

        .login-btn {
            padding: 14px;
            font-size: 15px;
        }

        .whatsapp-btn {
            width: 55px;
            height: 55px;
            left: 15px;
            bottom: 15px;
        }

        .whatsapp-icon {
            width: 28px;
            height: 28px;
        }

        .tooltip {
            left: 75px;
            font-size: 13px;
        }
    }

    /* Small Tablets/Large Phones (576px to 767px) */
    @media (min-width: 576px) and (max-width: 767px) {
        .login-container {
            max-width: 350px;
            padding: 30px;
            margin: 15px auto;
            border-radius: 16px;
        }

        .logo h1 {
            font-size: 24px;
        }

        .logo p {
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 12px 16px;
            font-size: 15px;
            border-radius: 10px;
        }

        .form-options {
            margin-bottom: 25px;
            font-size: 13px;
        }

        .login-btn {
            padding: 13px;
            font-size: 15px;
            border-radius: 10px;
        }

        .whatsapp-btn {
            width: 50px;
            height: 50px;
            left: 15px;
            bottom: 15px;
        }

        .whatsapp-icon {
            width: 26px;
            height: 26px;
        }

        .tooltip {
            left: 70px;
            font-size: 12px;
            padding: 6px 10px;
        }
    }

    /* Mobile Phones (up to 575px) */
    @media (max-width: 575px) {
        body {
            padding: 10px;
        }

        .login-container {
            max-width: 320px;
            padding: 25px 20px;
            margin: 10px auto;
            border-radius: 14px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .login-container:hover {
            transform: none;
        }

        .logo {
            margin-bottom: 25px;
        }

        .logo h1 {
            font-size: 22px;
        }

        .logo p {
            font-size: 12px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-size: 13px;
            margin-bottom: 6px;
        }

        .form-group input {
            padding: 12px 14px;
            font-size: 16px;
            /* Prevent zoom on iOS */
            border-radius: 8px;
        }

        .password-toggle {
            right: 12px;
            top: 35px;
            font-size: 16px;
        }

        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .remember-me {
            order: 2;
        }

        .forgot-password {
            order: 1;
            align-self: flex-end;
        }

        .login-btn {
            padding: 12px;
            font-size: 14px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .login-btn:hover {
            transform: none;
        }

        .whatsapp-btn {
            width: 45px;
            height: 45px;
            left: 10px;
            bottom: 10px;
        }

        .whatsapp-icon {
            width: 22px;
            height: 22px;
        }

        .tooltip {
            display: none;
        }
    }

    /* Extra Small Phones (up to 360px) */
    @media (max-width: 360px) {
        .login-container {
            max-width: 280px;
            padding: 20px 15px;
            margin: 5px auto;
        }

        .logo h1 {
            font-size: 20px;
        }

        .form-group input {
            padding: 10px 12px;
            font-size: 16px;
        }

        .login-btn {
            padding: 10px;
            font-size: 13px;
        }

        .whatsapp-btn {
            width: 40px;
            height: 40px;
            left: 8px;
            bottom: 8px;
        }

        .whatsapp-icon {
            width: 20px;
            height: 20px;
        }
    }

    /* Landscape Orientation for Mobile */
    @media (max-width: 767px) and (orientation: landscape) {
        body {
            padding: 5px;
        }

        .login-container {
            margin: 5px auto;
            padding: 20px;
        }

        .logo {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-options {
            margin-bottom: 15px;
        }
    }

    /* Accessibility - Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }

        .login-container:hover,
        .login-btn:hover,
        .whatsapp-btn:hover {
            transform: none;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .login-container {
            background: rgba(45, 55, 72, 0.95);
            color: #e2e8f0;
        }

        .logo h1 {
            color: #e2e8f0;
        }

        .logo p {
            color: #a0aec0;
        }

        .form-group label {
            color: #e2e8f0;
        }

        .form-group input {
            background: rgba(74, 85, 104, 0.3);
            border-color: #4a5568;
            color: #e2e8f0;
        }

        .form-group input:focus {
            background: rgba(74, 85, 104, 0.5);
            border-color: #667eea;
        }

        .password-toggle {
            color: #a0aec0;
        }

        .password-toggle:hover {
            color: #e2e8f0;
        }
    }
</style>

<h2 style="font-size: 2em;text-align:center;margin:2em;">HOUSES FOR SALE AND RENT </h2>



<div class="properties-grid">
    <?php
    if (mysqli_num_rows($fetch) > 0) {
        while ($tenantdetail = mysqli_fetch_assoc($fetch)) {
    ?>
            <a href="#" class="property-card" onclick="showPropertyModal(1)">
                <div class="property-image">
                    <img src="../imageuploads/<?= $tenantdetail['image_path'] ?>" alt="Property Image">
                    <span class="property-badge"><?= $tenantdetail['status'] ?></span>
                </div>
                <div class="property-info">
                    <div class="property-price">$<?= number_format($tenantdetail['rent']) ?>/month</div>
                    <h3><?= $tenantdetail['property'] ?></h3>
                    <p><?= $tenantdetail['notes'] ?></p>
                    <p><i class="fas fa-user"></i> Added By: <?= $tenantdetail['added_by'] ?></p>
                    <div class="property-meta">
                        <span><i class="fas fa-bed"></i> 4</span>
                        <span><i class="fas fa-bath"></i> 3</span>
                        <span><i class="fas fa-ruler-combined"></i> 2,450 sqft</span>
                    </div>
                    <div class="property-actions">
                        <span class="btn btn-sm btn-outline">View Details</span>
                    </div>
                </div>
            </a>
    <?php
        }
    } else {
        echo '<div class="no-houses" style="text-align:center; padding:20px; color:#888;">
            <i class="fas fa-home" style="font-size:48px; color:#ccc;"></i>
            <p>No houses available</p>
          </div>';
    }
    ?>


</div>
<h2 style="font-size: 2em;text-align:center;margin:2em;">PLOTS/LAND FOR SALE</h2>

<div class="properties-grid">
    <?php

    $fetchplots = mysqli_query($conn, "SELECT * FROM tenants WHERE deleted_at IS NULL  AND categories = 'plots' order by id DESC");
    if (mysqli_num_rows($fetchplots)) {
        while ($plots = mysqli_fetch_assoc($fetchplots)) {
    ?>

            <a href="#" class="property-card" onclick="showPropertyModal(1)">
                <div class="property-image">

                    <img src="../imageuploads/<?= $plots['image_path'] ?>" alt="image">
                    <span class="property-badge"><?= $plots['status'] ?></span>
                </div>
                <div class="property-info">
                    <div class="property-price"> $ <?= number_format($plots['rent']) ?>/month</div>
                    <h3><?= $plots['property'] ?></h3>
                    <p><?= $plots['notes'] ?></p>
                    <p><i class="fas fa-user"></i> Added By: <?= $plots['added_by'] ?></p>

                    <div class="property-meta">
                        <span><i class="fas fa-bed"></i> 4</span>
                        <span><i class="fas fa-bath"></i> 3</span>
                        <span><i class="fas fa-ruler-combined"></i> 2,450 sqft</span>
                    </div>
                    <div class="property-actions">
                        <span class="btn btn-sm btn-outline">View Details</span>
                    </div>
                </div>
            </a>


    <?php
        }
    } else {
        echo '<div class="no-plots" style="text-align:center; padding:20px; color:#888;">
            <i class="fas fa-map" style="font-size:48px; color:#aaa;"></i>
            <p>No plots available</p>
          </div>';
    }
    ?>

</div>
</section>


<!-- Services Section -->
<section id="services" class="section">
    <h2><i class="fas fa-handshake"></i> Our Services</h2>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-home"></i>
            </div>
            <h3>Property Sales</h3>
            <p>Expert guidance in buying and selling residential and commercial properties with competitive rates.</p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-key"></i>
            </div>
            <h3>Property Rentals</h3>
            <p>Comprehensive rental services including tenant screening, lease agreements, and property management.</p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Investment Consulting</h3>
            <p>Professional advice on real estate investments and market analysis to maximize your returns.</p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-tools"></i>
            </div>
            <h3>Property Management</h3>
            <p>Full-service property management including maintenance, repairs, and tenant relations.</p>
        </div>
    </div>
</section>

<!-- Admin Section -->
<section id="admin" class="section">

    <div class="login-container">
        <div class="logo">
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>

        <div id="error-message" class="error-message"></div>
        <div id="success-message" class="success-message"></div>

        <form id="loginForm" method="post" action="/login">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePassword()">👁️</span>
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" name="submit" class="login-btn">
                <span id="btn-text">Sign In</span>
                <span id="btn-loading" class="loading" style="display: none;"></span>
            </button>
        </form>
    </div>


    </div>
</section>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = '👁️';
        }
    }


    // Add smooth animations on page load
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.login-container');
        container.style.opacity = '0';
        container.style.transform = 'translateY(30px)';

        setTimeout(() => {
            container.style.transition = 'all 0.6s ease';
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);
    });
</script>
</section>

<!-- Contact Section -->
<section id="contact" class="section">
    <div class="contact-form">
        <style>
            .card {
                background: white;
                border-radius: 15px;
                padding: 2rem;
                margin-bottom: 2em;

                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .card h2 {
                color: #667eea;
                margin-bottom: 1rem;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .card p {
                color: #666;
                line-height: 1.7;
                margin-bottom: 1rem;
            }

            .card ul {
                list-style: none;
                padding-left: 0;
            }

            .card li {
                padding: 0.3rem 0;
                color: #666;
                position: relative;
                padding-left: 1.2rem;
            }

            .card li:before {
                content: "→";
                position: absolute;
                left: 0;
                color: #667eea;
                font-weight: bold;
            }

            .skills {
                background: white;
                border-radius: 15px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .skills h2 {
                color: #667eea;
                margin-bottom: 1.5rem;
                text-align: center;
                font-size: 2rem;
                font-weight: 600;
            }

            .skill-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .skill-category {
                background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
                padding: 1.5rem;
                border-radius: 12px;
                border-left: 4px solid #667eea;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .skill-category:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
            }

            .skill-category:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #667eea, #764ba2);
            }

            .skill-category h3 {
                color: #333;
                margin-bottom: 0.8rem;
                font-size: 1.1rem;
                font-weight: 600;
            }

            .skill-list {
                list-style: none;
            }

            .skill-list li {
                padding: 0.3rem 0;
                color: #666;
                position: relative;
                padding-left: 1rem;
                font-size: 0.9rem;
            }

            .skill-list li:before {
                content: "•";
                position: absolute;
                left: 0;
                color: #667eea;
                font-weight: bold;
            }

            .cta {
                text-align: center;
                padding: 2rem;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 15px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
            }

            .cta h3 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .cta-button {
                display: inline-block;
                padding: 12px 30px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                text-decoration: none;
                border-radius: 25px;
                font-weight: 600;
                transition: all 0.3s ease;
                border: 2px solid rgba(255, 255, 255, 0.3);
            }

            .cta-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                border-color: rgba(255, 255, 255, 0.5);
            }

            /* === Simple Responsive Styles === */
            @media (max-width: 768px) {

                .card,
                .skills,
                .skill-category,
                .cta {
                    padding: 1rem;
                }

                .card h2,
                .skills h2,
                .cta h3 {
                    font-size: 1.2rem;
                }

                .card p,
                .skill-list li {
                    font-size: 0.9rem;
                }

                .skill-grid {
                    grid-template-columns: 1fr;
                }

                .cta-button {
                    padding: 10px 20px;
                    font-size: 0.9rem;
                }
            }

            .contact-links {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin-top: 1rem;
            }

            .contact-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                text-decoration: none;
                font-weight: 500;
                color: #333;
                transition: color 0.2s ease;
            }

            .contact-link i {
                font-size: 1.2rem;
                color: #667eea;
            }

            .contact-link:hover {
                color: #764ba2;
            }

            .description {
                margin-bottom: 2em;
            }
        </style>



        <div class="container">
            <div class="description" style="text-align: center; padding: 2rem; background: #f9f9f9; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;">👋 Hi, I'm <span style="color: #667eea;">Julias Muyambi</span></h1>
                <p style="color: #555; font-size: 1.2rem; max-width: 700px; margin: auto;">
                    <span style="color: #007BFF; font-weight: bold;">AI Specialist</span>, Software Developer, Machine Learning Engineer, NLP Expert, and CEO of <strong style="color: #764ba2;">KamaTrust AI</strong>
                </p>
            </div>



            <div class="content">
                <div class="card">
                    <h2>🚀 About Me</h2>
                    <p>I'm a passionate full-stack developer with 5+ years of experience creating innovative web and mobile applications. I love turning complex problems into simple, beautiful solutions that make a real impact.</p>
                    <br>
                    <p>When I'm not coding, you'll find me exploring new technologies, contributing to open-source projects, or enjoying a good cup of coffee while brainstorming the next big idea.</p>
                </div>

                <div class="card">
                    <h2>💡 My Approach</h2>
                    <p>I believe in writing clean, maintainable code that not only works but is also scalable and efficient. Every project is an opportunity to learn something new and push the boundaries of what's possible.</p>
                    <br>
                    <p>I'm committed to staying current with the latest technologies and best practices, ensuring that every solution I deliver is modern, secure, and future-proof.</p>
                </div>
            </div>

            <div class="skills">
                <h2>🛠️ Technical Skills</h2>
                <div class="skill-grid">
                    <div class="skill-category">
                        <h3>Frontend</h3>
                        <ul class="skill-list">
                            <li>React / Next.js</li>
                            <li>Vue.js / Nuxt.js</li>
                            <li>TypeScript / JavaScript</li>
                            <li>HTML5 / CSS3 / Sass</li>
                            <li>Tailwind CSS</li>
                        </ul>
                    </div>
                    <div class="skill-category">
                        <h3>Backend</h3>
                        <ul class="skill-list">
                            <li>Node.js / Express</li>
                            <li>Python / Django</li>
                            <li>PHP / Laravel</li>
                            <li>RESTful APIs</li>
                            <li>GraphQL</li>
                        </ul>
                    </div>
                    <div class="skill-category">
                        <h3>Database</h3>
                        <ul class="skill-list">
                            <li>PostgreSQL</li>
                            <li>MongoDB</li>
                            <li>MySQL</li>
                            <li>Redis</li>
                            <li>Firebase</li>
                        </ul>
                    </div>
                    <div class="skill-category">
                        <h3>DevOps & Tools</h3>
                        <ul class="skill-list">
                            <li>Docker / Kubernetes</li>
                            <li>AWS / Google Cloud</li>
                            <li>Git / GitHub</li>
                            <li>CI/CD Pipelines</li>
                            <li>Linux / Unix</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="contact-section">
                <h2>📫 Let's Connect</h2>
                <p>I'm always excited to discuss new projects and opportunities. Whether you have a specific project in mind or just want to chat about technology, feel free to reach out!</p>

                <!-- Load Bootstrap Icons if not already included -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

                <div class="contact-links">
                    <a href="mailto:alex@example.com" class="contact-link" target="_blank">
                        <i class="bi bi-envelope"></i> Email
                    </a>
                    <a href="https://linkedin.com/in/alexdev" class="contact-link" target="_blank">
                        <i class="bi bi-linkedin"></i> LinkedIn
                    </a>
                    <a href="https://github.com/alexdev" class="contact-link" target="_blank">
                        <i class="bi bi-github"></i> GitHub
                    </a>
                    <a href="https://x.com/juliasmuyambi" class="contact-link" target="_blank">
                        <i class="bi bi-twitter-x"></i> Twitter
                    </a>
                    <a href="https://www.facebook.com/juliasmuyambi" class="contact-link" target="_blank">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    <a href="https://www.youtube.com/@JuliasMuyambi" class="contact-link" target="_blank">
                        <i class="bi bi-youtube"></i> YouTube
                    </a>
                </div>

            </div>
        </div>


    </div>
</section>


<div class="whatsapp-btn" onclick="openWhatsApp()">
    <svg class="whatsapp-icon" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.892 3.488" />
    </svg>
    <div class="tooltip">Chat with us on WhatsApp</div>
</div>
<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-logo">
                <h2>PREMIER REAL ESTATES</h2>
                <p>Survive for life at the least.</p>
            </div>
            <div class="footer-links">
                <a href="/about">About</a>
                <a href="/services">Services</a>
                <a href="/contact">Contact</a>
                <a href="/privacy">Privacy</a>
            </div>
            <div class="footer-social">
                <a href="mailto:muyambijulias@gmail.com" target="_blank"><i class="bi bi-envelope"></i></a>
                <a href="https://linkedin.com/in/kamatrust-ai" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://github.com/Julias-Ai-Developer" target="_blank"><i class="bi bi-github"></i></a>
                <a href="https://x.com/juliasmuyambi" target="_blank"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.facebook.com/juliasmuyambi" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.youtube.com/@JuliasMuyambi" target="_blank"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 KamaTrust AI. All rights reserved.</p>
        </div>
    </div>
</footer>


<script>
    // Mobile menu functionality
    function toggleMobileMenu() {
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        const overlay = document.querySelector('.mobile-menu-overlay');

        hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
        overlay.classList.toggle('active');

        // Prevent body scroll when menu is open
        document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
    }

    function closeMobileMenu() {
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        const overlay = document.querySelector('.mobile-menu-overlay');

        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Section navigation
    function showSection(sectionName) {
        // Hide all sections
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            section.classList.remove('active');
        });

        // Show selected section
        const selectedSection = document.getElementById(sectionName);
        if (selectedSection) {
            selectedSection.classList.add('active');
        }

        // Update active nav link
        const navLinks = document.querySelectorAll('.nav-links a');
        navLinks.forEach(link => {
            link.classList.remove('active');
        });

        // Find and activate the corresponding nav link
        const activeLink = document.querySelector(`.nav-links a[onclick="showSection('${sectionName}')"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }

        // Close mobile menu after navigation
        closeMobileMenu();

        // Scroll to top
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Close mobile menu when clicking on nav links
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            closeMobileMenu();
        });
    });

    // Close mobile menu when window is resized to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            closeMobileMenu();
        }
    });

    // Handle form submission
    document.querySelector('.contact-form form').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Thank you for your message! We will get back to you soon.');
        e.target.reset();
    });

    // Add smooth scrolling for better UX
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        // Show home section by default
        showSection('home');
    });
</script>

<?php if (isset($_GET['error']) && $_GET['error'] == 'login_failed'): ?>
    <script>
        // Wait for page to fully load, then show toast
        window.addEventListener('load', function() {
            // Create the toast element
            const toast = document.createElement('div');
            toast.id = 'errorToast';
            toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #f44336;
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        font-family: Arial, sans-serif;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
    `;
            toast.innerHTML = '❌ Login failed. Please check your credentials.';

            // Add to page
            document.body.appendChild(toast);

            // Show the toast after a brief delay
            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(0)';
            }, 500);

            // Hide the toast after 3 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3500);
        });
    </script>
<?php endif; ?>


<script>
    function openWhatsApp() {
        // Replace with your actual WhatsApp number (include country code without + sign)
        const phoneNumber = '2560776828355';
        const message = 'HELLO WELCOME TO RECORDLITE HOW MAY WE HELP YOU';
        const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(whatsappURL, '_blank');
    }

    // Add some interactive feedback
    document.querySelector('.whatsapp-btn').addEventListener('mouseenter', function() {
        this.style.animationPlayState = 'paused';
    });

    document.querySelector('.whatsapp-btn').addEventListener('mouseleave', function() {
        this.style.animationPlayState = 'running';
    });
</script>