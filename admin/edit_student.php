<?php

include "sdb.php";


// ==========================================
// GET STUDENT ID
// ==========================================

if (!isset($_GET['id'])) {
    header("Location: student.php");
    exit();
}

$id = intval($_GET['id']);


// ==========================================
// UPDATE STUDENT
// ==========================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $college = trim($_POST['college']);
    $department = trim($_POST['department']);
    $password = trim($_POST['password']);


    $sql = "UPDATE student
            SET name = ?,
                email = ?,
                mobile = ?,
                college = ?,
                department = ?,
                password = ?
            WHERE id = ?";


    $stmt = $conn->prepare($sql);


    $stmt->bind_param(
        "ssssssi",
        $name,
        $email,
        $mobile,
        $college,
        $department,
        $password,
        $id
    );


    if ($stmt->execute()) {

        header("Location: student.php?updated=1");

        exit();

    } else {

        $error = "Unable to update student.";

    }

}


// ==========================================
// GET CURRENT STUDENT
// ==========================================

$sql = "SELECT *
        FROM student
        WHERE id = ?";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows == 0) {

    header("Location: student.php");

    exit();

}


$student = $result->fetch_assoc();

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
        }

        .edit-container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .edit-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            color: #172554;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #334155;
        }

        input {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            box-sizing: border-box;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button,
        .back-btn {
            padding: 11px 20px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back-btn {
            background: #e2e8f0;
            color: #334155;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 7px;
            margin-bottom: 15px;
        }

    </style>

</head>


<body>


<div class="edit-container">

    <div class="edit-card">

        <h1>Edit Student</h1>


        <?php if (isset($error)): ?>

            <div class="error">

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <form method="POST">


            <div class="form-group">

                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo htmlspecialchars($student['name']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($student['email']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Mobile</label>

                <input
                    type="text"
                    name="mobile"
                    value="<?php echo htmlspecialchars($student['mobile']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>College</label>

                <input
                    type="text"
                    name="college"
                    value="<?php echo htmlspecialchars($student['college']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Department</label>

                <input
                    type="text"
                    name="department"
                    value="<?php echo htmlspecialchars($student['department']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="text"
                    name="password"
                    value="<?php echo htmlspecialchars($student['password']); ?>"
                    required
                >

            </div>


            <div class="buttons">

                <button type="submit">
                    Update Student
                </button>

                <a href="student.php"
                   class="back-btn">

                    Cancel

                </a>

            </div>


        </form>

    </div>

</div>


</body>

</html>