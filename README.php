# GF
<?php
include '../SV/conn.php';

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: Login.php');
    exit;
}

$username = $_SESSION['username']; // ใช้ข้อมูลจาก Session

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql_account = "SELECT id, user, pass, admint, Merchant FROM user WHERE user = '$username'";
$result = $conn->query($sql_account);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้ใช้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            background-color: #5e4734;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fff;
        }

        .sidebar a:hover {
            background-color: #e0dfa7;
            color: #16121f;
        }

        .main-content {
            margin-left: 250px;
        }

        .navbar {
            background-color: #ff7300;
        }

        .navbar a {
            color: #fff !important;
        }

        .image-container img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin: 20px auto;
            display: block;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    
    <h2 style="text-align: center;">ข้อมูลผู้ใช้</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Admin</th>
            <th>Merchant</th>
        </tr>

        <?php
        // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
        if ($result->num_rows > 0) {
            // วนลูปเพื่อแสดงข้อมูลแต่ละแถว
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['user'] . "</td>";
                echo "<td>" . $row['pass'] . "</td>";
                echo "<td>" . $row['admint'] . "</td>";
                echo "<td>" . $row['Merchant'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>ไม่มีข้อมูลในฐานข้อมูล</td></tr>";
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn->close();
        ?>
    </table>
    <a href="Logout.php">
        <button>LOGOUT</button>
    </a>
    <a href="Merchant_account.php">
        <button>สมัครสมาชิกร้านค้า</button>
    </a>
</body>
</html>
