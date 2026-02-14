<?php
include '../db.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM `basic-table` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?php echo $row['invoice_no']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .invoice-card {
            max-width: 600px;
            margin: 50px auto;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .invoice-header {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
            text-align: center;
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .bg-paid { background: #d1e7dd; color: #0f5132; }
        .bg-pending { background: #fff3cd; color: #856404; }
        .bg-cancelled { background: #f8d7da; color: #842029; }
    </style>
</head>
<body>

<div class="container">
    <div class="card invoice-card">
        <div class="invoice-header">
            <h3 class="mb-0">Invoice Details</h3>
            <small>ID: <?php echo $row['id']; ?></small>
        </div>
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-6 text-muted">Invoice No:</div>
                <div class="col-6 fw-bold text-primary"><?php echo $row['invoice_no']; ?></div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-6 text-muted">Customer Name:</div>
                <div class="col-6 fw-bold"><?php echo $row['customer_name']; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted">Issued Date:</div>
                <div class="col-6 text-secondary"><?php echo $row['issued_date']; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted">Total Amount:</div>
                <div class="col-6 fw-bolder text-dark">$<?php echo number_format($row['amount'], 2); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted">Status:</div>
                <div class="col-6">
                    <?php 
                        $statusClass = 'bg-' . strtolower($row['status']);
                        echo "<span class='status-badge $statusClass'>" . strtoupper($row['status']) . "</span>";
                    ?>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <a href="table-data.php" class="btn btn-outline-secondary px-4">← Back to List</a>
                <button onclick="window.print()" class="btn btn-primary px-4">Print Invoice</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
    } else {
        echo "<div class='alert alert-danger'>Record not found!</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No ID provided!</div>";
}
?>