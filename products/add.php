<?php
include "../lab-system/db.php";

if(isset($_POST['submit'])){
    $productName = $_POST['productName'];
    $productType = $_POST['productType'];
    $revisionNo = $_POST['revisionNo'];
    $manufacturingNo = $_POST['manufacturingNo'];
    $manufactureDate = $_POST['manufactureDate'];

    if(empty($productName) || empty($productType) || empty($revisionNo) || empty($manufacturingNo) || empty($manufactureDate)){
        die("<script>alert('All Fields Are Required')</script>");
        header("Location: add.php");
        exit;
    }

    $check = mysqli_query($conn, "SELECT product_id FROM products");

    $currentYear = date("Y");
    $max = 0;

    while($row = mysqli_fetch_assoc($check)){
        $id = $row['product_id'];

        $num = (int)substr($id, 4);

        if ($num > $max) {
        $max = $num;
        }
    }

    $new_number = $max + 1;

    $productid = $currentYear . str_pad($new_number, 6, "0", STR_PAD_LEFT);

    $query = "INSERT INTO products (product_id, product_name, product_type,	revision_no, manufacturing_no, manufacture_date) 
    VALUES ('$productid', '$productName', '$productType', '$revisionNo', '$manufacturingNo', '$manufactureDate')";

    mysqli_query($conn, $query);

    echo "<script>alert('Your Product Is Added')</script>";

    header("Location: list.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
/* ===== RESET ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI', sans-serif;
    background:linear-gradient(135deg,#f3ece7,#d8cbc2,#eee6df);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px;
    color:#2f241e;
}

/* ===== HEADING ===== */
h1{
    position:absolute;
    top:35px;
    font-size:34px;
    letter-spacing:3px;
    text-transform:uppercase;
    color:#8b5a2b;
    text-shadow:0 4px 10px rgba(90,60,40,0.12);
}

/* ===== FORM BOX ===== */
form{
    width:100%;
    max-width:540px;
    padding:40px;
    border-radius:18px;
    background:linear-gradient(145deg,#ffffff,#f7f1ec);
    border:1px solid rgba(184,115,51,0.18);
    box-shadow:
        0 18px 40px rgba(90,60,40,0.12),
        inset 0 1px 0 rgba(255,255,255,0.8);
    animation:rise 0.55s ease;
}

/* ===== INPUTS ===== */
form input{
    width:100%;
    padding:15px 16px;
    margin-bottom:16px;
    border-radius:12px;
    border:1px solid #dfcfc2;
    background:#fffaf6;
    outline:none;
    font-size:14px;
    color:#3d2f27;
    transition:0.25s;
}

/* placeholder */
form input::placeholder{
    color:#9a8576;
}

/* focus */
form input:focus{
    border-color:#b87333;
    background:#ffffff;
    box-shadow:0 0 0 4px rgba(184,115,51,0.12);
}

/* date input */
input[type="date"]{
    color:#6b5648;
}

/* ===== BUTTON ===== */
form button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#b87333,#8b5a2b,#6f4a26);
    color:#fff8f2;
    font-size:15px;
    font-weight:700;
    letter-spacing:0.8px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 12px 24px rgba(139,90,43,0.18);
}

form button:hover{
    transform:translateY(-2px);
    box-shadow:0 16px 28px rgba(139,90,43,0.24);
}

form button:active{
    transform:scale(0.98);
}

/* remove link style */
a{
    text-decoration:none;
}

/* ===== ANIMATION ===== */
@keyframes rise{
    from{
        opacity:0;
        transform:translateY(22px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* ===== RESPONSIVE ===== */
@media(max-width:600px){
    form{
        padding:26px;
    }

    h1{
        font-size:24px;
        top:20px;
    }
}
</style>

<body>
    <h1>ADD PRODUCT</h1>
    <form action="" method="post">
        <input type="hidden" name="productid" placeholder="Ennter Product ID">
        <input type="text" name="productName" placeholder="Ennter Product Name">
        <input type="text" name="productType" placeholder="Ennter Product type">
        <input type="number" name="revisionNo" placeholder="Ennter Revision Number">
        <input type="number" name="manufacturingNo" placeholder="Ennter Manufacturing Number">
        <input type="date" name="manufactureDate" placeholder="Ennter Manufacturing Date">
        <a href=""><button type="submit" name="submit">Add Product</button></a>
    </form>
</body>



</html>