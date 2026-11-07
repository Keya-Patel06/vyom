
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Menu CSS -->
    <link rel="stylesheet" href="home.css">

</head>

<body>


<!-- ==============================
     MENU SECTION
================================= -->

<div class="menu-container">


    <!-- STUDENT -->

    <a href="student.php" class="menu-box student">

        <div class="menu-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>

        <div class="menu-content">

            <h3>Students</h3>

            <p>Manage student information</p>

        </div>

        <i class="fa-solid fa-arrow-right arrow"></i>

    </a>


    <!-- EVENTS -->

    <a href="events.php" class="menu-box events">

        <div class="menu-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>

        <div class="menu-content">

            <h3>Events</h3>

            <p>Manage college events</p>

        </div>

        <i class="fa-solid fa-arrow-right arrow"></i>

    </a>


    <!-- FACULTY COORDINATOR -->

    <a href="faculty_coordinator.php"
       class="menu-box faculty">

        <div class="menu-icon">
            <i class="fa-solid fa-chalkboard-user"></i>
        </div>

        <div class="menu-content">

            <h3>Faculty Coordinator</h3>

            <p>Manage event coordinators</p>

        </div>

        <i class="fa-solid fa-arrow-right arrow"></i>

    </a>


    <!-- DEPARTMENT -->

    <a href="department.php"
       class="menu-box department">

        <div class="menu-icon">
            <i class="fa-solid fa-building"></i>
        </div>

        <div class="menu-content">

            <h3>Departments</h3>

            <p>Manage college departments</p>

        </div>

        <i class="fa-solid fa-arrow-right arrow"></i>

    </a>


    <!-- CERTIFICATION -->

    <a href="certification.php"
       class="menu-box certification">

        <div class="menu-icon">
            <i class="fa-solid fa-certificate"></i>
        </div>

        <div class="menu-content">

            <h3>Certification</h3>

            <p>Manage event certificates</p>

        </div>

        <i class="fa-solid fa-arrow-right arrow"></i>

    </a>


    <!-- STUDENT ATTENDANCE -->

    <a href="student_attendance.php"
       class="menu-box attendance">

        <div class="menu-icon">
            <i class="fa-solid fa-clipboard-check"></i>
        </div>

        <div class="menu-content">

            <h3>Student Attendance</h3>

            <p>Manage event attendance</p>

        </div>

        <i class="fa-solid fa-arrow-right arrow"></i>

    </a>


</div>
<?php include 'footer.php'; ?>

</body>
</html>

