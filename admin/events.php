
<?php
require_once __DIR__ . "/edb.php";

// Get selected event ID
$eid = isset($_GET['eid']) ? (int)$_GET['eid'] : 0;

// Add Category
if (isset($_POST['add_category'])) {

    $eid = (int)$_POST['eid'];
    $category_name = trim($_POST['category_name']);

    if ($eid > 0 && $category_name != "") {

        $stmt = $conn->prepare(
            "INSERT INTO event_categories (eid, category_name)
             VALUES (?, ?)"
        );

        $stmt->bind_param("is", $eid, $category_name);

        if ($stmt->execute()) {

            header("Location: events.php?eid=" . $eid);
            exit();

        } else {

            $error = "Category already exists or could not be added.";
        }
    }
}

// Fetch all event years
$years = $conn->query(
    "SELECT * FROM events ORDER BY event_year DESC"
);

// Select latest year by default
if ($eid == 0) {

    $latest = $conn->query(
        "SELECT eid FROM events ORDER BY event_year DESC LIMIT 1"
    )->fetch_assoc();

    $eid = $latest ? (int)$latest['eid'] : 0;
}

// Fetch selected event
$stmt = $conn->prepare(
    "SELECT * FROM events WHERE eid = ?"
);

$stmt->bind_param("i", $eid);
$stmt->execute();

$event = $stmt->get_result()->fetch_assoc();

// Fetch categories for selected event
$stmt = $conn->prepare(
    "SELECT * FROM event_categories WHERE eid = ? ORDER BY cid"
);

$stmt->bind_param("i", $eid);
$stmt->execute();

$categories = $stmt->get_result();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Main Events</title>

    <link rel="stylesheet" href="events.css">

</head>

<body>
    
<?php
include "header.php";
?>

<main class="events-main">

    <!-- TOP SECTION -->

    <div class="events-top">

        <div>

            <h2>VYOM</h2>

            <p>College Event Management System</p>

        </div>

        <!-- Event Year Dropdown -->

        <select onchange="location.href='events.php?eid='+this.value">

            <?php while ($year = $years->fetch_assoc()) { ?>

                <option value="<?php echo $year['eid']; ?>"
                    <?php if ($eid == $year['eid']) echo "selected"; ?>>

                    <?php
                    echo htmlspecialchars($year['event_name']) .
                         " - " .
                         htmlspecialchars($year['event_year']);
                    ?>

                </option>

            <?php } ?>

        </select>

    </div>


    <?php if ($event) { ?>

        <!-- SELECTED EVENT -->

        <div class="selected-event">

            <h3>

                <?php echo htmlspecialchars($event['event_name']); ?>

                -

                <?php echo htmlspecialchars($event['event_year']); ?>

            </h3>

            <p>Select a category to manage its events.</p>

        </div>


        <!-- ERROR MESSAGE -->

        <?php if (isset($error)) { ?>

            <p class="error-msg">

                <?php echo htmlspecialchars($error); ?>

            </p>

        <?php } ?>


        <!-- CATEGORY HEADING -->

        <div class="category-heading">

            <h3>Event Categories</h3>

            <button onclick="document.getElementById('addCategory').style.display='block'">

                + Add Category

            </button>

        </div>


        <!-- ADD CATEGORY FORM -->

        <form method="POST" id="addCategory" style="display:none;">

            <input type="hidden"
                   name="eid"
                   value="<?php echo $eid; ?>">

            <input type="text"
                   name="category_name"
                   placeholder="Enter category name"
                   required>

            <button type="submit" name="add_category">

                Save Category

            </button>

        </form>


        <!-- DYNAMIC CATEGORY CARDS -->

        <div class="category-grid">

            <?php while ($category = $categories->fetch_assoc()) { ?>

                <div class="category-card">

                    <div class="category-symbol">✦</div>

                    <h4>

                        <?php
                        echo htmlspecialchars($category['category_name']);
                        ?>

                    </h4>

                    <p>Manage events under this category.</p>


                    <!-- CATEGORY MANAGEMENT LINK -->

                    <?php

                    $categoryName = strtolower(
                        trim($category['category_name'])
                    );

                    if ($categoryName == 'technical') {

                    ?>

                        <!-- TECHNICAL CATEGORY -->

                        <a href="add_tech_events.php?eid=<?php echo $eid; ?>">

                            Manage Events →

                        </a>

                    <?php } else { ?>

                        <!-- OTHER CATEGORIES -->

                        <a href="manage_category.php?cid=<?php echo (int)$category['cid']; ?>&eid=<?php echo $eid; ?>">

                            Manage Events →

                        </a>

                    <?php } ?>

                </div>

            <?php } ?>

        </div>


    <?php } else { ?>

        <p>No event year found. Please add an event year first.</p>

    <?php } ?>

</main>


<?php
include "footer.php";
?>

</body>

</html>
