<?php
session_start();
include '../p-inc/connect.php';

// ตรวจสอบสิทธิ์ admin (id_level = 1)
if (!isset($_SESSION['id_level']) || $_SESSION['id_level'] != 1) {
    echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location.href='p_main.php';</script>";
    exit();
}

if (isset($_GET['people_main_id']) && is_numeric($_GET['people_main_id'])) {
    $people_main_id = intval($_GET['people_main_id']);

    // รีเซตสถานะกลับเป็น 1 (ปฏิบัติงาน)
    $sql = "UPDATE tbl_people_main SET people_type_id = '1' WHERE people_main_id = $people_main_id";

    if (mysqli_query($conn, $sql)) {
        echo "<!DOCTYPE html><html>";
        include '../p-inc/header-login.php'; // For SweetAlert Styles
        echo "<body>";
        echo "<script src='../assets/plugins/jquery/jquery.min.js'></script>"; // Ensure jQuery for swal
        echo "<script>";
        echo "setTimeout(function() {
                swal({
                    title: 'รีเซตสถานะสำเร็จ',
                    text: 'รหัสบุคลากร $people_main_id ถูกรีเซตกลับเป็นสถานะปฏิบัติงานแล้ว',
                    type: 'success',
                    confirmButtonText: 'ตกลง'
                }, function() {
                    window.location.href = 'p_people_all.php';
                });
            }, 100);";
        echo "</script></body></html>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "'); window.location.href='p_people_all.php';</script>";
    }
} else {
    header("Location: p_people_all.php");
}
$conn->close();
