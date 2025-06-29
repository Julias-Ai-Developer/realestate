<?php
session_start(); // ✅ Start session first

// Check if session is set
if (!isset($_SESSION['id'])) {
      header('Location:/error');
    exit();
}

// Sanitize session variables
$userName = htmlspecialchars($_SESSION['username']);
$userRole = htmlspecialchars($_SESSION['role']);

// DB connection
include __DIR__ . '/../database/conn.php';

$fetch = mysqli_query($conn, "SELECT * FROM tenants WHERE deleted_at IS NULL order by id DESC ");
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM tenants WHERE deleted_at IS NULL");
if ($totalQuery) {
    $row = mysqli_fetch_assoc($totalQuery);
    $total = $row['total'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .header-content p {
            color: #666;
            font-size: 1.1rem;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.75rem;
            border-radius: 8px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #fc8181, #e53e3e);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
        }

        .table-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2d3748;
        }

        #tenantCount {
            background: rgba(102, 126, 234, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            color: #667eea;
            font-weight: 600;
        }



        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        th {
            background: linear-gradient(135deg, #f8f9ff, #e3e8ff);
            color: #4a5568;
            font-weight: 600;
            padding: 18px 15px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transition: all 0.2s ease;
        }

        .tenant-name {
            font-weight: 600;
            color: #2d3748;
            font-size: 1rem;
        }

        .tenant-contact {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .tenant-email {
            color: #667eea;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .tenant-email:hover {
            text-decoration: underline;
        }

        .tenant-phone {
            color: #718096;
            font-size: 0.85rem;
        }

        .property-name {
            font-weight: 500;
            color: #2d3748;
        }

        .rent-amount {
            font-weight: 700;
            color: #38a169;
            font-size: 1.1rem;
        }

        .lease-date {
            color: #4a5568;
            font-size: 0.9rem;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: white !important;
        }

        .notification-icons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .notification-icons span {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
        }

        .notification-icons i {
            width: 16px;
            color: #667eea;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #718096;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 1.1rem;
        }

        .responsive-hide {
            display: table-cell;
        }

        @media (max-width: 1200px) {
            .responsive-hide-lg {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header {
                padding: 20px;
                flex-direction: column;
                text-align: center;
            }

            .header-content h1 {
                font-size: 2rem;
            }

            .table-section {
                padding: 20px;
            }

            .table-header {
                flex-direction: column;
                text-align: center;
            }

            .responsive-hide {
                display: none;
            }

            th,
            td {
                padding: 12px 8px;
                font-size: 0.8rem;
            }

            .tenant-name {
                font-size: 0.9rem;
            }

            .search-filter {
                flex-direction: column;
            }

            .search-box {
                min-width: 100%;
            }
        }



        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #f0fff4;
            border-color: #38a169;
            color: #22543d;
        }

        .alert-error {
            background-color: #fed7d7;
            border-color: #e53e3e;
            color: #742a2a;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">

            <div class="header-content">
                <h1 style="font-size:20px;">Hello <?= $userName ?></h1>
                <p>You are a <?= $userRole ?></p>
            </div>
            <div class="header-content" style="display: flex; justify-content: flex-end; align-items: center; padding: 10px; background-color: #f5f5f5;">
                <form action="/logout" method="post" style="margin: 0;">
                    <button type="submit" style="padding: 8px 16px; background-color: #ff4d4d; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Logout
                    </button>
                </form>
            </div>


            <a href="/tenants/create" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add New Tenant
            </a>
        </div>

        <!-- Tenants Table -->
        <div class="table-section">
            <div class="table-header">
                <h2>Current Tenants</h2>
                <p id="tenantCount"><?= $total ?> tenants Recorded</p>
            </div>



            <div class="table-container">
                <table id="tenantsTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tenant</th>
                            <th class="responsive-hide">Contact</th>
                            <th>Property</th>
                            <th>Rent</th>
                            <th class="responsive-hide-lg">Lease Period</th>
                            <th>Status</th>
                            <th class="responsive-hide">Notifications</th>
                            <?php if ($userRole == 'admin'): ?>
                                <th>Actions</th>
                                <th>Added By</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody id="tenantsTableBody">
                        <?php
                        $i = 1;
                        if (mysqli_num_rows($fetch) > 0) {
                            while ($tenant = mysqli_fetch_assoc($fetch)) {
                                // Set badge color based on tenant status
                                $badgeColor = ($tenant['status'] === 'new') ? '#38a169' : '#805ad5';
                        ?>
                                <tr data-id="<?= $tenant['id'] ?>">
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <div class="tenant-name"><?= htmlspecialchars($tenant['first_name']) ?> <?= htmlspecialchars($tenant['last_name']) ?></div>
                                        <div class="tenant-contact">
                                            <a href="mailto:<?= htmlspecialchars($tenant['email']) ?>" class="tenant-email"><?= htmlspecialchars($tenant['email']) ?></a>
                                            <div class="tenant-phone"><?= htmlspecialchars($tenant['phone']) ?></div>
                                        </div>
                                    </td>
                                    <td class="responsive-hide">
                                        <div class="tenant-contact">
                                            <a href="mailto:<?= htmlspecialchars($tenant['email']) ?>" class="tenant-email"><?= htmlspecialchars($tenant['email']) ?></a>
                                            <div class="tenant-phone"><?= htmlspecialchars($tenant['phone']) ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="property-name"><?= htmlspecialchars($tenant['property']) ?></div>
                                    </td>
                                    <td>
                                        <div class="rent-amount">$ <?= number_format($tenant['rent']) ?></div>
                                    </td>
                                    <td class="responsive-hide-lg">
                                        <div class="lease-date"><?= htmlspecialchars($tenant['lease_end']) ?></div>
                                    </td>
                                    <td>
                                        <span class="status-badge" style="background-color: <?= $badgeColor ?>;">
                                            <?= htmlspecialchars($tenant['status']) ?>
                                        </span>
                                    </td>
                                    <td class="responsive-hide">
                                        <div class="notification-icons">
                                            <?php if ($tenant['notification_sms'] == 1): ?>
                                                <i class="fas fa-sms notification-icon" title="SMS Notification" style="font-size:20px;"></i>
                                            <?php endif; ?>

                                            <?php if ($tenant['notification_email'] == 1): ?>
                                                <i class="fas fa-envelope notification-icon" title="Email Notification" style="font-size:20px;"></i>
                                            <?php endif; ?>

                                            <?php if ($tenant['notification_sms'] != 1 && $tenant['notification_email'] != 1): ?>
                                                <span class="no-notification">No Notifications</span>
                                            <?php endif; ?>
                                        </div>

                                    </td>
                                    <?php if ($userRole == 'admin'): ?>
                                        <td>
                                            <div class="actions d-flex gap-2">
                                                <!-- Edit Button -->
                                                <a href="/tenants/editView?id=<?= htmlspecialchars($tenant['id']) ?>"
                                                    class="btn btn-sm btn-primary"
                                                    title="Edit tenant #<?= htmlspecialchars($tenant['id']) ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <!-- Delete Button -->

                                                <a href="/tenants/delete-views?id=<?= htmlspecialchars($tenant['id']) ?>"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete tenant #<?= htmlspecialchars($tenant['id']) ?>"
                                                    onclick="return confirm('Are you sure you want to delete tenant ID <?= $tenant['id'] ?>?');">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>

                                            </div>
                                        
                                        </td>
                                        <td><?=$tenant['added_by']?></td>
                                        <?php endif ?>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 40px;">
                                    <div class="empty-state">
                                        <i class="fas fa-users"></i>
                                        <p>No tenants found. Add your first tenant to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="emptyState" class="empty-state" style="display: none;">
                <i class="fas fa-users"></i>
                <p>No tenants found. Add your first tenant to get started.</p>
            </div>
        </div>
    </div>


</body>

</html>
<!-- Add the toast CSS -->
<style>
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    color: white;
    padding: 16px;
    border-radius: 4px;
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.toast.success {
    background: #4CAF50; /* Green for success */
}
.toast.error {
    background: #f44336; /* Red for error */
}
.toast.show {
    opacity: 1;
}
</style>

<script>
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 100);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => document.body.removeChild(toast), 300);
    }, 3000);
}
</script>

<!-- Check for success message -->
<?php if(isset($_SESSION['success'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast("<?php echo $_SESSION['success']; ?>", "success");
        });
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Check for error message -->
<?php if(isset($_SESSION['error'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast("<?php echo $_SESSION['error']; ?>", "error");
        });
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>