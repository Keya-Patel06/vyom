
<?php

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminId = $_POST["admin_id"];
    $password = $_POST["password"];

    // Temporary admin data
    $correctId = "JonitaSVIT";
    $correctPassword = "Jonita123";

    if ($adminId === $correctId && $password === $correctPassword) {

        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_name"] = "College Admin";
        $_SESSION["admin_id"] = $adminId;

        header("Location: home.php");
        exit();

    } else {

        $error = "Invalid Admin ID or Password.";
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <link rel="stylesheet" href="login.css">

</head>

<body>

    <div class="login-box">

        <!-- College Name -->

        <div class="college-name">
            SVIT College
        </div>


        <!-- Login Title -->

        <h2>Website Login</h2>


        <!-- Error Message -->

        <?php if ($error != "") { ?>

            <div class="error">

                <?php echo $error; ?>

            </div>

        <?php } ?>


        <!-- Login Form -->

        <form method="POST">

            <!-- Admin ID -->

            <input
                type="text"
                name="admin_id"
                placeholder="Email / Admin ID"
                required>


            <!-- Password -->

            <input
                type="password"
                name="password"
                placeholder="Password"
                required>


            <!-- Login Button -->

            <button type="submit">
                Login
            </button>

        </form>

    </div>


    <script src="login.js"></script>

</body>

</html>

