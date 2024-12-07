<?php
include_once "connect.php";
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แทนที่โค้ด</title>
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

        .circle-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: #dbdbdb;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            z-index: 1000;
        }

        .circle-btn:hover {
            background-color: var(--primary-color);
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .circle-btn:active {
            transform: scale(0.9);
        }

        .top-right-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1001;
        }

        .setting,
        .view-code-btn {
            background-color: var(--setting-bg);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 32px;
            font-size: 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .setting:hover,
        .view-code-btn:hover {
            background-color: var(--primary-color);
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .setting:active,
        .view-code-btn:active {
            transform: scale(0.98);
        }

        .setting img {
            width: 20px;
            height: 20px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: var(--modal-overlay);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px 25px;
            border-radius: 12px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            position: relative;
            text-align: center;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: var(--dark-gray);
            cursor: pointer;
            transition: color 0.3s;
        }

        .close:hover {
            color: red;
        }

        /* Additional form styles */
        #addUserForm input {
            width: 90%;
            margin: 10px auto;
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        #addUserForm input:focus {
            border-color: #28a745;
            outline: none;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        #addUserForm button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            width: 90%;
            margin: 10px auto;
            display: block;
            box-sizing: border-box;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        #addUserForm button:hover {
            background-color: var(--button-hover);
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #addUserForm button:active {
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
    </style>
</head>

<body>

    <!-- ฟอร์มหลัก -->
    <form action="index.php" method="GET">
        <h1>กรอกข้อมูล</h1>
        <input type="text" name="input1" placeholder="กรอกข้อความที่นี่" required>
        <input type="text" name="input2" placeholder="กรอกข้อความที่นี่" required>
        <input type="text" name="input3" placeholder="กรอกข้อความที่นี่" required>
        <input type="text" name="input4" placeholder="กรอกข้อความที่นี่" required>
        <input type="text" name="input5" placeholder="กรอกข้อความที่นี่" required>
        <input type="text" name="input6" placeholder="กรอกข้อความที่นี่" required>
        <input type="text" name="input7" placeholder="กรอกข้อความที่นี่" required>
        <button type="submit">กดเลย</button>
    </form>

    <!-- ปุ่มประวัติ -->
    <button class="circle-btn" onclick="go()">ประวัติ</button>

    <!-- คอนเทนเนอร์สำหรับปุ่มด้านบนขวา -->
    <div class="top-right-buttons">
        <button class="setting" id="settingBtn">
            <img src="setting.png" alt="Settings">
        </button>
        <button class="view-code-btn" id="viewCodeBtn">ดูรหัส</button>
    </div>

    <!-- Modal สำหรับเพิ่มผู้ใช้ -->
    <div id="settingModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>เพิ่มผู้ใช้</h2>
            <form id="addUserForm" action="signup.php" method="POST">
                <input type="text" id="username" name="username" placeholder="username" required>
                <input type="password" id="password" name="password" placeholder="password" required>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="confirmpassword" required>
                <input type="text" id="firstname" name="firstname" placeholder="firstname" required>
                <button type="submit">เพิ่มผู้ใช้</button>
            </form>
        </div>
    </div>

    <!-- โลโก้ -->
    <img src="logo.png" alt="logo" class="logo">

    <script>
        // การจัดการ Modal
        const settingBtn = document.getElementById("settingBtn");
        const settingModal = document.getElementById("settingModal");
        const closeModal = document.getElementById("closeModal");

        settingBtn.addEventListener("click", () => {
            settingModal.style.display = "flex";
        });

        closeModal.addEventListener("click", () => {
            settingModal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === settingModal) {
                settingModal.style.display = "none";
            }
        });

        // ฟังก์ชันสำหรับปุ่ม "ประวัติ"
        function go() {
            window.location = "record.php";
        }

        // ฟังก์ชันสำหรับปุ่ม "ดูรหัส"
        document.getElementById("viewCodeBtn").addEventListener("click", () => {
            window.location = "password.php"; // เปลี่ยนเป็นลิงก์ที่คุณต้องการ
        });

        // การตรวจสอบรหัสผ่านในฟอร์มเพิ่มผู้ใช้
        document.getElementById("addUserForm").addEventListener("submit", function (event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                event.preventDefault(); // ป้องกันการส่งฟอร์ม
                alert("รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่");
            }
        });
    </script>

</body>

</html>
