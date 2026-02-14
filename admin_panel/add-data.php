<?php
include '../db.php';

// 1. Insert Logic: Jab user "Add Invoice" button dabaye
if (isset($_POST['add_btn'])) {
    $invoice_no = mysqli_real_escape_string($conn, $_POST['invoice_no']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $issued_date = mysqli_real_escape_string($conn, $_POST['issued_date']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Query: Table name `basic-table` backticks mein
    $insert_query = "INSERT INTO `basic-table` (invoice_no, customer_name, issued_date, amount, status) 
                     VALUES ('$invoice_no', '$customer_name', '$issued_date', '$amount', '$status')";

    if (mysqli_query($conn, $insert_query)) {
        header("Location: table-data.php?msg=added");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .add-card { max-width: 600px; margin: 50px auto; border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .card-header { background: #0d6efd; color: white; border-radius: 15px 15px 0 0 !important; padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card add-card">
        <div class="card-header text-center">
            <h3 class="mb-0">Add New Invoice</h3>
        </div>
        <div class="card-body p-4">
            
            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form action="add-data.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Invoice Number</label>
                    <input type="text" name="invoice_no" class="form-control" placeholder="e.g. #526534" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="Enter name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Issued Date</label>
                    <input type="date" name="issued_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Amount ($)</label>
                    <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" name="add_btn" class="btn btn-primary w-100 py-2 fw-bold">Add Invoice</button>
                    <a href="table-data.php" class="btn btn-outline-secondary w-100 py-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>