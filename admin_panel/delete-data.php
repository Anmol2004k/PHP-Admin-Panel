<?php
include '../db.php';

if (isset($_GET['id'])) {
    // 1. ID ko safe banayein
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 2. Delete Query (Table name check karein: basic-table)
    $delete_query = "DELETE FROM `basic-table` WHERE id = '$id'";

    if (mysqli_query($conn, $delete_query)) {
        // 3. Delete hone ke baad wapas table par bhej do ek message ke sath
        header("Location: table-data.php?msg=deleted");
        exit();
    } else {
        // Agar koi error aaye
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // Agar URL mein ID hi na ho
    header("Location: table-data.php");
    exit();
}
?>

 