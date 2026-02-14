<?php
include '../db.php';

// 1. Update Logic: Jab user "Save Changes" button dabaye
if (isset($_POST['update_btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $invoice_no = mysqli_real_escape_string($conn, $_POST['invoice_no']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $update_query = "UPDATE `basic-table` SET 
                    invoice_no = '$invoice_no', 
                    customer_name = '$customer_name', 
                    amount = '$amount', 
                    status = '$status' 
                    WHERE id = '$id'";

    if (mysqli_query($conn, $update_query)) {
        // Update hone ke baad wapas table page par bhej do
        header("Location: table-data.php?msg=updated");
        exit();
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}

// 2. Fetch Logic: Pehle wala data form mein dikhane ke liye
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM `basic-table` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .edit-card { max-width: 600px; margin: 50px auto; border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .card-header { background: #198754; color: white; border-radius: 15px 15px 0 0 !important; padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card edit-card">
        <div class="card-header text-center">
            <h3 class="mb-0">Edit Invoice Data</h3>
        </div>
        <div class="card-body p-4">
            
            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form action="edit-data.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Invoice Number</label>
                    <input type="text" name="invoice_no" class="form-control" value="<?php echo $row['invoice_no']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" value="<?php echo $row['customer_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Amount ($)</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="<?php echo $row['amount']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Paid" <?php if($row['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                        <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Cancelled" <?php if($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" name="update_btn" class="btn btn-success w-100 py-2 fw-bold">Save Changes</button>
                    <a href="table-data.php" class="btn btn-outline-secondary w-100 py-2">Cancel</a>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>