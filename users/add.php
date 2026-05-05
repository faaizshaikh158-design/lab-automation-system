<?php
include "../lab-system/db.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if(empty($name) || empty($userName) || empty($password) || empty($role)){
        die("<script>alert('All Fields Are Required')</script>");
        exit;
    }

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$userName'");

    if(mysqli_num_rows($check) > 0){
        die("<script>alert('Username Already Exist')</script>");
        exit;
    }

    if(strlen($password) < 6){
        die("<script>alert('Password Is Too Short')</script>");
        exit;
    }

    if(strlen($password) > 20){
        die("<script>alert('Password Is Too Long')</script>");
        exit;
    }

    $query = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$userName', '$password', '$role')";

    mysqli_query($conn, $query);

    header("Location: ../lab-system/login.php");
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

/* ===== TITLE ===== */
h1{
    position:absolute;
    top:40px;

    font-size:32px;
    letter-spacing:4px;
    text-transform:uppercase;

    color:#8b5a2b;

    text-shadow:0 4px 10px rgba(90,60,40,0.12);
}

/* ===== FORM PANEL ===== */
form{
    width:100%;
    max-width:460px;

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

/* ===== INPUT + SELECT ===== */
form input,
form select{
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

/* ===== FOCUS ===== */
form input:focus,
form select:focus{
    border-color:#b87333;
    background:#ffffff;

    box-shadow:0 0 0 4px rgba(184,115,51,0.12);
}

/* ===== SELECT STYLE ===== */
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
        font-size:22px;
        top:20px;
    }

    form{
        padding:25px;
    }
}
</style>

<body>
    <h1>REGISTRATION</h1>
    <form action="" method="post">
        <input type="text" name="name" placeholder="Ennter Your Name">
        <input type="text" name="userName" placeholder="Ennter Username">
        <input type="password" name="password" placeholder="Ennter Password">
        <select name="role">
            <option value="">Role</option>
            <option value="tester">Tester</option>
            <option value="admin">Admin</option>
        </select>
        <a href=""><button type="submit" name="submit">REGISTER</button></a>
    </form>
</body>
</html>