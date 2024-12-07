<?php
include_once "connect.php";
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติ</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b6991;
            --secondary-color: #d78dbe;
            --background-gradient: linear-gradient(to bottom right, var(--primary-color), var(--secondary-color));
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
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #525252;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 32px;
            font-weight: 600;
            color: #5d5d5d;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .container {
            background-color: var(--white);
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 800px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-item {
            margin-bottom: 15px;
            font-size: 18px;
            color: #525252;
            line-height: 1.6;
        }

        .back-btn {
            margin: 20px 0;
            background-color: #31679f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .back-btn:hover {
            background-color: var(--button-hover);
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .back-btn:active {
            transform: scale(0.98);
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 24px;
            }

            .container {
                padding: 20px;
            }

            .back-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <h1>ประวัติ</h1>

    <div class="container">
        <div class="profile-item"><strong>ชื่อ:</strong> [ระบุชื่อที่นี่]</div>
        <div class="profile-item"><strong>อายุ:</strong> [ระบุอายุที่นี่]</div>
        <div class="profile-item"><strong>อีเมล:</strong> [ระบุอีเมลที่นี่]</div>
        <div class="profile-item"><strong>ประวัติเพิ่มเติม:</strong> [ระบุข้อมูลเพิ่มเติม]</div>
    </div>

    <button class="back-btn" onclick="goBack()">ย้อนกลับ</button>

    <script>
        function goBack() {
            window.location = "home.php";
        }
    </script>

</body>

</html>
