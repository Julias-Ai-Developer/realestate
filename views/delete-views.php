<?php
session_start(); // ✅ Start session first

// Check if session is set
if (!isset($_SESSION['id'])) {
      header('Location:/error');
    exit();
}

// DB connection
include __DIR__ . '/../database/conn.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    // var_dump(value: $id);
    // exit();
    $gettenant = mysqli_query($conn, "SELECT * from tenants WHERE deleted_at IS NULL AND id = $id");
} else {
    $gettenant = False;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tenant - Tenant Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Form Container */
        .form-container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
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

        .form-header {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .form-header-title {
            font-size: 1.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .form-header-subtitle {
            margin-top: 10px;
            opacity: 0.9;
            font-size: 1rem;
        }

        /* Form Styles */
        .form-section {
            padding: 30px;
            border-bottom: 1px solid #f0f0f0;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.2rem;
            margin-bottom: 25px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }

        .required {
            color: #e74c3c;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #764ba2;
            background-color: white;
            outline: none;
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
            transform: translateY(-1px);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .input-hint {
            font-size: 0.85rem;
            color: #888;
            margin-top: 8px;
            font-style: italic;
        }

        /* Date Group */
        .date-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .date-separator {
            color: #888;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Checkbox Group */
        .checkbox-group {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            accent-color: #764ba2;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: color 0.3s;
        }

        .checkbox-label:hover {
            color: #764ba2;
        }

        /* Button Group */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px;
            background-color: #f8f9fa;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            font-size: 1rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.4);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: #6c757d;
            border: 2px solid #6c757d;
        }

        .btn-outline:hover {
            background-color: #6c757d;
            color: white;
        }

        /* Back to Dashboard Link */
        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #764ba2;
        }

        /* Success Message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            display: none;
        }

        /* Loading State */
        .btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn.loading::after {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .form-container {
                margin: 10px;
                box-shadow: none;
                border-radius: 10px;
            }

            .form-section {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: span 1;
            }

            .date-group {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .date-separator {
                display: none;
            }

            .form-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .checkbox-group {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>

<body>


    <div class="form-container">
        <div class="form-header">
            <h2 class="form-header-title">
                <i class="fas fa-user-plus"></i>
                Delete Tenant Details
            </h2>
            <p class="form-header-subtitle">Fill out the form below to register a new tenant</p>
        </div>



        <form id="tenantForm" method="POST" action="/tenants/delete" enctype="multipart/form-data">
            <?php
            while ($tenant = mysqli_fetch_assoc($gettenant)) {
            ?>
                <!-- hidden input type -->
                <input type="hidden" name="tenant_id" value="<?= $tenant['id'] ?>">

                <!-- Personal Information Section -->
                <div class="form-section" style="border: 1px solid #f5c6cb; background-color: #f8d7da; padding: 20px; border-radius: 8px;">
                    <h3 class="section-title" style="color: #721c24;">
                        <i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i>
                        Are you sure you want to delete <strong> <?= $tenant['first_name'] . '  '  . $tenant['last_name'] ?></strong>?
                    </h3>

                    <!-- Warning message -->
                    <p class="form-input" style="color:#721c24;">
                        ⚠️ All data related to <strong><?= $tenant['first_name'] ?></strong> will be permanently deleted.
                    </p>

                    <div class="btn-group">
                        <!-- Cancel button as a link -->
                        <a href="/tenants/create" class="btn btn-outline" style="color: #6c757d; border: 1px solid #6c757d;">
                            <i class="fas fa-undo"></i>
                            No
                        </a>

                        <!-- Submit delete form -->
                        <button type="submit" name="delete" class="btn btn-danger" id="submitBtn">
                            <i class="fas fa-trash-alt"></i>
                            Delete Tenant
                        </button>
                    </div>
                </div>
            <?php
            }

            ?>






        </form>
    </div>


</body>

</html>