<?php
include "../lab-system/db.php";

$id = $_GET['id'];

$Pselect = "SELECT * FROM products WHERE id = '$id'";
$Presult = mysqli_query($conn, $Pselect);
$Pdata = mysqli_fetch_assoc($Presult);
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

    padding:40px;
    color:#2f241e;
}

/* ===== HEADER PANEL ===== */
header{
    background:linear-gradient(145deg,#ffffff,#f7f1ec);
    border:1px solid rgba(184,115,51,0.18);
    border-radius:18px;

    padding:25px 30px;
    margin-bottom:20px;

    box-shadow:
        0 18px 40px rgba(90,60,40,0.12),
        inset 0 1px 0 rgba(255,255,255,0.85);

    animation:rise 0.55s ease;
}

/* ===== TITLE ===== */
h1{
    font-size:32px;
    letter-spacing:3px;
    text-transform:uppercase;

    color:#8b5a2b;
    margin-bottom:10px;
}

/* ===== PRODUCT SECTION CARDS ===== */
section{
    background:linear-gradient(145deg,#ffffff,#f7f1ec);
    border:1px solid rgba(184,115,51,0.18);
    border-radius:18px;

    padding:25px;
    margin:18px 0;

    box-shadow:
        0 18px 40px rgba(90,60,40,0.10),
        inset 0 1px 0 rgba(255,255,255,0.8);

    animation:rise 0.55s ease;
}

/* ===== SUB HEADINGS ===== */
section h2{
    font-size:18px;
    letter-spacing:2px;
    text-transform:uppercase;

    color:#8b5a2b;
    margin-bottom:15px;
}

/* ===== TEXT BLOCKS ===== */
section p{
    font-size:14px;
    color:#3d2f27;
    margin:6px 0;
    line-height:1.4;
}

/* ===== LABEL HIGHLIGHT ===== */
section p strong{
    color:#6f4a26;
}

/* ===== STATUS BLOCK ===== */
section h3{
    font-size:20px;
    text-transform:uppercase;
    letter-spacing:2px;

    color:#b87333;

    padding:10px 14px;
    display:inline-block;

    border-radius:10px;

    background:rgba(184,115,51,0.08);
    border:1px solid rgba(184,115,51,0.25);
}

/* ===== HR CLEAN ===== */
hr{
    border:none;
    height:1px;
    background:rgba(184,115,51,0.25);
    margin:18px 0;
}

/* ===== FOOTER ===== */
footer{
    text-align:center;
    margin-top:25px;
}

/* ===== BACK BUTTON ===== */
footer a{
    display:inline-block;

    padding:12px 20px;

    text-decoration:none;

    border-radius:12px;

    font-weight:700;
    letter-spacing:1px;
    text-transform:uppercase;

    color:#fff8f2;

    background:linear-gradient(135deg,#b87333,#8b5a2b,#6f4a26);

    box-shadow:
        0 12px 24px rgba(139,90,43,0.18);

    transition:0.3s;
}

/* ===== BACK HOVER ===== */
footer a:hover{
    transform:translateY(-2px);
    box-shadow:0 16px 28px rgba(139,90,43,0.25);
}

/* ===== CLICK ===== */
footer a:active{
    transform:scale(0.97);
}

/* ===== ANIMATION ===== */
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

/* ===== RESPONSIVE ===== */
@media(max-width:700px){
    body{
        padding:20px;
    }

    section{
        padding:18px;
    }

    h1{
        font-size:24px;
    }
}
</style>

<body>

    <!-- HEADER -->
    <header>
        <h1>Product Details</h1>
        <hr>
    

    <!-- PRODUCT CARD -->

        <div>
            <h2><!-- Product Name --></h2>
            <p><strong>Product ID:</strong> <?php echo $Pdata['product_id']; ?></p>
            <p><strong>Product Name:</strong> <?php echo $Pdata['product_name']; ?></p>
        </div>

        <div>
            <p><strong>Type:</strong> <?php echo $Pdata['product_type']; ?></p>
            <p><strong>Revision No:</strong> <?php echo $Pdata['revision_no']; ?></p>
            <p><strong>Manufacturing No:</strong> <?php echo $Pdata['manufacturing_no']; ?></p>
        </div>


    </header>

    <hr>

    <!-- STATUS BLOCK -->
    <section>

        <h2>Status</h2>

        <div>
            <!-- Pass / Fail / Pending -->
            <h3><?php echo $Pdata['status']; ?></h3>
        </div>

    </section>

    <hr>

    <?php
    $Pid = $Pdata['id'];

    $Tselect = "SELECT * FROM tests WHERE product_ref = '$Pid'";
    $Tresult = mysqli_query($conn, $Tselect);
    $Tdata = mysqli_fetch_assoc($Tresult);
    
    ?>

    <!-- TEST HISTORY -->
    <section>

        <h2>Test History</h2>

        <div>
            <p>Test Type: <?php echo $Tdata['test_type']; ?></p>
            <p>Department: <?php echo $Tdata['department']; ?></p>
            <p>Result: <?php echo $Tdata['result']; ?></p>
            <p>Remarks: <?php echo $Tdata['remarks']; ?></p>
            <hr>
        </div>

    </section>

    <hr>

    <!-- FOOTER -->
    <footer>
        <a href="list.php">← Back</a>
    </footer>

</body>
</html>