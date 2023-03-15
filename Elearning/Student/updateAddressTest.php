<!-- 10/03/2023 Bắt đầu form thêm địa chỉ -->

<?php
if (!isset($_SESSION)) {
    session_start();
}
// define('TITLE', 'Student Profile');
// define('PAGE', 'studentAddress');
// include('./stuInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
// $result = $conn->query($sql);
// if ($result->num_rows == 1) {
//     $row = $result->fetch_assoc();
//     $stuId = $row["stu_id"];
//     $stuName = $row["stu_name"];
//     $stuEmail = $row["stu_email"];
// }

// Thử nghiệm


// if (isset($_GET['dc_id'])) {
//     $dc_id = $_GET['dc_id'];

// }

//     $_SESSION['dc_id'] = $dc_id;

//     $sql = "SELECT * FROM diachi WHERE dc_id = '$dc_id' ";
//     // $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $dc_id = $row["dc_id"];
//         $dc_hoten = $row["dc_hoten"];
//         $dc_sdt = $row["dc_sdt"];
//         $dc_sonha = $row["dc_sonha"];
//         $dc_thanhpho = $row["dc_thanhpho"];
//         $dc_tinh = $row["dc_tinh"];
//         $dc_xa = $row["dc_xa"];
//     }
// }


// $sql = "SELECT * FROM diachi WHERE stu_email='$stuEmail'";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $dc_id = $row["dc_id"];
//     $dc_hoten = $row["dc_hoten"];
//     $dc_sdt = $row["dc_sdt"];
//     $dc_sonha = $row["dc_sonha"];
//     $dc_thanhpho = $row["dc_thanhpho"];
//     $dc_tinh = $row["dc_tinh"];
//     $dc_xa = $row["dc_xa"];
// }

// Tiến hành cập nhật
if (isset($_POST['stusignup']) && isset($_POST['capnhat_hoten']) && isset($_POST['capnhat_sodienthoai']) && isset($_POST['capnhat_sonha'])) {
    $hoten = $_POST['capnhat_hoten'];
    $sodienthoai = $_POST['capnhat_sodienthoai'];

    $sonha = $_POST['capnhat_sonha'];

    $thanhpho;
    $tinh;
    $huyen;
    $email =  $_POST['capnhat_email'];

    // Start Thêm địa thành phố tỉnh huyện
    $key_tp = $_POST['capnhat_thanhpho']; // key = mã thành phố
    $key_tinh = $_POST['capnhat_tinh'];
    $key_huyen = $_POST['capnhat_huyen'];

    // Lấy tên của thành phố dựa vào id bên ajaxrequest gửi qua
    $sql_jone = "SELECT tpho.name as tp_ten, tinh.name as tinh_ten, huyen.name as huyen_ten, tpho.matp as id_tp, tinh.maqh as id_tinh, huyen.xaid as id_huyen
    FROM devvn_tinhthanhpho tpho
    JOIN devvn_quanhuyen tinh
       ON tpho.matp = tinh.matp
    JOIN devvn_xaphuongthitran huyen 
       ON tinh.maqh = huyen.maqh
                 WHERE  tpho.matp = '$key_tp' AND tinh.maqh = '$key_tinh' AND huyen.xaid = '$key_huyen'";
    $result = $conn->query($sql_jone);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $thanhpho = $row['tp_ten'];
            $tinh = $row['tinh_ten'];
            $huyen = $row['huyen_ten'];
        }
    }

    // Cập nhật sql
    $sql = "UPDATE diachi 
            SET dc_hoten= '$hoten', dc_sdt= '$sodienthoai', dc_sonha= '$sonha', dc_thanhpho= '$thanhpho', dc_tinh= '$tinh', dc_xa= '$huyen'
            WHERE stu_email = '$email'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode("OK");
    } else {
        echo json_encode("Failed");
    }
}
?>

<div class="form-group">

    <?php
    if (isset($_GET['dc_id'])) {
        $dc_id = $_GET['dc_id'];

        $_SESSION['dc_id'] = $dc_id;

        $sql = "SELECT * FROM diachi WHERE dc_id = '$dc_id' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <input type="text" class="form-control" id="capnhat_diachi" value="<?php echo $row['dc_id'] ?>" readonly>

</div> <br>

<!-- Kết thúc đầu form thêm địa chỉ -->


<!-- Jquery and Boostrap JavaScript -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<!-- Font Awesome JS -->
<script type="text/javascript" src="../js/all.min.js"></script>

<!-- Admin Ajax Call JavaScript -->
<script type="text/javascript" src="../js/adminajaxrequest.js"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="../js/custom.js"></script>

<script type="text/javascript" src="/Student/ajaxAddress.js"></script>

<script type="text/javascript" src="/js/ajaxrequest.js"></script>
<script type="text/javascript" src="/Student/ajaxUpdateAddress.js"></script>


</body>

</html>