<?php
include "../lab-system/db.php";

$query = "SELECT * FROM users";

$result = mysqli_query($conn, $query);
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

/* ===== TABLE ===== */
table{
    width:100%;
    border-collapse:collapse;
    background:linear-gradient(145deg,#ffffff,#f7f1ec);
    border-radius:18px;
    overflow:hidden;

    border:1px solid rgba(184,115,51,0.18);

    box-shadow:
        0 18px 40px rgba(90,60,40,0.12),
        inset 0 1px 0 rgba(255,255,255,0.8);

    animation:rise 0.55s ease;
}

/* ===== HEADER ===== */
table th{
    background:linear-gradient(135deg,#b87333,#8b5a2b,#6f4a26);
    color:#fff8f2;

    padding:16px 14px;
    text-align:left;

    font-size:13px;
    font-weight:700;

    text-transform:uppercase;
    letter-spacing:0.8px;
}

/* ===== CELLS ===== */
table td{
    padding:14px;
    font-size:14px;
    color:#3d2f27;
    border-bottom:1px solid #e9ddd3;
    transition:0.25s;
}

/* ===== ALTERNATE ROWS ===== */
table tr:nth-child(even){
    background:linear-gradient(90deg,#faf6f2,#f3ece6);
}

/* ===== HOVER ===== */
table tr:hover td{
    background:linear-gradient(90deg,#fff4eb,#f7e6d7);
    color:#8b5a2b;
}

/* ===== SPECIAL COLUMNS ===== */
table td:nth-child(1){
    color:#b87333;
    font-weight:700;
}

table td:nth-child(5){
    font-weight:600;
    color:#6f4a26;
}

/* ===== LINKS ===== */
td a{
    text-decoration:none;
}

/* ===== BUTTON BASE ===== */
td a button{
    padding:8px 14px;
    margin:3px;

    border:none;
    border-radius:10px;

    font-size:13px;
    font-weight:700;
    letter-spacing:0.4px;

    cursor:pointer;
    color:#fff8f2;

    transition:0.25s;

    box-shadow:0 6px 14px rgba(90,60,40,0.10);
}

/* ===== EDIT BUTTON ===== */
td a:nth-child(1) button{
    background:linear-gradient(135deg,#b87333,#8b5a2b,#6f4a26);
}

/* ===== LOGOUT BUTTON ===== */
td a:nth-child(2) button{
    background:linear-gradient(135deg,#b87333,#8b5a2b,#6f4a26);
}

/* ===== DELETE BUTTON ===== */
td a:nth-child(3) button{
    background:linear-gradient(135deg,#7a1f1f,#a83232,#5a1010);
    box-shadow:
        0 8px 18px rgba(122,31,31,0.22),
        inset 0 1px 0 rgba(255,255,255,0.12);
}

/* ===== HOVER ===== */
td a button:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 22px rgba(90,60,40,0.18);
    filter:brightness(1.05);
}

/* ===== CLICK ===== */
td a button:active{
    transform:scale(0.97);
}

/* ===== LAST ROW ===== */
table tr:last-child td{
    border-bottom:none;
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
@media(max-width:1100px){

    body{
        padding:20px;
    }

    table{
        display:block;
        overflow-x:auto;
        white-space:nowrap;
    }
}

@media(max-width:700px){

    td a button{
        display:block;
        width:100%;
        margin:5px 0;
    }
}
</style>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <tr>

                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
                    <a href="../lab-system/logout.php?id=<?php echo $row['id']; ?>"><button>Logout</button></a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a>
                </td>
            </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>