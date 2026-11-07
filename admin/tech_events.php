
<?php
require_once __DIR__ . "/edb.php";

$eid = isset($_GET['eid']) ? (int)$_GET['eid'] : 0;
$search = trim($_GET['search'] ?? "");

// Fetch technical events
if ($eid > 0 && $search != "") {

    $stmt = $conn->prepare(
        "SELECT * FROM tech_events
         WHERE eid = ?
         AND (tname LIKE ? OR tlocation LIKE ? OR tdescription LIKE ?)
         ORDER BY tdate DESC"
    );

    $like = "%" . $search . "%";
    $stmt->bind_param("isss", $eid, $like, $like, $like);

} elseif ($eid > 0) {

    $stmt = $conn->prepare(
        "SELECT * FROM tech_events
         WHERE eid = ?
         ORDER BY tdate DESC"
    );

    $stmt->bind_param("i", $eid);

} elseif ($search != "") {

    $stmt = $conn->prepare(
        "SELECT * FROM tech_events
         WHERE tname LIKE ? OR tlocation LIKE ? OR tdescription LIKE ?
         ORDER BY tdate DESC"
    );

    $like = "%" . $search . "%";
    $stmt->bind_param("sss", $like, $like, $like);

} else {

    $stmt = $conn->prepare(
        "SELECT * FROM tech_events ORDER BY tdate DESC"
    );
}

$stmt->execute();
$result = $stmt->get_result();

$totalEvents = $result->num_rows;

function clean($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Technical Events - Vyom</title>

    <link rel="stylesheet" href="tech_events.css">
</head>

<body>
    
<?php
include "header.php";
?>

<main class="events-main">

    <!-- Page Heading -->

    <div class="page-heading">

        <div>
            <h1>▦ Technical Events</h1>
            <p>Manage college technical events</p>
        </div>

        <div class="heading-actions">

            <div class="total-card">
                <span>Total Events</span>
                <h2><?php echo $totalEvents; ?></h2>
            </div>

            <a href="add_tech_events.php?eid=<?php echo $eid; ?>"
               class="add-btn">
                + Add Event
            </a>

        </div>

    </div>

    <!-- Success Messages -->

    <?php if (isset($_GET['added'])) { ?>
        <div class="success-msg">Event added successfully!</div>
    <?php } ?>

    <?php if (isset($_GET['updated'])) { ?>
        <div class="success-msg">Event updated successfully!</div>
    <?php } ?>

    <?php if (isset($_GET['deleted'])) { ?>
        <div class="success-msg">Event deleted successfully!</div>
    <?php } ?>

    <!-- Search Bar -->

    <form method="GET" action="tech_events.php" class="search-box">

        <input type="hidden" name="eid" value="<?php echo $eid; ?>">

        <input
            type="text"
            name="search"
            placeholder="⌕ Search event by name, location..."
            value="<?php echo clean($search); ?>"
        >

        <button type="submit">Search</button>

    </form>

    <!-- Events Table -->

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Parallel</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php if ($totalEvents > 0) { ?>

                    <?php while ($event = $result->fetch_assoc()) { ?>

                        <tr>

                            <td><?php echo (int)$event['tid']; ?></td>

                            <td class="event-name">
                                <?php echo clean($event['tname']); ?>
                            </td>

                            <td>
                                <?php echo clean($event['tdate']); ?>
                            </td>

                            <td>
                                <?php
                                echo clean(date("H:i", strtotime($event['ttime'])));
                                ?>
                            </td>

                            <td>
                                <span class="type-badge">Technical</span>
                            </td>

                            <td>
                                <?php echo clean($event['is_parallel']); ?>
                            </td>

                            <td>
                                📍 <?php echo clean($event['tlocation']); ?>
                            </td>

                            <td class="description">
                                <?php echo clean($event['tdescription']); ?>
                            </td>

                            <td class="actions">

                                <a
                                    href="edit_tech_event.php?id=<?php echo (int)$event['tid']; ?>&eid=<?php echo (int)$event['eid']; ?>"
                                    class="edit-btn"
                                    title="Edit">
                                    ✎
                                </a>

                                <form
                                    action="delete_tech_event.php"
                                    method="POST"
                                    class="delete-form"
                                    onsubmit="return confirm('Are you sure you want to delete this event?');">

                                    <input type="hidden" name="id"
                                           value="<?php echo (int)$event['tid']; ?>">

                                    <input type="hidden" name="eid"
                                           value="<?php echo (int)$event['eid']; ?>">

                                    <button type="submit"
                                            class="delete-btn"
                                            title="Delete">
                                        🗑
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="9" class="no-data">
                            No technical events found.
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</main>

</body>
</html>
