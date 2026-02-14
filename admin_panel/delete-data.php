<?php
include('db.php');
$id = $_GET['id'];
$query = "DELETE FROM your_table_name WHERE id = $id";
if(mysqli_query($conn, $query)) {
    header("Location: admin_panel/table-data.php?msg=deleted");
}
?>



 