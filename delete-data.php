<?php
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `Basic-Table` WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        header("Location: data-table.php?msg=deleted");
    }
}
?>