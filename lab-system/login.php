<?php
include "db.php";

session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        die("<script>alert('All Fields Are Required')</script>");
        exit;
    }

    $query = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($result);

    if($username != $user['username']){
        die("<script>alert('Account Not Found')</script>");
        exit;
    }
    
    if($password != $user['password']){
        die("<script>alert('Incorrect Password')</script>");
        exit;
    }

    if($user['role'] == 'admin'){

    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $user['password'];

    header("Location: dashboard.php");
    }
    if($user['role'] == 'tester'){

    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $user['password'];

    header("Location: ../tests/add.php");
    }
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

/* ===== LOGIN TITLE ===== */
h1{
    position:absolute;
    top:40px;

    font-size:32px;
    letter-spacing:4px;
    text-transform:uppercase;

    color:#8b5a2b;

    text-shadow:0 4px 10px rgba(90,60,40,0.12);
}

/* ===== FORM CONTAINER ===== */
form{
    width:100%;
    max-width:420px;

    padding:40px;

    border-radius:18px;

    background:linear-gradient(145deg,#ffffff,#f7f1ec);

    border:1px solid rgba(184,115,51,0.18);

    box-shadow:
        0 20px 45px rgba(90,60,40,0.12),
        inset 0 1px 0 rgba(255,255,255,0.85);

    animation:rise 0.55s ease;

    display:flex;
    flex-direction:column;
    gap:14px;
}

/* ===== INPUT FIELDS ===== */
form input{
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
form input::placeholder{
    color:#9a8576;
}

/* ===== FOCUS EFFECT ===== */
form input:focus{
    border-color:#b87333;
    background:#ffffff;

    box-shadow:0 0 0 4px rgba(184,115,51,0.12);
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
    box-shadow:
        0 18px 34px rgba(139,90,43,0.25);
    filter:brightness(1.05);
}

/* ===== BUTTON CLICK ===== */
form button:active{
    transform:scale(0.98);
}

/* ===== LINK RESET ===== */
a{
    text-decoration:none;
    color: black;
    text-align: center;
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
@media(max-width:600px){
    body{
        padding:20px;
    }

    h1{
        font-size:22px;
        top:20px;
    }

    form{
        padding:25px;
    }
}
</style>

<body>
    <h1>LOGIN YOUR ACCOUNT</h1>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Enter Your Username">
        <input type="password" name="password" placeholder="Enter Your Password">
        <a href=""><button type="submit" name="submit">LOGIN</button></a>
        <a href="../users/add.php">← Register</a>
    </form>
</body>
</html>