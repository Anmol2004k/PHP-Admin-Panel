<?php
include '../db.php';

// URL se ID lena
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Query: Table name backticks mein hona chahiye
    $query = "SELECT * FROM `basic-table` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if($row = mysqli_fetch_assoc($result)) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Invoice Details</title>
            <style>
                body { font-family: sans-serif; padding: 20px; }
                .detail-box { border: 1px solid #ccc; padding: 15px; width: 400px; line-height: 2; }
                .label { font-weight: bold; color: #555; }
            </style>
        </head>
        <body>
            <h2>Invoice Details</h2>
            <div class="detail-box">
                <p><span class="label">ID:</span> <?php echo $row['id']; ?></p>
                <p><span class="label">Invoice No:</span> <?php echo $row['invoice_no']; ?></p>
                <p><span class="label">Customer Name:</span> <?php echo $row['customer_name']; ?></p>
                <p><span class="label">Issued Date:</span> <?php echo $row['issued_date']; ?></p>
                <p><span class="label">Amount:</span> $<?php echo $row['amount']; ?></p>
                <p><span class="label">Status:</span> <?php echo $row['status']; ?></p>
            </div>
            <br>
            <a href="datatable.php">← Back to Table</a>
        </body>
        </html>
        <?php
    } else {
        echo "Record not found!";
    }
} else {
    echo "No ID provided!";
}
?>