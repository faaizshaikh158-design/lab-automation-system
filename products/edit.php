<?php
include "../lab-system/db.php";

$query = "SELECT * FROM products";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

$productName = $productType = $revisionNo = $manufacturingNo = '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    /* ===== RESET (same system consistency) ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* ===== BODY (same warm industrial lab base) ===== */
body{
    font-family:'Segoe UI', sans-serif;
    background:linear-gradient(135deg,#f3ece7,#d8cbc2,#eee6df);
    min-height:100vh;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    padding:40px;
    color:#2f241e;
}

/* ===== TITLE ===== */
h1{
    position:absolute;
    top:35px;
    font-size:34px;
    letter-spacing:3px;
    text-transform:uppercase;
    color:#8b5a2b;
    text-shadow:0 4px 10px rgba(90,60,40,0.12);
}

/* ===== FORM PANEL (EDIT MODE = slightly sharper feel) ===== */
form{
    width:100%;
    max-width:520px;
    padding:40px;

    border-radius:18px;

    background:linear-gradient(145deg,#ffffff,#f7f1ec);

    border:1px solid rgba(184,115,51,0.22);

    box-shadow:
        0 20px 45px rgba(90,60,40,0.14),
        inset 0 1px 0 rgba(255,255,255,0.85);

    animation:rise 0.5s ease;
}

/* ===== INPUT FIELDS ===== */
form input{
    width:100%;
    padding:15px 16px;
    margin-bottom:16px;

    border-radius:12px;

    border:1px solid #dfcfc2;

    background:#fffaf6;

    font-size:14px;
    color:#3d2f27;

    outline:none;

    transition:0.25s;
}

/* placeholder */
form input::placeholder{
    color:#9a8576;
}

/* focus = calibration glow */
form input:focus{
    border-color:#b87333;
    background:#ffffff;
    box-shadow:0 0 0 4px rgba(184,115,51,0.12);
}

/* ===== DATE / NUMBER TWEAK CONSISTENCY ===== */
input[type="number"],
input[type="text"]{
    letter-spacing:0.2px;
}

/* ===== BUTTON (UPDATE = stronger authority feel) ===== */
form button{
    width:100%;
    padding:15px;

    border:none;
    border-radius:12px;

    background:linear-gradient(135deg,#8b5a2b,#b87333,#6f4a26);

    color:#fff8f2;

    font-size:15px;
    font-weight:800;

    letter-spacing:1px;
    text-transform:uppercase;

    cursor:pointer;

    box-shadow:
        0 14px 28px rgba(139,90,43,0.22),
        inset 0 1px 0 rgba(255,255,255,0.25);

    transition:0.3s;
}

/* hover = system recalibration feel */
form button:hover{
    transform:translateY(-2px);
    box-shadow:
        0 18px 34px rgba(139,90,43,0.28),
        0 0 12px rgba(184,115,51,0.18);
    filter:brightness(1.05);
}

/* click = mechanical press */
form button:active{
    transform:scale(0.98);
}

/* ===== REMOVE LINK STYLE ===== */
a{
    text-decoration:none;
}

/* ===== ENTRY ANIMATION ===== */
@keyframes rise{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
</style>

<body>
    <h1>EDIT PRODUCT</h1>
    <form action="" method="post">
        <input type="text" name="productName" placeholder="Ennter Product Name" value="<?php echo $row['product_name']; ?>">
        <input type="text" name="productType" placeholder="Ennter Product type" value="<?php echo $row['product_type']; ?>">
        <input type="number" name="revisionNo" placeholder="Ennter Revision Number" value="<?php echo $row['revision_no']; ?>">
        <input type="number" name="manufacturingNo" placeholder="Ennter Manufacturing Number" value="<?php echo $row['manufacturing_no']; ?>">
        <a href=""><button type="submit" name="submit">Update Product</button></a>
    </form>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $productName = $_POST['productName'];
    $productType = $_POST['productType'];
    $revisionNo = $_POST['revisionNo'];
    $manufacturingNo = $_POST['manufacturingNo'];

    if(empty($productName) || empty($productType) ||  empty($revisionNo) || empty($manufacturingNo)){
        die("<script>alert('All Fields Are Required')</script>");
        exit;
    }

    $id = $_GET['id'];

    $query = "UPDATE products SET product_name = '$productName', product_type = '$productType', revision_no = '$revisionNo', manufacturing_no = '$manufacturingNo' WHERE id = $id";

    mysqli_query($conn, $query);

    header("Location: list.php");
}
?>