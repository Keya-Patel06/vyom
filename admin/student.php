<?php

include "sdb.php";


// ==========================================
// SEARCH
// ==========================================

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}


// ==========================================
// FETCH STUDENTS
// ==========================================

if ($search != "") {

    $sql = "SELECT id, name, email, mobile, college, department, password
            FROM student
            WHERE id LIKE ?
            OR name LIKE ?
            OR email LIKE ?
            OR mobile LIKE ?
            OR college LIKE ?
            OR department LIKE ?
            ORDER BY id DESC";

    $stmt = $conn->prepare($sql);

    $searchValue = "%" . $search . "%";

    $stmt->bind_param(
        "ssssss",
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue
    );

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $sql = "SELECT id, name, email, mobile, college, department, password
            FROM student
            ORDER BY id DESC";

    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>campus connect</title>

    <link rel="stylesheet"
          href="student.css">

    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body>


<?php
include "header.php";
?>


<!-- ==========================================
     MAIN CONTAINER
=========================================== -->

<div class="student-container">


    <!-- ======================================
         PAGE HEADER
    ======================================= -->

    <div class="page-header">

        <div>

            <h1>
                <i class="fa-solid fa-user-graduate"></i>
                Students
            </h1>

            <p>
                Manage registered students
            </p>

        </div>


        <!-- Student Count -->

        <div class="student-count">

            <span>
                Total Students
            </span>

            <strong>

                <?php

                $countQuery = "SELECT COUNT(*) AS total FROM student";

                $countResult = $conn->query($countQuery);

                $countRow = $countResult->fetch_assoc();

                echo $countRow['total'];

                ?>

            </strong>

        </div>

    </div>



    <!-- ======================================
         SEARCH
    ======================================= -->

    <div class="search-section">

        <form method="GET"
              action="student.php">

            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    placeholder="Search student by name, email, mobile, college..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >

            </div>


            <button type="submit"
                    class="search-btn">

                Search

            </button>


            <?php if ($search != ""): ?>

                <a href="student.php"
                   class="clear-btn">

                    Clear

                </a>

            <?php endif; ?>

        </form>

    </div>



    <!-- ======================================
         STUDENT TABLE
    ======================================= -->

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Mobile</th>

                    <th>College</th>

                    <th>Department</th>

                    <th>Password</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>


            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>


                <tr>


                    <!-- ID -->

                    <td>

                        <?php
                        echo htmlspecialchars($row['id']);
                        ?>

                    </td>


                    <!-- NAME -->

                    <td>

                        <div class="student-name">

                            <div class="student-icon">

                                <?php
                                echo strtoupper(
                                    substr($row['name'], 0, 1)
                                );
                                ?>

                            </div>

                            <span>

                                <?php
                                echo htmlspecialchars($row['name']);
                                ?>

                            </span>

                        </div>

                    </td>


                    <!-- EMAIL -->

                    <td>

                        <?php
                        echo htmlspecialchars($row['email']);
                        ?>

                    </td>


                    <!-- MOBILE -->

                    <td>

                        <?php
                        echo htmlspecialchars($row['mobile']);
                        ?>

                    </td>


                    <!-- COLLEGE -->

                    <td>

                        <?php
                        echo htmlspecialchars($row['college']);
                        ?>

                    </td>


                    <!-- DEPARTMENT -->

                    <td>

                        <?php
                        echo htmlspecialchars($row['department']);
                        ?>

                    </td>


                    <!-- PASSWORD -->

                    <td>

                        <span class="password-hidden">

                            ••••••••

                        </span>

                    </td>


                    <!-- ACTIONS -->

                    <td>

                        <div class="action-buttons">


                            <!-- EDIT -->

                            <a href="edit_student.php?id=<?php echo $row['id']; ?>"
                               class="edit-btn"
                               title="Edit Student">

                                <i class="fa-solid fa-pen"></i>

                            </a>


                            <!-- DELETE -->

                            <a href="delete_student.php?id=<?php echo $row['id']; ?>"
                               class="delete-btn"
                               title="Delete Student"
                               onclick="return confirm('Are you sure you want to delete this student?');">

                                <i class="fa-solid fa-trash"></i>

                            </a>


                        </div>

                    </td>


                </tr>


            <?php

                }

            } else {

            ?>


                <tr>

                    <td colspan="8"
                        class="no-data">

                        <i class="fa-solid fa-user-slash"></i>

                        <h3>
                            No Students Found
                        </h3>

                        <p>
                            <?php

                            if ($search != "") {

                                echo "No student matches your search.";

                            } else {

                                echo "No students have registered yet.";

                            }

                            ?>
                        </p>

                    </td>

                </tr>


            <?php

            }

            ?>


            </tbody>

        </table>

    </div>


</div>


<?php
include "footer.php";
?>


</body>

</html>


<?php

$conn->close();

?>