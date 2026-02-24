<?php
$menu = "p_people_me";
include '../p-inc/connect.php';
include '../p-inc/header.php';
session_start();
$people_main_id = $_SESSION['people_main_id'];
?>

<body>
    <section class="content-header">
        <div class="container-fluid">
            <h1>
                <strong>
                    <i class="nav-icon fas fa-user" style="color: green;"></i> : <span style="color: green;">ข้อมูลส่วนตัว</span>
                </strong>
                <a href="p_edit_people.php?people_main_id=<?php echo $people_main_id; ?>" class="btn btn-success btn-sm float-right">
                    <i class="fas fa-edit"></i> แก้ไขข้อมูล
                </a>
            </h1>
            <hr style="border: 1px solid lightgreen;">
        </div>
    </section>
    <?php
    $sql = "SELECT * FROM tbl_people_main 
                    LEFT JOIN tbl_hospital_departmen ON tbl_people_main.hospital_departmen_id = tbl_hospital_departmen.hospital_departmen_id
                    LEFT JOIN tbl_people_type ON tbl_people_main.people_type_id = tbl_people_type.people_type_id
                    LEFT JOIN tbl_people_sex ON tbl_people_main.sex = tbl_people_sex.sex
                    LEFT JOIN tbl_id_level ON tbl_people_main.id_level = tbl_id_level.id_level
    WHERE people_main_id = $people_main_id";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($query);
    ?>
    <section class="content">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title"> <i class="nav-icon fas fa-list-alt"></i> : รายละเอียด </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="username">Username:</label>
                        <input type="text" id="username" value="<?php echo $user['username'] ?>" readonly
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="cid">รหัสประจำตัว 13 หลัก:</label>
                        <input type="text" id="cid" value="<?php echo $user['cid'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>อีเมลล์:</label>
                        <input type="text" id="email" value="<?php echo $user['email'] ?>" readonly class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>คำนำหน้า:</label>
                        <input type="text" id="title" value="<?php echo $user['title'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>ชื่อ:</label>
                        <input type="text" id="name" value="<?php echo $user['name'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>นามสกุล:</label>
                        <input type="text" id="sname" value="<?php echo $user['sname'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>เพศ:</label>
                        <input type="text" id="sex" value="<?php echo $user['sex_name'] ?>" readonly
                            class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>เบอร์โทร:</label>
                        <input type="text" id="phone" value="<?php echo $user['phone'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>วันเดือนปีเกิด:</label>
                        <input type="text" id="birthday" value="<?php echo $user['birthday'] ?>" readonly
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>อายุ:</label>
                        <input type="text" id="age" readonly class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>สถานะการทำงาน:</label>
                        <input type="text" id="people_type_name" value="<?php echo $user['people_type_name'] ?>" readonly
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>กลุ่มงาน:</label>
                        <input type="text" id="hospital_departmen_name"
                            value="<?php echo $user['hospital_departmen_name'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>ประเภทเจ้าหน้าที่:</label>
                        <input type="text" id="level" value="<?php echo $user['level'] ?>" readonly
                            class="form-control">
                    </div>
                </div>
            </div>
            <script>
                // ฟังก์ชันสำหรับคำนวณอายุโดยแบ่งเป็นปี เดือน วัน
                function calculateAge(birthday) {
                    const birthDate = new Date(birthday);
                    const today = new Date();
                    // คำนวณความแตกต่างในปี
                    let ageYears = today.getFullYear() - birthDate.getFullYear();
                    // คำนวณความแตกต่างในเดือน
                    let ageMonths = today.getMonth() - birthDate.getMonth();
                    if (ageMonths < 0) {
                        ageYears--; // ถ้าเดือนยังไม่ถึงเดือนเกิด ให้ลบ 1 ปี
                        ageMonths += 12; // ปรับให้เดือนเป็นค่าบวกโดยบวก 12 เดือน
                    }
                    // คำนวณความแตกต่างในวัน
                    let ageDays = today.getDate() - birthDate.getDate();
                    if (ageDays < 0) {
                        ageMonths--; // ถ้าวันยังไม่ถึงวันเกิด ให้ลบ 1 เดือน
                        const lastMonth = new Date(today.getFullYear(), today.getMonth(),
                            0); // วันที่สุดท้ายของเดือนที่แล้ว
                        ageDays += lastMonth.getDate(); // บวกจำนวนวันของเดือนที่แล้ว
                    }
                    return `${ageYears} ปี ${ageMonths} เดือน ${ageDays} วัน`;
                }
                // ดึงวันเกิดจากค่า PHP และคำนวณอายุ
                const birthday = "<?php echo $user['birthday']; ?>";
                document.getElementById('age').value = calculateAge(birthday);
            </script>
        </div>
    </section>
    <br>
    <?php include '../p-inc/footer.php'; ?>

    <script>
        $(function() {
            $(".datatable").DataTable();
        });
    </script>
</body>

</html>