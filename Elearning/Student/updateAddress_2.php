<!-- 10/03/2023 Bắt đầu form thêm địa chỉ -->
<?php
// if (!isset($_SESSION)) {
//     session_start();
// }
// define('TITLE', 'Student Profile');
// define('PAGE', 'studentAddress');
// include('./stuInclude/header.php');
include_once("../dbconnection.php"); // Kết nối csdl

// if (isset($_SESSION['is_login'])) {
//     $stuEmail = $_SESSION['stuLogEmail'];
// } else {
//     echo "<script> location.href='../index.php'; </script>";
// }

// $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
// $result = $conn->query($sql);
// if ($result->num_rows == 1) {
//     $row = $result->fetch_assoc();
//     $stuId = $row["stu_id"];
//     $stuName = $row["stu_name"];
//     $stuEmail = $row["stu_email"];
// }

// Thử nghiệm
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
if (isset($_POST['stusignup']) && isset($_POST['hoten']) && isset($_POST['sodienthoai']) && isset($_POST['sonha'])) {
    $hoten = $_POST['hoten'];
    $sodienthoai = $_POST['sodienthoai'];
    $sonha = $_POST['sonha'];
    $thanhpho;
    $tinh;
    $huyen;
    $email =  $_POST['email'];

    $dc_id =  $_POST['dc_id'];

    // Start Thêm địa thành phố tỉnh huyện
    $key_tp = $_POST['thanhpho']; // key = mã thành phố
    $key_tinh = $_POST['tinh'];
    $key_huyen = $_POST['huyen']; 

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
    $sql = "UPDATE diachi SET dc_hoten= '$hoten', dc_sdt= '$sodienthoai', dc_sonha= '$sonha', dc_thanhpho= '$thanhpho', dc_tinh= '$tinh', dc_xa= '$huyen' WHERE dc_id = '$dc_id'";
    
    // Thông báo xóa thành công
    // $check = $conn->query($sql);
    // echo json_encode($check);

     if ($conn->query($sql) === TRUE) {
        echo json_encode("OK");
     } else {
         echo json_encode("Failed");
     }


//     if(isset($_REQUEST['delete'])){ //name="delete" của button
//         $sql = "DELETE FROM diachi WHERE dc_id = {$_REQUEST['id']}"; // "id" name="id" của thẻ input
//     if($conn->query($sql) == TRUE){
//         // echo "Record Deleted Successfully";
//         // refresh the page after deleted
//         echo '
//         <script>
//             alert("Xóa thành công")
//         </script>';
//         echo '<meta http-equiv="refresh" content="0;URL=?updated"/>';
//       } else {
//         echo "Unable to Updata Data";
//       }
//    }

}

?>