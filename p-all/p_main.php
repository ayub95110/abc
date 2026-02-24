<?php
$menu = "p_main";
include '../p-inc/connect.php';
include '../p-inc/header.php';
session_start();
?>

<body>
    <section class="content-header">
        <div class="container-fluid">
            <h1>
                <strong>
                    <i class="nav-icon fas fa-home" style="color: green;"></i> : <span style="color: green;">หน้าแรก / Dashboard</span>
                </strong>
            </h1>
            <hr style="border: 1px solid lightgreen;">
        </div>
    </section>

    <?php
    $people_main_id = $_SESSION['people_main_id'];
    $sql_user = "SELECT tbl_people_main.*, tbl_people_type.people_type_name, tbl_hospital_departmen.hospital_departmen_name 
                 FROM tbl_people_main 
                 LEFT JOIN tbl_people_type ON tbl_people_main.people_type_id = tbl_people_type.people_type_id
                 LEFT JOIN tbl_hospital_departmen ON tbl_people_main.hospital_departmen_id = tbl_hospital_departmen.hospital_departmen_id
                 WHERE tbl_people_main.people_main_id = '$people_main_id'";
    $query_user = mysqli_query($conn, $sql_user);
    $user_data = mysqli_fetch_array($query_user);
    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Card -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <i class="fas fa-user-circle fa-5x text-success mb-3"></i>
                            </div>
                            <h3 class="profile-username text-center"><?php echo $user_data['name'] . " " . $user_data['sname']; ?></h3>
                            <p class="text-muted text-center"><?php echo $user_data['people_type_name']; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>กลุ่มงาน</b> <a class="float-right text-success"><?php echo $user_data['hospital_departmen_name']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right"><?php echo $user_data['username']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>ID</b> <a class="float-right"><?php echo str_pad($user_data['people_main_id'], 4, "0", STR_PAD_LEFT); ?></a>
                                </li>
                            </ul>
                            <a href="p_people_me.php" class="btn btn-success btn-block"><b>ดูข้อมูลส่วนตัวเพิ่มเติม</b></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">ยินดีต้อนรับ</h3>
                        </div>
                        <div class="card-body">
                            <h5>สวัสดีคุณ <strong><?php echo $user_data['title'] . $user_data['name'] . " " . $user_data['sname']; ?></strong></h5>
                            <p>ขณะนี้คุณเข้าสู่ระบบในสถานะ: <span class="badge badge-success"><?php echo $user_data['people_type_name']; ?></span></p>
                            <hr>
                            <p>คุณสามารถเลือกโปรแกรมจัดการข้อมูลต่างๆ ได้จากเมนูด้านซ้ายมือ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php include '../p-inc/footer.php'; ?>