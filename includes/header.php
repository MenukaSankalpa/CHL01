<?php
// Example counts (replace with dynamic values from DB)
$applicantCount = 120;
$userCount = 45;
$selectedCount = 30;
$pendingCount = 50;

// Change this if your app isn’t served from /CHL01
$base = '/CHL01';
$asset = $base . '/assets';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Header</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --header-bg: #ffffff;
            --header-text: #333;
            --border-color: rgba(0, 0, 0, 0.12);
            --link-hover: #0d6efd;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --card-bg: #f8faff;
            --count-color: #0d6efd;
        }

        .glass-header {
            background: var(--header-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 18px 22px;
            margin: 10px;
            box-shadow: var(--shadow);
        }

        .header-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
        }

        /* Left: Logo */
        .left img {
            height: 50px;
            width: 65px;
            
        }

        /* Center: Navigation */
        .center {
            display: flex;
            justify-content: center;
        }

        .main-nav a {
            color: var(--header-text);
            text-decoration: none;
            font-weight: 600;
            margin: 0 12px;
            transition: color .2s;
        }

        .main-nav a:hover {
            color: var(--link-hover);
        }

        /* Right: Search + Profile */
        .right {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
        }

        .search-bar {
            position: relative;
            min-width: 200px;
        }

        .search-bar i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .search-bar input {
            background: #f3f3f3;
            padding-left: 40px;
            border-radius: 999px;
            border: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0d6efd;
        }

        .brand-logo {
    height: 60px;
    width: auto;
    max-width: 180px;
    object-fit: contain;
    display: block;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

/* Pop-up effect with transparent shadow */
.brand-logo:hover {
    transform: scale(1.5); /* slight pop-up */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* transparent, soft shadow */
}

        /* KPI Cards */
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 18px;
        }

        .kpi-card {
            position: relative;
            background: var(--card-bg);
            border-radius: 16px;
            flex: 1 1 220px;
            padding: 18px;
            box-shadow: var(--shadow);
            min-height: 130px;
            border: 1px solid var(--border-color);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .kpi-title {
            font-size: 1rem;
            font-weight: 700;
            color: #333;
        }

        .kpi-icon {
            position: absolute;
            top: 12px;
            right: 14px;
            font-size: 1.8rem;
        }

        .kpi-value {
            position: absolute;
            bottom: 12px;
            right: 16px;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--count-color);
        }

        body {
            background: #f4f6f9;
        }
    </style>
</head>

<body>

    <div class="glass-header">
        <div class="header-grid">
            <!-- Left: Company Logo -->
            <div class="left">
                <img src="<?php echo $base; ?>/images/ceylinegroup.png" alt="Company Logo" class="brand-logo" />
            </div>

            <!-- Center: Navigation -->
            <div class="center">
                <nav class="main-nav">
                    <a href="#">Dashboard</a>
                    <a href="#">Users</a>
                    <a href="#">Applicant</a>
                    <a href="#">Status</a>
                    <a href="#">Reports</a>
                </nav>
            </div>

            <!-- Right: Search & Profile -->
            <div class="right">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search..." />
                </div>
                <img src="<?php echo $asset; ?>/ceyline-header.png" alt="Profile" class="profile-img" />
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="cards-container">
            <div class="kpi-card">
                <div class="kpi-title">Applicants</div>
                <div class="kpi-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="kpi-value"><?php echo number_format($applicantCount); ?></div>
            </div>

            <div class="kpi-card">
                <div class="kpi-title">Users</div>
                <div class="kpi-icon"><i class="fas fa-users"></i></div>
                <div class="kpi-value"><?php echo number_format($userCount); ?></div>
            </div>

            <div class="kpi-card">
                <div class="kpi-title">Selected</div>
                <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
                <div class="kpi-value"><?php echo number_format($selectedCount); ?></div>
            </div>

            <div class="kpi-card">
                <div class="kpi-title">Pending</div>
                <div class="kpi-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="kpi-value"><?php echo number_format($pendingCount); ?></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>