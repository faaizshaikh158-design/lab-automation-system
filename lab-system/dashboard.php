 <?php
include "db.php";

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['username'] == ''){
    header("Location: login.php");
    exit;
}

$select = "SELECT * FROM users";
$result = mysqli_query($conn, $select);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
    margin-bottom:25px;

    box-shadow:
        0 18px 40px rgba(90,60,40,0.12),
        inset 0 1px 0 rgba(255,255,255,0.8);

    animation:rise 0.5s ease;
}

/* ===== DASHBOARD TITLE ===== */
header h1{
    font-size:32px;
    letter-spacing:3px;
    text-transform:uppercase;
    color:#8b5a2b;
    margin-bottom:8px;
}

/* ===== USER INFO ===== */
header p{
    font-size:14px;
    color:#3d2f27;
    margin:4px 0;
}

/* ===== ROLE HIGHLIGHT ===== */
header p:nth-of-type(2){
    color:#6f4a26;
    font-weight:600;
}

/* ===== HR CLEAN STYLE ===== */
hr{
    border:none;
    height:1px;
    background:rgba(184,115,51,0.25);
    margin:15px 0;
}

/* ===== MAIN PANEL ===== */
main{
    background:linear-gradient(145deg,#ffffff,#f7f1ec);
    border:1px solid rgba(184,115,51,0.18);
    border-radius:18px;

    padding:30px;

    box-shadow:
        0 18px 40px rgba(90,60,40,0.10),
        inset 0 1px 0 rgba(255,255,255,0.8);

    animation:rise 0.55s ease;
}

/* ===== CONTROL PANEL TITLE ===== */
main h2{
    font-size:20px;
    letter-spacing:2px;
    text-transform:uppercase;
    color:#8b5a2b;
    margin-bottom:20px;
}

/* ===== NAV LIST ===== */
nav ul{
    list-style:none;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:15px;
}

/* ===== NAV ITEMS ===== */
nav ul li a{
    display:block;
    padding:14px 16px;

    text-decoration:none;
    text-align:center;

    border-radius:12px;

    font-weight:700;
    letter-spacing:0.6px;
    text-transform:uppercase;
    font-size:13px;

    color:#fff8f2;

    background:linear-gradient(135deg,#b87333,#8b5a2b,#6f4a26);

    box-shadow:0 10px 20px rgba(139,90,43,0.18);

    transition:0.25s;
}

/* ===== NAV HOVER ===== */
nav ul li a:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 26px rgba(139,90,43,0.25);
    filter:brightness(1.05);
}

/* ===== FOOTER ===== */
footer{
    margin-top:25px;
    text-align:center;
}

/* ===== LOGOUT BUTTON ===== */
footer a{
    display:inline-block;
    padding:12px 20px;

    text-decoration:none;

    border-radius:12px;

    font-weight:700;
    letter-spacing:1px;
    text-transform:uppercase;

    color:#fff8f2;

    background:linear-gradient(135deg,#7a1f1f,#a83232,#5a1010);

    box-shadow:
        0 10px 18px rgba(122,31,31,0.25);

    transition:0.25s;
}

/* ===== LOGOUT HOVER ===== */
footer a:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 26px rgba(168,50,50,0.3);
}

/* ===== CLICK EFFECT ===== */
nav ul li a:active,
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

    nav ul{
        grid-template-columns:1fr;
    }
}
</style>

<body>

    <!-- HEADER -->
    <header>
        <?php
        if($user['username'] == $_SESSION['username']){
        ?>

        <h1>Dashboard</h1>
        <p>Welcome, <?php echo $user['username']; ?></p>
        <p>Role: <?php echo $user['role']; ?></p>
        <hr>

        <?php
        }
        ?>
    </header>

    <!-- MAIN MENU -->
    <main>

        <h2>Control Panel</h2>

        <nav>
            <ul>

                <li>
                    <a href="../products/add.php">Add Product</a>
                </li>

                <li>
                    <a href="../products/list.php">Products</a>
                </li>

                <li>
                    <a href="../tests/add.php">Add Test</a>
                </li>

                <li>
                    <a href="../tests/list.php">Tests</a>
                </li>

                <li>
                    <a href="../reports/reports.php">Reports</a>
                </li>

                <li>
                    <a href="../users/list.php">Users</a>
                </li>

            </ul>
        </nav>

    </main>

    <hr>

    <!-- FOOTER ACTION -->
    <footer>
        <a href="logout.php">Logout</a>
    </footer>

</body>
</html>