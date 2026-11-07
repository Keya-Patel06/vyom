<?php

include "sdb.php";


if (!isset($_GET['id'])) {

    header("Location: student.php");

    exit();

}


$id = intval($_GET['id']);


$sql = "DELETE FROM student WHERE id = ?";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);


if ($stmt->execute()) {

    header("Location: student.php?deleted=1");

    exit();

} else {

    echo "Error deleting student.";

}


$conn->close();

?>