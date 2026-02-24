<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect.php';

// ตรวจสอบว่าเซสชันมีค่า 'people_main_id' หรือไม่
if (!isset($_SESSION['people_main_id'])) {
    // หากไม่มีให้เปลี่ยนเส้นทางไปยังหน้า 404 หรือหน้าเข้าสู่ระบบ
    header("Location: ../error_404.php");
    exit(); // หยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
}

$people_main_id = $_SESSION['people_main_id'];
$sql = "SELECT * FROM tbl_people_main WHERE people_main_id = $people_main_id";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($query);
?>

<aside class="main-sidebar sidebar-light-success elevation-4">
    <a href="#" class="brand-link bg-success">
        <img src="../img/sasuk.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kapho Hospital</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../img/images_profile/<?php echo $user['img_yourself']; ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a class="d-block"><?php echo "ชื่อ : " . $user['name'] . " " . $user['sname']; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="p_main.php" class="nav-link <?php if ($menu == "p_main") {
                                                                echo "active";
                                                            } ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>: รวมโปรแกรม</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="p_people_me.php" class="nav-link <?php if ($menu == "p_people_me") {
                                                                    echo "active";
                                                                } ?>">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>: ข้อมูลส่วนตัว</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="p_edit_pass.php" class="nav-link <?php if ($menu == "p_edit_pass") {
                                                                    echo "active";
                                                                } ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>: เปลี่ยนรหัสผ่าน</p>
                    </a>
                </li>
                <?php if (isset($_SESSION['id_level']) && $_SESSION['id_level'] == 1) { ?>
                    <li class="nav-item">
                        <hr>
                        <a href="p_people_all.php" class="nav-link <?php if ($menu == "p_people_all") {
                                                                        echo "active";
                                                                    } ?>">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>: จัดการผู้ใช้งาน</p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="../logout.php" class="nav-link" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?')">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>ออกจากระบบ</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>