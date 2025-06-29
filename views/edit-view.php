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
    <div class="page-header">
        <h1 class="page-title">Tenant Management System</h1>
        <p class="page-subtitle">Edit tenant Details</p>
    </div>

    <div class="form-container">
        <div class="form-header">
            <h2 class="form-header-title">
                <i class="fas fa-user-plus"></i>
                Edit Tenant Details
            </h2>
            <p class="form-header-subtitle">Fill out the form below to register a new tenant</p>
        </div>



        <form id="tenantForm" method="POST" action="/tenants/edit" enctype="multipart/form-data">
            <?php

            while ($details = mysqli_fetch_assoc($gettenant)) {

            ?>
                <input type="hidden" name="tenant_id" value="<?= $details['id'] ?>">

                <!-- Personal Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        <?= $details['first_name'] . ' ' . $details['last_name'] ?>'s Personal Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="firstName">
                                First Name <span class="required">*</span>
                            </label>
                            <input type="text" id="firstName" value="<?= $details['first_name'] ?>" name="firstName" class="form-input" required>
                            <!-- use hidden to hide the ids -->


                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lastName">
                                Last Name <span class="required">*</span>
                            </label>
                            <input type="text" id="lastName" name="lastName" value="<?= $details['last_name'] ?>" class="form-input" required>
                            <!-- use hidden to hide the ids -->


                        </div>
                    </div>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="lastName">
                            Upload Image <span class="required">*</span>
                        </label>
                        <input type="file" name="my_img" value="<?= $details['image_path'] ?>" class="form-input">
                        <!-- use hidden to hide the ids -->


                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-address-book"></i>
                        Contact Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="email">
                                Email Address <span class="required">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="<?= $details['email'] ?>" class="form-input" required>
                            <!-- use hidden to hide the ids -->


                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">
                                Phone Number <span class="required">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" value="<?= $details['phone'] ?>" class="form-input" required placeholder="(555) 123-4567">
                            <div class="input-hint">Format: (555) 123-4567</div>
                            <!-- use hidden to hide the ids -->


                        </div>
                    </div>
                </div>

                <!-- Property Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-home"></i>
                        Property Information
                    </h3>
                    <div class="form-group full-width">
                        <label class="form-label" for="property">
                            Property Address <span class="required">*</span>
                        </label>
                        <textarea id="property" name="property" class="form-textarea" value="<?= $details['property'] ?>" required placeholder="Enter full property address including unit number"><?= $details['property'] ?></textarea>
                        <!-- use hidden to hide the ids -->



                    </div>
                </div>

                <!-- Lease Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-file-contract"></i>
                        Lease Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="rent">
                                Monthly Rent <span class="required">*</span>
                            </label>
                            <input type="number" id="rent" name="rent" value="<?= $details['rent'] ?>" class="form-input" required min="0" step="0.01" placeholder="0.00">
                            <!-- use hidden to hide the ids -->



                        </div>
                        <div class="form-group">
                            <label class="form-label" for="status">
                                Tenant Status <span class="required">*</span>
                            </label>
                            <select id="status" name="status" value="<?= $details['status'] ?>" class="form-select" required>
                                <option value="">Select status</option>
                                <option value="featured" <?= ($details['status'] == 'featured') ? 'selected' : '' ?>>Featured</option>
                                <option value="new" <?= ($details['status'] == 'new') ? 'selected' : '' ?>>New</option>
                                <option value="for sale" <?= ($details['status'] == 'for sale') ? 'selected' : '' ?>>for sale</option>

                            </select>
                            <!-- use hidden to hide the ids -->


                        </div>
                        <div class="form-group">
                            <label class="form-label" for="category">
                                Deal Category<span class="required">*</span>
                            </label>
                            <select id="status" name="category" class="form-select" required>
                                <option value="">Select category </option>
                                <option value="houses" <?= ($details['categories'] == 'houses') ? 'selected' : '' ?>>Houses</option>
                                <option value="plots" <?= ($details['categories'] == 'plots') ? 'selected' : '' ?>>Plots</option>



                            </select>
                            <!-- use hidden to hide the ids -->


                        </div>


                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">
                            Lease Period <span class="required">*</span>
                        </label>
                        <div class="date-group">
                            <div class="form-group">
                                <input type="date" id="leaseStart" name="leaseStart" value="<?= $details['lease_start'] ?>" class="form-input" required>
                            </div>
                            <div class="date-separator">to</div>
                            <div class="form-group">
                                <input type="date" id="leaseEnd" name="leaseEnd" value="<?= $details['lease_end'] ?>" class="form-input" required>
                                <!-- use hidden to hide the ids -->


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Preferences Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-bell"></i>
                        Notification Preferences
                    </h3>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="emailNotifications" name="notificationEmail" value="1" class="checkbox-input"
                                <?= ($details['notification_email'] == 1) ? 'checked' : '' ?>>
                            <label for="emailNotifications" class="checkbox-label">
                                <i class="fas fa-envelope"></i> Email Notifications
                            </label>
                            <!-- use hidden to hide the ids -->


                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="smsNotifications" name="notificationSms" value="1" class="checkbox-input"
                                <?= ($details['notification_sms'] == 1) ? 'checked' : '' ?>>
                            <label for="smsNotifications" class="checkbox-label">
                                <i class="fas fa-sms"></i> SMS Notifications
                            </label>
                            <!-- use hidden to hide the ids -->


                        </div>

                    </div>
                </div>

                <!-- Additional Notes Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-sticky-note"></i>
                        Additional Notes
                    </h3>
                    <div class="form-group full-width">
                        <label class="form-label" for="notes">
                            Notes
                        </label>
                        <textarea id="notes" name="notes" class="form-textarea" value="<?= $details['notes'] ?> placeholder=" Any additional notes about the tenant..."><?= $details['notes'] ?></textarea>
                        <!-- use hidden to hide the ids -->


                    </div>
                </div>

                <div class="form-footer">
                    <a href="/homepage" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                    <div class="btn-group">
                        <button type="reset" class="btn btn-outline">
                            <i class="fas fa-undo"></i>
                            Reset Form
                        </button>
                        <button type="submit" name="save" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i>
                            Save Tenant
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