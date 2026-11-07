
<?php
require_once __DIR__ . "/edb.php";

// Get event ID and parent event ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : (int)($_POST['id'] ?? 0);
$eid = isset($_GET['eid']) ? (int)$_GET['eid'] : (int)($_POST['eid'] ?? 0);

$error = "";

// Fetch existing event details
$stmt = $conn->prepare(
    "SELECT * FROM tech_events WHERE tid = ? AND eid = ?"
);

$stmt->bind_param("ii", $id, $eid);
$stmt->execute();

$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Technical event not found.");
}

// Update event when form is submitted
if (isset($_POST['update_event'])) {

    $tname = trim($_POST['tname']);
    $tdate = $_POST['tdate'];
    $ttime = $_POST['ttime'];
    $tlocation = trim($_POST['tlocation']);
    $tdescription = trim($_POST['tdescription']);
    $is_parallel = $_POST['is_parallel'];

    if (
        $tname == "" ||
        $tdate == "" ||
        $ttime == "" ||
        $tlocation == ""
    ) {

        $error = "Please fill all required fields.";

    } else {

        $update = $conn->prepare(
            "UPDATE tech_events
             SET tname = ?,
                 tdate = ?,
                 ttime = ?,
                 tlocation = ?,
                 tdescription = ?,
                 is_parallel = ?
             WHERE tid = ? AND eid = ?"
        );

        $update->bind_param(
            "ssssssii",
            $tname,
            $tdate,
            $ttime,
            $tlocation,
            $tdescription,
            $is_parallel,
            $id,
            $eid
        );

        if ($update->execute()) {

            header("Location: tech_events.php?eid=" . $eid . "&updated=1");
            exit();

        } else {

            $error = "Error updating event: " . $update->error;
        }

        // Preserve entered values
        $event['tname'] = $tname;
        $event['tdate'] = $tdate;
        $event['ttime'] = $ttime;
        $event['tlocation'] = $tlocation;
        $event['tdescription'] = $tdescription;
        $event['is_parallel'] = $is_parallel;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Technical Event</title>

    <link rel="stylesheet" href="tech_form.css">

</head>

<body>

<main class="form-page">

    <div class="form-card">

        <h1>Edit Technical Event</h1>

        <p>Update the details of your technical event.</p>

        <?php if ($error != "") { ?>

            <div class="error-msg">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php } ?>

        <form method="POST">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <input type="hidden" name="eid" value="<?php echo $eid; ?>">

            <!-- Event Name -->

            <label>Event Name *</label>

            <input
                type="text"
                name="tname"
                required
                value="<?php echo htmlspecialchars($event['tname']); ?>"
            >

            <!-- Date and Time -->

            <div class="form-row">

                <div>
                    <label>Event Date *</label>

                    <input
                        type="date"
                        name="tdate"
                        required
                        value="<?php echo htmlspecialchars($event['tdate']); ?>"
                    >
                </div>

                <div>
                    <label>Event Time *</label>

                    <input
                        type="time"
                        name="ttime"
                        required
                        value="<?php echo htmlspecialchars(substr($event['ttime'], 0, 5)); ?>"
                    >
                </div>

            </div>

            <!-- Event Type -->

            <label>Event Type</label>

            <input
                type="text"
                value="Technical"
                readonly
                class="readonly-field"
            >

            <!-- Parallel Event -->

            <label>Parallel Event</label>

            <select name="is_parallel" required>

                <option value="no"
                    <?php echo ($event['is_parallel'] == 'no') ? 'selected' : ''; ?>>
                    No
                </option>

                <option value="yes"
                    <?php echo ($event['is_parallel'] == 'yes') ? 'selected' : ''; ?>>
                    Yes
                </option>

            </select>

            <!-- Location -->

            <label>Event Location *</label>

            <input
                type="text"
                name="tlocation"
                required
                value="<?php echo htmlspecialchars($event['tlocation']); ?>"
            >

            <!-- Description -->

            <label>Event Description</label>

            <textarea
                name="tdescription"
                rows="4"
            ><?php echo htmlspecialchars($event['tdescription']); ?></textarea>

            <!-- Buttons -->

            <div class="form-actions">

                <a
                    href="tech_events.php?eid=<?php echo $eid; ?>"
                    class="btn btn-light"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    name="update_event"
                    class="btn btn-primary"
                >
                    Update Event
                </button>

            </div>

        </form>

    </div>

</main>

</body>
</html>
