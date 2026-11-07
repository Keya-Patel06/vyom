
<?php

require_once __DIR__ . "/edb.php";

// Allow deletion only through POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: tech_events.php");
    exit();
}

// Get event ID
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$eid = isset($_POST['eid']) ? (int)$_POST['eid'] : 0;

// Check IDs
if ($id > 0 && $eid > 0) {

    // Delete event using tid
    $stmt = $conn->prepare(
        "DELETE FROM tech_events
         WHERE tid = ? AND eid = ?"
    );

    $stmt->bind_param("ii", $id, $eid);

    if ($stmt->execute()) {

        header("Location: tech_events.php?eid=" . $eid . "&deleted=1");
        exit();

    } else {

        die("Error deleting event: " . $stmt->error);
    }

} else {

    die("Invalid event ID.");
}

?>
