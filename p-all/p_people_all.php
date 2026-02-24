<?php
session_start();
// ตรวจสอบสิทธิ์ admin (id_level = 1)
if (!isset($_SESSION['id_level']) || $_SESSION['id_level'] != 1) {
    echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location.href='p_main.php';</script>";
    exit();
}
$menu = "p_people_all";
include '../p-inc/connect.php';
include '../p-inc/header.php';
// ดึง people_main_id จาก session
$people_main_id = $_SESSION['people_main_id'];

// Initialize where clause
$whereClause = "";

// Check for filter2 parameter
if (isset($_GET['filter2'])) {
    $filter2 = $_GET['filter2'];
    $typeConditions = [
        'working' => "AND tbl_people_main.people_type_id = '1'",
        'resigned' => "AND tbl_people_main.people_type_id = '2'"
    ];
    if (isset($typeConditions[$filter2])) {
        $whereClause .= " " . $typeConditions[$filter2];
    }
}

// Check for filter3 parameter
if (isset($_GET['filter3']) && $_GET['filter3'] != '') {
    $filter3 = $_GET['filter3'];
    $whereClause .= " AND tbl_people_main.hospital_departmen_id = '$filter3'";
}

// Check for filter4 parameter
if (isset($_GET['filter4']) && $_GET['filter4'] != '') {
    $filter4 = $_GET['filter4'];
    $whereClause .= " AND tbl_people_main.karatchakan_id = '$filter4'";
}

// Query ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT  tbl_people_main.* ,
                    tbl_hospital_departmen.*,
                    tbl_people_type.*,
                    tbl_people_sex.*,
                    tbl_id_level.*
                FROM tbl_people_main 
                LEFT JOIN tbl_hospital_departmen ON tbl_people_main.hospital_departmen_id = tbl_hospital_departmen.hospital_departmen_id
                LEFT JOIN tbl_people_type ON tbl_people_main.people_type_id = tbl_people_type.people_type_id
                LEFT JOIN tbl_people_sex ON tbl_people_main.sex = tbl_people_sex.sex
                LEFT JOIN tbl_id_level ON tbl_people_main.id_level = tbl_id_level.id_level
            WHERE 1=1 $whereClause
            ORDER BY people_main_id";
$query = mysqli_query($conn, $sql);
if (!$query) {
    echo "<div class='alert alert-danger'>SQL Error: " . mysqli_error($conn) . "</div>";
}
?>

<body>
    <section class="content-header">
        <div class="container-fluid">
            <h1><i class="fa fa-users" aria-hidden="true"></i> : ข้อมูลบุคลากร
                <?php
                if (isset($_GET['filter2']) && $_GET['filter2'] != '') {
                    if ($_GET['filter2'] == 'working') {
                        echo '<span style="color: green; font-size: 14px;"> : ปฏิบัติงาน</span>';
                    } else {
                        echo '<span style="color: red; font-size: 14px;"> : ไม่ปฏิบัติงาน</span>';
                    }
                } else {
                    echo '<span style="color: blue; font-size: 14px;"> : ทั้งหมด</span>';
                }
                ?>
            </h1>
            <hr>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title"><i class="nav-icon fas fa-list-alt"></i> ทั้งหมด</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- ผู้ใช้ทั้งหมด -->
                    <?php
                    $sql_type = "SELECT COUNT(*) AS count FROM tbl_people_main";
                    $query_type = mysqli_query($conn, $sql_type);
                    $result_type = mysqli_fetch_array($query_type);
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" style="padding: 5px;">
                        <form method="GET" action="p_people_all.php" style="display: inline-block; width: 100%;">
                            <input type="hidden" name="filter2" value="">
                            <button type="submit" class="small-box card-header bg-primary"
                                style="display:block; padding: 10px; text-decoration: none; border: none; width: 100%;">
                                <h6><span><i class="fa fa-address-book" aria-hidden="true"></i> ผู้ใช้ทั้งหมด :
                                        <?php echo $result_type['count']; ?></span></h6>
                            </button>
                        </form>
                    </div>
                    <!-- ผู้ใช้ที่ปฏิบัติงาน -->
                    <?php
                    $sql_type = "SELECT COUNT(*) AS count FROM tbl_people_main WHERE people_type_id = '1'";
                    $query_type = mysqli_query($conn, $sql_type);
                    $result_type = mysqli_fetch_array($query_type);
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" style="padding: 5px;">
                        <form method="GET" action="p_people_all.php" style="display: inline-block; width: 100%;">
                            <input type="hidden" name="filter2" value="working">
                            <button type="submit" class="small-box card-header bg-success"
                                style="display:block; padding: 10px; text-decoration: none; border: none; width: 100%;">
                                <h6><span><i class="fa fa-check" aria-hidden="true"></i> ผู้ใช้ที่ปฏิบัติงาน :
                                        <?php echo $result_type['count']; ?></span></h6>
                            </button>
                        </form>
                    </div>
                    <!-- ผู้ใช้ที่ไม่ปฏิบัติงาน -->
                    <?php
                    $sql_type = "SELECT COUNT(*) AS count FROM tbl_people_main WHERE people_type_id = '2'";
                    $query_type = mysqli_query($conn, $sql_type);
                    $result_type = mysqli_fetch_array($query_type);
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" style="padding: 5px;">
                        <form method="GET" action="p_people_all.php" style="display: inline-block; width: 100%;">
                            <input type="hidden" name="filter2" value="resigned">
                            <button type="submit" class="small-box card-header bg-danger"
                                style="display:block; padding: 10px; text-decoration: none; border: none; width: 100%;">
                                <h6><span><i class="fa fa-times" aria-hidden="true"></i> ผู้ใช้ที่ไม่ปฏิบัติงาน :
                                        <?php echo $result_type['count']; ?></span></h6>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <!-- กลุ่มงาน -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding: 5px;">
                        <form method="GET" action="p_people_all.php" style="display: inline-block; width: 100%;">
                            <input type="hidden" name="filter2"
                                value="<?php echo isset($_GET['filter2']) ? $_GET['filter2'] : ''; ?>">
                            <select name="filter3" class="form-control select2" onchange="this.form.submit()">
                                <option value="">กลุ่มงานเจ้าหน้าที่</option>
                                <?php
                                $sql_departments = "SELECT hospital_departmen_id, hospital_departmen_name FROM tbl_hospital_departmen";
                                $query_departments = mysqli_query($conn, $sql_departments);
                                while ($department = mysqli_fetch_array($query_departments)) {
                                    $department_id = $department['hospital_departmen_id'];
                                    $department_name = $department['hospital_departmen_name'];
                                    $filter2Condition = isset($_GET['filter2']) && $_GET['filter2'] != '' ? "AND people_type_id = '" . ($_GET['filter2'] == 'working' ? '1' : '2') . "'" : "";
                                    $sql_count = "SELECT COUNT(*) AS count FROM tbl_people_main WHERE hospital_departmen_id = '$department_id' $filter2Condition";
                                    $query_count = mysqli_query($conn, $sql_count);
                                    $result_count = mysqli_fetch_array($query_count);
                                    $selected = isset($_GET['filter3']) && $_GET['filter3'] == $department_id ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $department_id; ?>" <?php echo $selected; ?>>
                                        <?php echo $department_name . " : " . $result_count['count']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <a href="p_add_people.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> เพิ่มข้อมูลบุคลากร
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>จัดการ</th>
                                <th>ID</th>
                                <th>รหัสประจำตัว</th>
                                <th>ชื่อ-สกุล</th>
                                <th>กลุ่มงาน</th>
                                <th>สถานะการทำงาน</th>
                                <th>ประเภทเจ้าหน้าที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php while ($result = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <a href="p_edit_people.php?people_main_id=<?php echo $result['people_main_id']; ?>&from=admin" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> แก้ไข
                                        </a>
                                        <a href="#" class="btn btn-info btn-sm" onclick="resetStatus(<?php echo $result['people_main_id']; ?>, '<?php echo $result['name'] . ' ' . $result['sname']; ?>')">
                                            <i class="fas fa-sync"></i> รีเซตสถานะ
                                        </a>
                                    </td>
                                    <td><?php echo str_pad($result["people_main_id"], 4, "0", STR_PAD_LEFT); ?></td>
                                    <td><?php echo $result["cid"]; ?></td>
                                    <td><?php echo $result["name"] . " " . $result["sname"]; ?></td>
                                    <td><?php echo $result["hospital_departmen_name"]; ?></td>
                                    <td><?php echo $result["people_type_name"]; ?></td>
                                    <td><?php echo $result["level"]; ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        function resetStatus(id, name) {
            swal({
                title: "ยืนยันการรีเซตสถานะ?",
                text: "คุณต้องการรีเซตสถานะของ " + name + " กลับเป็น 'ปฏิบัติงาน' ใช่หรือไม่?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#17a2b8",
                confirmButtonText: "ใช่, รีเซตเลย!",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: false
            }, function() {
                window.location.href = "mg_reset_status.php?people_main_id=" + id;
            });
        }
    </script>
    <?php include '../p-inc/footer.php'; ?>
</body>
<?php
$conn->close();
?>