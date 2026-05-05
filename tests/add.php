<?php
include "../lab-system/db.php";

$spfd = mysqli_query($conn, "SELECT * FROM products");
$user = mysqli_query($conn, "SELECT * FROM users");

if(isset($_POST['submit'])){
    $selectProduct = $_POST['select_product'];
    $testType = $_POST['test_type'];
    $department = $_POST['department'];
    $result = $_POST['result'];
    $remarks = $_POST['remarks'];
    $testedBy = $_POST['select_id'];
    $testDate = $_POST['test_date'];

    if(empty($selectProduct) || empty($testType) || empty($department) || empty($result) || empty($remarks) || empty($testedBy) || empty($testDate)){
        die("<script>alert('All Fields Are Required')</script>");
        header("Location: add.php");
        exit;
    }

    $check = mysqli_query($conn, "SELECT * FROM tests");

    $max = 0;

    while($row = mysqli_fetch_assoc($check)){
        $id = $row['test_id'];

        $num = (int)$id;

        if ($num > $max) {
        $max = $num;
        }
    }

    $new_number = $max + 1;

    $productid = str_pad($new_number, 10, "0", STR_PAD_LEFT);

    $query = "INSERT INTO tests (test_id, product_ref, test_type, department, result, remarks, tested_by, test_date) 
    VALUES ('$productid', '$selectProduct', '$testType', '$department', '$result', '$remarks', '$testedBy', '$testDate')";

    mysqli_query($conn, $query);

    $update = "UPDATE products SET status = '$result' WHERE id = '$selectProduct'";
    mysqli_query($conn, $update);

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

/* ===== BODY ===== */
body{
    font-family:'Segoe UI', sans-serif;
    background:linear-gradient(135deg,#f3ece7,#d8cbc2,#eee6df);
    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;

    padding:40px;
    color:#2f241e;
}

/* ===== HEADING (SIDE LABEL STYLE) ===== */
h1{
    position:fixed;
    left:30px;
    top:50%;
    transform:translateY(-50%) rotate(-90deg);

    font-size:28px;
    letter-spacing:4px;
    text-transform:uppercase;

    color:#8b5a2b;
    opacity:0.85;

    text-shadow:0 4px 10px rgba(90,60,40,0.12);

    z-index:10;
}

/* ===== FORM CONTAINER ===== */
form{
    width:100%;
    max-width:560px;

    padding:40px;

    border-radius:18px;

    background:linear-gradient(145deg,#ffffff,#f7f1ec);

    border:1px solid rgba(184,115,51,0.18);

    box-shadow:
        0 18px 40px rgba(90,60,40,0.12),
        inset 0 1px 0 rgba(255,255,255,0.85);

    animation:rise 0.55s ease;

    display:flex;
    flex-direction:column;
    gap:14px;
}

/* ===== INPUT / SELECT / TEXTAREA ===== */
form input,
form select,
form textarea{
    width:100%;
    padding:14px 16px;

    border-radius:12px;

    border:1px solid #dfcfc2;

    background:#fffaf6;

    font-size:14px;
    color:#3d2f27;

    outline:none;

    transition:0.25s;
}

/* ===== PLACEHOLDER ===== */
form input::placeholder,
form textarea::placeholder{
    color:#9a8576;
}

/* ===== FOCUS ===== */
form input:focus,
form select:focus,
form textarea:focus{
    border-color:#b87333;
    background:#ffffff;

    box-shadow:0 0 0 4px rgba(184,115,51,0.12);
}

/* ===== TEXTAREA ===== */
textarea{
    min-height:110px;
    resize:none;
}

/* ===== SELECT ===== */
select{
    cursor:pointer;
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
    font-weight:800;

    letter-spacing:1px;
    text-transform:uppercase;

    cursor:pointer;

    box-shadow:
        0 14px 28px rgba(139,90,43,0.18),
        inset 0 1px 0 rgba(255,255,255,0.2);

    transition:0.3s;
}

/* ===== BUTTON HOVER ===== */
form button:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 32px rgba(139,90,43,0.25);
    filter:brightness(1.05);
}

/* ===== BUTTON ACTIVE ===== */
form button:active{
    transform:scale(0.98);
}

/* ===== LINK RESET ===== */
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
    body{
        padding:20px;
    }

    h1{
        font-size:20px;
        left:10px;
    }

    form{
        padding:25px;
    }
}
</style>

<body>
    <h1>Add Test</h1>
    <form action="" method="post">
        <input type="hidden" name="testid" placeholder="Ennter Test ID">
        <select name="select_product">
            <option value="Select Your Product">Select Your Product</option>

            <?php
            while($sp = mysqli_fetch_assoc($spfd)){
            ?>

            <option value="<?php echo $sp['id']; ?>"> <?php echo $sp['product_id']; ?> </option>

            <?php } ?>
        </select>

        <input type="text" name="test_type" placeholder="Test Type">
        <input type="text" name="department" placeholder="Department">
        <select name="result">
            <option value="pass">Results</option>
            <option value="pass">Pass</option>
            <option value="fail">Fail</option>
        </select>
        <textarea name="remarks" placeholder="Remarks"></textarea>
        
        <select name="select_id">
            <option value="Select Your id">Select Your Username</option>

            <?php
            while($su = mysqli_fetch_assoc($user)){
            ?>

            <option value="<?php echo $su['id']; ?>"> <?php echo $su['username']; ?> </option>

            <?php } ?>
        </select>

        <input type="date" name="test_date" placeholder="Testing Date">
        <a href=""><button type="submit" name="submit">Add Product</button></a>
    </form>
</body>
</html>