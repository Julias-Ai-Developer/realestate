<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
                font-size: 16px; /* Prevent zoom on iOS */
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
</head>
<body>
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

    <!-- WhatsApp Button -->
    <a href="https://wa.me/1234567890" class="whatsapp-btn" target="_blank" rel="noopener">
        <svg class="whatsapp-icon" viewBox="0 0 32 32">
            <path d="M16.21 4.41C9.973 4.41 4.917 9.465 4.917 15.7c0 2.134.592 4.13 1.62 5.837L4.5 27.59l6.25-2.002a11.241 11.241 0 0 0 5.46 1.388c6.237 0 11.292-5.055 11.292-11.29C27.502 9.465 22.447 4.41 16.21 4.41zm0 20.69c-1.91 0-3.69-.57-5.173-1.553l-3.61 1.156 1.173-3.49a9.345 9.345 0 0 1-1.79-5.512c0-5.18 4.222-9.4 9.4-9.4s9.4 4.22 9.4 9.4c0 5.18-4.222 9.4-9.4 9.4z"/>
            <path d="M12.72 9.952c-.22-.49-.45-.5-.658-.51-.17-.008-.364-.008-.558-.008-.193 0-.507.072-.772.36-.266.287-1.02.996-1.02 2.428 0 1.432 1.043 2.817 1.187 3.011.144.193 2.014 3.076 4.88 4.317.68.295 1.22.472 1.635.604.683.218 1.305.187 1.798.114.548-.082 1.689-.69 1.927-1.357.238-.667.238-1.239.167-1.357-.072-.118-.265-.19-.558-.334-.292-.143-1.735-.857-2.005-.953-.27-.096-.467-.143-.665.144-.197.287-.766.953-.938 1.147-.17.193-.34.218-.632.072-.292-.144-1.235-.455-2.353-1.453-.87-.777-1.457-1.74-1.627-2.027-.17-.287-.018-.443.125-.586.13-.126.292-.334.437-.5.144-.167.192-.287.288-.48.096-.194.048-.362-.024-.505-.072-.143-.665-1.603-.912-2.196z"/>
        </svg>
        <div class="tooltip">Chat with us on WhatsApp</div>
    </a>

    <script>
        // Password toggle functionality
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

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.login-btn');
            const btnText = document.getElementById('btn-text');
            const btnLoading = document.getElementById('btn-loading');
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline-block';
            
            // Hide any previous messages
            hideMessages();
            
            // You can add form validation here before submission
            // For demo purposes, we'll just show the loading state
            
            // Uncomment the line below to prevent actual form submission for demo
            // e.preventDefault();
            
            // Reset button state after 3 seconds (for demo)
            // In real implementation, this would be handled by the server response
            setTimeout(() => {
                submitBtn.disabled = false;
                btnText.style.display = 'inline-block';
                btnLoading.style.display = 'none';
            }, 3000);
        });

        // Message display functions
        function showError(message) {
            const errorDiv = document.getElementById('error-message');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
            hideSuccess();
        }

        function showSuccess(message) {
            const successDiv = document.getElementById('success-message');
            successDiv.textContent = message;
            successDiv.style.display = 'block';
            hideError();
        }

        function hideError() {
            document.getElementById('error-message').style.display = 'none';
        }

        function hideSuccess() {
            document.getElementById('success-message').style.display = 'none';
        }

        function hideMessages() {
            hideError();
            hideSuccess();
        }

        // Basic form validation
        function validateForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                showError('Please fill in all fields');
                return false;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('Please enter a valid email address');
                return false;
            }
            
            if (password.length < 6) {
                showError('Password must be at least 6 characters long');
                return false;
            }
            
            return true;
        }

        // Enhanced form validation on input
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            if (email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    this.style.borderColor = '#e53e3e';
                } else {
                    this.style.borderColor = '#48bb78';
                }
            }
        });

        document.getElementById('password').addEventListener('blur', function() {
            const password = this.value;
            if (password) {
                if (password.length < 6) {
                    this.style.borderColor = '#e53e3e';
                } else {
                    this.style.borderColor = '#48bb78';
                }
            }
        });

        // Clear validation styles on focus
        document.getElementById('email').addEventListener('focus', function() {
            this.style.borderColor = '#667eea';
            hideMessages();
        });

        document.getElementById('password').addEventListener('focus', function() {
            this.style.borderColor = '#667eea';
            hideMessages();
        });

        // Prevent form zoom on iOS
        document.addEventListener('touchstart', function() {}, true);
    </script>
</body>
</html>