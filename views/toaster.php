<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toast Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            border-left: 4px solid;
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.success {
            border-left-color: #27ae60;
        }

        .toast.error {
            border-left-color: #e74c3c;
        }

        .toast.warning {
            border-left-color: #f39c12;
        }

        .toast.info {
            border-left-color: #3498db;
        }

        .toast-icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .toast.success .toast-icon {
            color: #27ae60;
        }

        .toast.error .toast-icon {
            color: #e74c3c;
        }

        .toast.warning .toast-icon {
            color: #f39c12;
        }

        .toast.info .toast-icon {
            color: #3498db;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
        }

        .toast-close {
            cursor: pointer;
            color: #999;
            font-size: 18px;
            padding: 2px;
            transition: color 0.2s ease;
        }

        .toast-close:hover {
            color: #333;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 0 0 12px 12px;
            overflow: hidden;
        }

        .toast-progress-bar {
            height: 100%;
            background: currentColor;
            width: 100%;
            animation: progress 5s linear;
        }

        @keyframes progress {
            from { width: 100%; }
            to { width: 0%; }
        }

        @media (max-width: 480px) {
            .toast-container {
                left: 20px;
                right: 20px;
            }

            .toast {
                min-width: auto;
            }
        }

        /* Demo styling - remove in production */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .demo-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .demo-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .demo-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            color: white;
        }

        .demo-btn.success {
            background: #27ae60;
        }

        .demo-btn.error {
            background: #e74c3c;
        }

        .demo-btn.warning {
            background: #f39c12;
        }

        .demo-btn.info {
            background: #3498db;
        }

        .demo-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .code-example {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            overflow-x: auto;
        }

        h1, h2, h3 {
            color: #2c3e50;
        }

        .usage-section {
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <!-- Toast Container - Add this to your HTML -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Demo Content - Remove in production -->
    <div class="demo-container">
        <h1>Toast Notification System</h1>
        <p>A lightweight, beautiful toast notification system for your web applications.</p>

        <div class="usage-section">
            <h2>Usage</h2>
            <p>Call the <code>showToast()</code> function with the following parameters:</p>
            
            <div class="code-example">
showToast(type, title, message, duration);

// Examples:
showToast('success', 'Success!', 'Login successful!');
showToast('error', 'Error!', 'Invalid credentials');
showToast('warning', 'Warning!', 'Please check your input');
showToast('info', 'Info', 'Welcome back!');
            </div>
        </div>

        <div class="usage-section">
            <h2>Integration with PHP</h2>
            <div class="code-example">
// PHP Example - After form processing
if ($login_success) {
    echo "&lt;script&gt;showToast('success', 'Login Successful!', 'Welcome back!');&lt;/script&gt;";
} else {
    echo "&lt;script&gt;showToast('error', 'Login Failed', 'Invalid credentials');&lt;/script&gt;";
}
            </div>
        </div>

        <div class="usage-section">
            <h2>Test the Toasts</h2>
            <div class="demo-buttons">
                <button class="demo-btn success" onclick="showToast('success', 'Success!', 'Operation completed successfully!')">
                    <i class="fas fa-check"></i> Success Toast
                </button>
                <button class="demo-btn error" onclick="showToast('error', 'Error!', 'Something went wrong!')">
                    <i class="fas fa-times"></i> Error Toast
                </button>
                <button class="demo-btn warning" onclick="showToast('warning', 'Warning!', 'Please check your input')">
                    <i class="fas fa-exclamation-triangle"></i> Warning Toast
                </button>
                <button class="demo-btn info" onclick="showToast('info', 'Information', 'Here is some useful information')">
                    <i class="fas fa-info-circle"></i> Info Toast
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toast notification system
        function showToast(type, title, message, duration = 5000) {
            const toastContainer = document.getElementById('toastContainer');
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            // Define icons for different types
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };
            
            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="${icons[type]}"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <div class="toast-close" onclick="closeToast(this)">
                    <i class="fas fa-times"></i>
                </div>
                <div class="toast-progress">
                    <div class="toast-progress-bar"></div>
                </div>
            `;
            
            // Add toast to container
            toastContainer.appendChild(toast);
            
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Auto remove toast
            setTimeout(() => {
                closeToast(toast.querySelector('.toast-close'));
            }, duration);
        }

        function closeToast(closeBtn) {
            const toast = closeBtn.closest('.toast');
            toast.classList.remove('show');
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Clear all toasts with Escape key
            if (e.key === 'Escape') {
                const toasts = document.querySelectorAll('.toast');
                toasts.forEach(toast => {
                    const closeToast = toast.querySelector('.toast-close');
                    if (closeToast) closeToast.click();
                });
            }
        });
    </script>
</body>
</html>