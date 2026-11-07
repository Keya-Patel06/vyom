
<?php
session_start();

// Check login
if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: login.php");
    exit();
}

// Get current logged-in admin
$adminName = $_SESSION["admin_name"];
$adminId = $_SESSION["admin_id"];

// College name
$collegeName = "SVIT College";

$logo = "img/vyomlogo.png";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>College Event Management System</title>

    <!-- Google Font -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="header.css">

</head>

<body>

<header class="admin-header">

    <!-- LEFT SIDE -->
    <div class="brand">

        <div class="logo">

            <img src="<?php echo $logo; ?>"
                 alt="College Logo">

        </div>

        <div class="brand-text">

            <h2>Campus Connect</h2>

            <p>
                <?php echo $collegeName; ?> • Admin Panel
            </p>

        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="header-right">

        <!-- PROFILE -->
        <div class="profile-container">

            <div class="profile"
                 onclick="toggleProfile()">

                <div class="profile-img">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div class="profile-info">

                    <strong>
                        <?php echo $adminName; ?>
                    </strong>

                    <span>
                        SVIT Admin
                    </span>

                </div>

                <i class="fa-solid fa-chevron-down profile-arrow"></i>

            </div>


            <!-- PROFILE DROPDOWN -->
            <div class="profile-dropdown"
                 id="profileDropdown">

                <div class="dropdown-header">

                    <strong>
                        <?php echo $adminName; ?>
                    </strong>

                    <span>
                        <?php echo $adminId; ?>
                    </span>

                </div>

                <a href="logout.php"
                   class="dropdown-item logout">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </a>

            </div>

        </div>

    </div>

</header>


<!-- Custom JavaScript -->
<script src="header.js"></script>

</body>

</html>

