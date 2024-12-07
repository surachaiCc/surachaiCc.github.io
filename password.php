<?php
include_once "connect.php";
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาข้อมูลผู้ใช้</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            text-align: center;
            padding: 20px;
        }

        .logo {
            position: absolute;
            top: -89px;
            left: -115px;
            width: 400px;
            height: auto;
            z-index: 200;
            transition: transform 0.3s, opacity 0.3s;
        }

        .logo:hover {
            transform: scale(1.05);
            opacity: 1;
        }

        .container {
            background-color: var(--white);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
            color: var(--dark-gray);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: var(--white);
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 20px;
            margin-bottom: 20px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.25);
        }

        button,
        .button {
            background-color: var(--primary-color);
            color: #fff;
            padding: 12px 20px;
            width: 100%;
            border: none;
            border-radius: 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        button:hover,
        .button:hover {
            background-color: var(--button-hover);
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        button:active,
        .button:active {
            transform: scale(0.98);
        }

        .back-button {
            background-color: var(--secondary-color);
            margin-top: 20px;
            border-radius: 32px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .back-button:hover {
            background-color: #c26aa0;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .result {
            margin-top: 30px;
            background-color: var(--secondary-color);
            color: #fff;
            padding: 20px;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            word-break: break-word;
            width: 100%;
            font-size: 16px;
        }

        .no-result {
            margin-top: 30px;
            color: var(--dark-gray);
            font-size: 18px;
        }

        @media (max-width: 600px) {
            .logo {
                width: 300px;
                top: -60px;
                left: -90px;
            }

            .container {
                padding: 30px;
            }

            h1 {
                font-size: 24px;
            }

            form {
                padding: 25px 20px;
            }

            button,
            .button {
                font-size: 16px;
                padding: 10px 15px;
            }

            .result {
                font-size: 16px;
            }

            .back-button {
                padding: 8px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <img src="logo.png" alt="logo" class="logo">
    <div class="container">
        <h1>ค้นหาข้อมูลผู้ใช้</h1>

        <form action="" method="GET">
            <input type="text" name="text" placeholder="กรอกชื่อ" required>
            <button type="submit">ค้นหาชื่อ</button>
        </form>

        <?php
            if (isset($_GET['text'])) {
                $firstname = mysqli_real_escape_string($conn, $_GET['text']); // ป้องกัน SQL Injection

                // ใช้ prepared statement
                $sql = "SELECT `user_id`, `username`, `password`, `firstname` 
                        FROM `user` 
                        WHERE `firstname` = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 's', $firstname); // 's' สำหรับประเภทข้อมูล string
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // ตรวจสอบผลลัพธ์
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $username = htmlspecialchars($row["username"]); // แสดงชื่อผู้ใช้
                    $password = htmlspecialchars($row["password"]); // แสดงรหัสผ่าน

                    echo "<div class='result'>user = $username <br> password = $password</div>";
                } else {
                    echo "<div class='no-result'>ไม่พบข้อมูลที่ตรงกับชื่อที่ค้นหา</div>";
                }
            }
        ?>

        <a href="home.php" class="button back-button">ย้อนกลับ</a>
    </div>
</body>

</html>
