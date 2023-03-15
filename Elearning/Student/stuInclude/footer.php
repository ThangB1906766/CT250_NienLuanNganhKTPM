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

$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stuId = $row["stu_id"];
    $stuName = $row["stu_name"];
    $stuEmail = $row["stu_email"];
}

// Thử nghiệm
$sql = "SELECT * FROM diachi WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $dc_id = $row["dc_id"];
    $dc_hoten = $row["dc_hoten"];
    $dc_sdt = $row["dc_sdt"];
    $dc_sonha = $row["dc_sonha"];
    $dc_thanhpho = $row["dc_thanhpho"];
    $dc_tinh = $row["dc_tinh"];
    $dc_xa = $row["dc_xa"];

}

?>
<div class="modal fade" id="stuAddAdress" tabindex="-1" aria-labelledby="stuAddAdressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stuAddAdressLabel">THÊM ĐỊA CHỈ MỚI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Start student registration modal form -->
                <!-- <?php include('./studentAddAdress.php'); ?> Đang lỗi -->
                <form role="form" id="stuRegForm">
                    <div class="form-group">
                    <input type="email" class="form-control" id="email" value="<?php echo $stuEmail ?>" readonly>

                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg1"></small>
                        <input type="text" class="form-control" placeholder="Họ tên" name="hoten" id="hoten">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg2"></small>
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="sodienthoai" id="sodienthoai">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg3"></small>
                        <input type="text" class="form-control" placeholder="Số nhà" name="sonha" id="sonha" >
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg4"></small>
                        <select class="form-select thanhpho" aria-label="Default select example" id="thanhpho">

                            <option selected>Thành phố</option>
                            <?php
                            include_once('../dbconnection.php');
                            $sql = "SELECT * FROM devvn_tinhthanhpho";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['matp'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg5"></small>
                        <select class="form-select tinh" id="tinh" aria-label="Default select example">
                            <option selected>Quận huyện</option>


                        </select>
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg6"></small>
                        <select class="form-select huyen" id="huyen" aria-label="Default select example">
                            <option selected>Phường xã</option>

                        </select>
                    </div> <br>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Đặt làm địa chỉ mặt định?
                            </label>
                        </div>
                    </div> <br>
                </form>
                <!-- End student registration modal form -->
            </div>
            <div class="modal-footer">
                <span id="successMsg"></span>
                <!-- <small id="statusMsg4"></small> -->
                <button type="button" class="btn btn-primary" onclick="addAddress()" id="themdiachi">Thêm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

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

</body>

</html>