<?php
session_start();
include_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

   

    $sql = "SELECT `user_id`, `username`, `password`, `firstname` FROM `user` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($password == $row["password"]) {
            $username = $row["username"];
            $firstname = $row["firstname"];
            $user_id = $row["user_id"];
            
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['firstname'] = $firstname;
            header("Location: home.php");
        } else {
            header("Location: index.php?error=1");
            exit();
        }
    } else {
        header("Location: index.php?error=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <style>
        :root {
            --primary-color: #31679f;
            --secondary-color: #d78dbe;
            --background-gradient: linear-gradient(to bottom right, #3b6991, #d78dbe);
            --white: rgba(255, 255, 255, 0.9);
            --light-gray: #ddd;
            --dark-gray: #5d5d5d;
            --button-hover: #0056b3;
            --modal-overlay: rgba(0, 0, 0, 0.5);
            --setting-bg: #8f8f8f;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--background-gradient);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #525252;
            position: relative;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
            color: var(--dark-gray);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        form {
            background-color: var(--white);
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        input[type="text"],
        input[type="password"] {
            margin-bottom: 15px;
            padding: 12px 20px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.25);
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            width: 100%;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        button:hover {
            background-color: var(--button-hover);
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        button:active {
            transform: scale(0.98);
        }

        .logo {
            position: fixed;
            top: -68px;
            left: -110px;
            width: 400px;
            height: auto;
            z-index: 200;
            transition: transform 0.3s, opacity 0.3s;
        }

        .logo:hover {
            transform: scale(1.05);
            opacity: 1;
        }

        @media (max-width: 600px) {
            .logo {
                width: 300px;
                top: -60px;
                left: -90px;
            }

            form {
                padding: 25px 20px;
            }

            h1 {
                font-size: 24px;
            }

            .setting,
            .view-code-btn {
                padding: 8px 12px;
                font-size: 12px;
            }
        }

        /* สไตล์เพิ่มเติมสำหรับข้อความแสดงข้อผิดพลาด */
        .error-message {
            background-color: rgba(255, 0, 0, 0.1); /* พื้นหลังสีแดงอ่อน */
            color: #d8000c; /* ข้อความสีแดงเข้ม */
            border: 1px solid #d8000c; /* ขอบสีแดงเข้ม */
            padding: 10px 20px; /* ช่องว่างภายใน */
            border-radius: 8px; /* มุมโค้งมน */
            margin-top: 15px; /* ระยะห่างด้านบน */
            text-align: center; /* จัดข้อความให้อยู่กึ่งกลาง */
            font-size: 14px; /* ขนาดตัวอักษร */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* เงาเล็กน้อย */
            animation: fadeIn 0.5s ease-in-out; /* เอฟเฟกต์การปรากฏ */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* คุณสามารถเพิ่มสไตล์เพิ่มเติมที่นี่ตามต้องการ */
    </style>
</head>
<body>
    <!-- โลโก้ -->
    <img src="logo.png" alt="logo" class="logo">

    <form action="" method="post">
        <h1>เข้าสู่ระบบ</h1>
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">เข้าสู่ระบบ</button>
        <?php
            if (isset($_GET["error"])) {
                echo "<div class='error-message'>อีเมลหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่</div>";
            }
        ?>
    </form>
</body>
</html>
