<?php
include "../lab-system/db.php";
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}

// FILTER VALUES
$product_id = $_GET['product_id'] ?? '';
$result = $_GET['result'] ?? '';
$from = $_GET['from_date'] ?? '';
$to = $_GET['to_date'] ?? '';

// PRODUCTS LIST
$products = mysqli_query($conn, "SELECT * FROM products");

// MAIN QUERY
$query = "
SELECT tests.*, products.product_name, users.username
FROM tests
JOIN products ON tests.product_ref = products.id
JOIN users ON tests.tested_by = users.id
WHERE 1=1
";

if($product_id != ''){
    $query .= " AND products.id = '$product_id'";
}

if($result != ''){
    $query .= " AND tests.result = '$result'";
}

if($from != '' && $to != ''){
    $query .= " AND tests.test_date BETWEEN '$from' AND '$to'";
}

$query .= " ORDER BY tests.id DESC";

$records = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f1ec;
            padding:20px;
            color:#2d2d2d;
        }

        h1{
            text-align:center;
            color:#7a4b2a;
        }

        .box{
            background:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        select, input{
            padding:8px;
            margin:5px;
        }

        button{
            padding:10px 15px;
            background:#7a4b2a;
            color:white;
            border:none;
            cursor:pointer;
            border-radius:5px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th, td{
            border:1px solid #ddd;
            padding:10px;
            text-align:center;
        }

        th{
            background:#7a4b2a;
            color:white;
        }

        @media print{
            button, form{
                display:none;
            }
        }
    </style>

</head>

<body>

<h1>Lab Test Reports</h1>

<!-- FILTER FORM -->
<div class="box">
<form method="GET">

    <select name="product_id">
        <option value="">All Products</option>
        <?php while($p = mysqli_fetch_assoc($products)){ ?>
            <option value="<?php echo $p['id']; ?>">
                <?php echo $p['product_name']; ?>
            </option>
        <?php } ?>
    </select>

    <select name="result">
        <option value="">All Results</option>
        <option value="pass">Pass</option>
        <option value="fail">Fail</option>
    </select>

    <input type="date" name="from_date">
    <input type="date" name="to_date">

    <button type="submit">Filter</button>

</form>
</div>

<!-- PRINT BUTTON -->
<button onclick="window.print()">Print Report</button>

<!-- TABLE -->
<div class="box">

<table>
    <tr>
        <th>Product</th>
        <th>Test Type</th>
        <th>Department</th>
        <th>Result</th>
        <th>Remarks</th>
        <th>Tester</th>
        <th>Date</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($records)){ ?>

    <tr>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['test_type']; ?></td>
        <td><?php echo $row['department']; ?></td>
        <td><?php echo $row['result']; ?></td>
        <td><?php echo $row['remarks']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['test_date']; ?></td>
    </tr>

    <?php } ?>

</table>

</div>

</body>
</html>