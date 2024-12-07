<?php
session_start(); //เปิดการใข้เซสชั่น คำสั่งบนสุดของทุกอย่าง


error_reporting(E_ALL);
ini_set('display_errors', 1);


$conn = mysqli_connect("localhost","root",      "root",     "surachai"); //สร้างสะพาน
                    //   ที่อยู่เว็บ   , ชื่อผู้ใช้งาน  ,  รหัสผ่าน  , ชื่อฐานข้อมูล

if (mysqli_connect_errno()) { //เช็คว่าการเชื่อมต่อมีปัญหาหรือไม่
    echo "Failed to connect to MySQL: " . mysqli_connect_error(); //ผิดพลาด ให้แสดงความผิดพลาด
}

if (!$conn->set_charset("utf8")) { //ตั้งค่าสะพานเป็นภาษาไทย
    printf("Error loading character set utf8: %s\n", $conn->error); //ตั้งค่าไม่สำเร็จ ให้แสดงความผิดพลาด
} 

date_default_timezone_set("Asia/Bangkok"); //ตั้งค่าเวลาเว็บเป็นเวลาประเทศไทย

$setTimeZone = "SET @@session.time_zone = '+07:00'"; //สร้างคำสั่ง ตั้งเวลาฐานข้อมูลเป็นกรุงเทพ
mysqli_query($conn,$setTimeZone);  //ดำเนินการตั้งค่าฐานข้อมูลเป็นเวลากรุงเทพ







