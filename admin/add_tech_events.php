
<?php
require_once __DIR__ . "/edb.php";

$eid = isset($_GET['eid']) ? (int)$_GET['eid'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eid = (int)$_POST['eid'];
    $tname = trim($_POST['tname']);
    $tdate = $_POST['tdate'];
    $ttime = $_POST['ttime'];
    $tlocation = trim($_POST['tlocation']);
    $tdescription = trim($_POST['tdescription']);
    $is_parallel = $_POST['is_parallel'];

    if ($eid > 0 && $tname != "") {

        $stmt = $conn->prepare(
            "INSERT INTO tech_events
            (eid, tname, tdate, ttime, tlocation, tdescription, is_parallel)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "issssss",
            $eid,
            $tname,
            $tdate,
            $ttime,
            $tlocation,
            $tdescription,
            $is_parallel
        );

        if ($stmt->execute()) {
            header("Location: tech_events.php?eid=$eid&added=1");
            exit();
        } else {
            $error = "Unable to add event.";
        }

    } else {
        $error = "Please enter the event name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Technical Event - Vyom</title>

    <link rel="stylesheet" href="tech_form.css">

</head>

<body>

<div class="form-container">

    <h2>Add Technical Event</h2>

    <?php if (isset($error)) { ?>
        <p class="error-msg">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php } ?>

    <form method="POST">

        <input type="hidden" name="eid" value="<?php echo $eid; ?>">

        <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="tname" required>
        </div>

        <div class="form-group">
            <label>Event Date</label>
            <input type="date" name="tdate" required>
        </div>

        <div class="form-group">
            <label>Event Time</label>
            <input type="time" name="ttime" required>
        </div>

        <div class="form-group">
            <label>Event Location</label>
            <input type="text" name="tlocation" required>
        </div>

        <div class="form-group">
            <label>Event Description</label>
            <textarea name="tdescription" required></textarea>
        </div>

        <div class="form-group">
            <label>Parallel Event</label>
            <select name="is_parallel" required>
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>

        <button type="submit" class="save-btn">
            Save Event
        </button>

    </form>

    <a class="back-link" href="tech_events.php?eid=<?php echo $eid; ?>">
        ← Back to Technical Events
    </a>

</div>

</body>
</html>
