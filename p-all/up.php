<?php
include '../p-inc/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลที่ต้องการอัปเดต
$sql = "SELECT people_main_id, cid FROM tbl_people_main WHERE people_main_id BETWEEN 1 AND 187";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // เตรียมคำสั่งอัปเดต
    $update_stmt = $conn->prepare("UPDATE tbl_people_main SET password = ? WHERE people_main_id = ?");

    // วนลูปอัปเดตทีละแถว
    while ($row = $result->fetch_assoc()) {
        $people_main_id = $row['people_main_id'];
        $cid = $row['cid'];

        // ดึง 5 ตัวท้ายของ CID
        $last_five = substr($cid, -5);

        // แฮชด้วย password_hash
        $hashed_password = password_hash($last_five, PASSWORD_DEFAULT);

        // อัปเดตฐานข้อมูล
        $update_stmt->bind_param("si", $hashed_password, $people_main_id);
        $update_stmt->execute();
    }
    echo "Password updated successfully.";
    $update_stmt->close();
} else {
    echo "No records found.";
}

$conn->close();
