/* 
    Ngày 14/01/2023
    Hàm addStu() chức năng thêm một student vào csdl khi chọn signup (tên, emaim, mật khẩu)
    1. addStu() gán sự kiện onlick ở nút submit form đăng ký
    2. Tạo addStu() ở ajaxrequest.js
        - Lấy giá trị từ 3 trường trong form từ #id
            + stuname. stuemail, stupass
        - Tạo  $.ajax() để đẩy dữ liệu qua addstudent.php để xử lý
        - Kiểm tra các ràng buộc như rỗng, nhập đúng định dạng email
        - Khi đăng ký thành công hiển thị thông báo
    3. Hàm clearStuRegField() để reset các trường khi đăng ký thành công
    4. (document).ready(function() xử lý kiểm tra email đã tồn tại hay chưa
    5. function checkStuLogin() 

*/

$(document).ready(function(){
    // Ajax call form already exists email verification
    $("#stuemail").on("keypress blur", function(){
        var reg = /^[A-Z0-9._/%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var stuemail = $("#stuemail").val();
        $.ajax({
             url: '/Student/addstudent.php', 
             method: "POST",
             data:{
                checkemail: "checkmail",
                stuemail: stuemail,
             },
             success:function(data){
                console.log(data);
                if(data != 0){
                     $("#statusMsg2").html('<small style="color:red;"> Email ID Already Used !</small>');
                     $("#signup").attr("disabled", true);
                }else if(data == 0 && reg.test(stuemail)){
                    $("#statusMsg2").html('<small style="color:green;"> There You Go !</small>');
                    $("#signup").attr("disabled", false);
                }else if(!reg.test(stuemail)){
                    $("#statusMsg2").html('<small style="color:red;"> Please Enter valid Email e.g example@gmail.com !</small>');
                    $("#stuemail").focus();
                    $("#signup").attr("disabled", false);
                }
            }
        });
    });
});

function addStu(){
    var reg = /^[A-Z0-9._/%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var stuname = $("#stuname").val();
    var stuemail = $("#stuemail").val();
    var stupass = $("#stupass").val();
    // console.log(stuname);
    // console.log(stuemail);
    // console.log(stupass);

    // Checking form Failed on form submitssion
    if(stuname.trim() == ""){
        $("#statusMsg1").html('<small style="color:red;"> Please Enter Name !</small>');
        $("#stuname").focus();
        return false;
    } else if (stuemail.trim() == ""){
        $("#statusMsg2").html('<small style="color:red;"> Please Enter Email !</small>');
        $("#stuemail").focus();
        return false; 
    }else if (stuemail.trim() != "" && !reg.test(stuemail)){
        $("#statusMsg2").html('<small style="color:red;"> Please Enter valid Email e.g example@gmail.com !</small>');
        $("#stuemail").focus();
        return false; 
    }else if (stupass.trim() == ""){
        $("#statusMsg3").html('<small style="color:red;"> Please Enter Password !</small>');
        $("#stupass").focus();
        return false; 
    } else {
    /*
     Hàm $.ajax() của JQuery được sử dụng để thực hiện các request HTTP bất đồng bộ (async).
     - url: là một chuỗi chứa URL mà bạn muốn sử dụng AJAX để thực hiện request, trong khi đó tham số options là một object thuần chứa các thiết lập cho request AJAX đó.
     - dataType: là dạng dữ liệu trả về. (text, json, script, xml,html,jsonp )
     - data: không bắt buộc ,là một đối tượng object gồm các key : value sẽ gửi lên server
    */
    $.ajax({
        url:'/Student/addstudent.php', 
        method: "POST",
        dataType: "json",
        data:{
            stusignup: "stusignup", // Gui thong bao dang ky qua addstudent
            stuname: stuname,
            stuemail: stuemail,
            stupass: stupass,
        },
        success:function(data){    
            console.log(data)
            if(data == "OK"){
                $('#successMsg').html("<span class='alert alert-success'> Registration uccessful !</span>")
                clearStuRegField();
            }else if(data == "Failed"){
                  $('#successMsg').html("<span class='alert alert-bg-danger'> Unable to Register !</span>")
            }
        }
    });
    }
}

// Empty all Failed
function clearStuRegField(){
    $("#stuRegForm").trigger("reset");
    $("#statusMsg1").html(" ");
    $("#statusMsg2").html(" ");
    $("#statusMsg3").html(" ");

}

// Ajax call for student login verification
/*
    Sự kiện onclick="checkStuLogin()" ở footer.php
    Lấy thông tin từ form login gửi dữ liệu qua addstudent.php để kiểm tra đăng nhập
*/
function checkStuLogin(){
    // console.log("Login Clicked!!")
    var stuLogEmail = $("#stuLogemail").val();
    var stuLogpass = $("#stuLogpass").val();
    $.ajax({
        url: '/Student/addstudent.php', 
        method: "POST",
        data:{
            checkLogEmail: "checkLogEmail",
            stuLogEmail: stuLogEmail,
            stuLogpass: stuLogpass,
        },
        success:function(data){
            // console.log(data);
            if(data == 0){
                $("#statusLogMsg").html('<small class="alert alert-danger"> Invalid Email or Password !</small>'); 
            }else if(data == 1){
                $("#statusLogMsg").html('<div class="spinner-border text-success role="status"></div>');
                setTimeout(()=>{
                    window.location.href = "index.php";
                }, 1000 );
            }
        }
    });
}

function addAddress(){
    var hoten = $("#hoten").val();
    var sodienthoai = $("#sodienthoai").val();
    var sonha = $("#sonha").val();
    var thanhpho = document.getElementById("thanhpho").value;
    var tinh = document.getElementById("tinh").value;
    var huyen = document.getElementById("huyen").value;
    var email = document.getElementById("email").value;


    console.log(hoten);
    console.log(sodienthoai);
    console.log(sonha);
    console.log(thanhpho);
    console.log(tinh);
    console.log(huyen);
    console.log(email);

    var reg = /^[0-9]/;

    if(hoten.trim() == ""){
        $("#statusMsg1").html('<small style="color:red;"> Vui lòng điền họ tên! </small>');
        $("#hoten").focus();
        return false;
    } else if (sodienthoai.trim() == ""){
        $("#statusMsg2").html('<small style="color:red;"> Vui lòng điền số điện thoại! </small>');
        $("#sodienthoai").focus();
        return false; 
    }
    else if (!reg.test(sodienthoai)){
        $("#statusMsg2").html('<small style="color:red;"> Vui lòng điền đúng điện thoại! </small>');
        $("#sodienthoai").focus();
        return false;
    }else if (sonha.trim() == ""){
        $("#statusMsg3").html('<small style="color:red;"> Vui lòng điền số nhà! </small>');
        $("#sonha").focus();
        return false; 
    }else if (thanhpho == "Thành phố"){
        $("#statusMsg4").html('<small style="color:red;"> Vui lòng chọn thành phố </small>'); 
        $("#thanhpho").focus();
    }else if (tinh == "Quận huyện"){
        $("#statusMsg5").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
        $("#tinh").focus(); 
    }else if (huyen == "Phường xã"){
        $("#statusMsg6").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
        $("#huyen").focus(); 
    }
    else{
        $.ajax({
            url:'../Student/addAddress.php', 
            method: "POST",
            dataType: "json",
            data:{
                stusignup: "stusignup", // Gui thong bao dang ky qua addstudent
                hoten: hoten,
                sodienthoai: sodienthoai,
                sonha: sonha,
                thanhpho: thanhpho,
                tinh: tinh,
                huyen: huyen,
                email: email,
            }, success:function(data){    
                console.log(data) // in OK || Failed
                if(data == "Failed"){
                    $('#successMsg').html("<span class='alert alert-bg-danger'> Thêm địa chỉ thất bại!</span>")
                }else if(data == "OK"){


                    var result = confirm("Bạn có muốn thêm địa chỉ mới");
                    if (result == true) {
                        alert("Thêm thành công");
                        setTimeout(()=>{
                            window.location.href = "/Student/studentAddress.php";
                            }, 300 );
                        
                    } else {
                        alert("Không thêm");
                    }    

                    $('#successMsg').html("<span class='alert alert-success'> Thêm địa chỉ thành công!</span>")
                    clearStuRegField();
                    // setTimeout(()=>{
                    //     window.location.href = "/Student/studentAddress.php";
                    // }, 800 );
                }
            }
        });
        }
}


// function updateAddress(){

//     var capnhat_hoten = $("#capnhat_hoten").val();
//     var capnhat_sodienthoai = $("#capnhat_sodienthoai").val();
    
//     var capnhat_sonha = $("#capnhat_sonha").val();

//     var capnhat_thanhpho = document.getElementById("capnhat_thanhpho").value;
//     var capnhat_tinh = document.getElementById("capnhat_tinh").value;
//     var capnhat_huyen = document.getElementById("capnhat_huyen").value;
//     var capnhat_email = document.getElementById("capnhat_email").value;


//     // console.log(hoten);
//     // console.log(sodienthoai);
//     // console.log(sonha);

//     // console.log(capnhat_thanhpho);
//     // console.log(capnhat_tinh);
//     // console.log(capnhat_huyen);
//     // console.log(capnhat_email);


//     if(capnhat_hoten.trim() == ""){
//         $("#statusMsg1_capnhat").html('<small style="color:red;"> Vui lòng điền họ tên! </small>');
//         $("#capnhat_hoten").focus();
//         return false;
//     } else if (capnhat_sodienthoai.trim() == ""){
//         $("#statusMsg2_capnhat").html('<small style="color:red;"> Vui lòng điền số điện thoại! </small>');
//         $("#capnhat_sodienthoai").focus();
//         return false; 
//     }else if (capnhat_sonha.trim() == ""){
//         $("#statusMsg3_capnhat").html('<small style="color:red;"> Vui lòng điền số nhà! </small>');
//         $("#capnhat_sonha").focus();
//         return false; 
//     }else if (capnhat_thanhpho == "Thành phố"){
//         $("#statusMsg4_capnhat").html('<small style="color:red;"> Vui lòng chọn thành phố </small>'); 
//         $("#capnhat_thanhpho").focus();
//     }else if (capnhat_tinh == "Quận huyện"){
//         $("#statusMsg5_capnhat").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
//         $("#capnhat_tinh").focus(); 
//     }else if (capnhat_huyen == "Phường xã"){
//         $("#statusMsg6_capnhat").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
//         $("#capnhat_huyen").focus(); 
//     }
//     else{
//         $.ajax({
//             url:'../Student/updateAddress.php',
//             method: "POST",
//             dataType: "json",
//             data:{
//                 capnhat_stusignup: "capnhat_stusignup", // Gui thong bao dang ky qua addstudent
//                 capnhat_hoten: capnhat_hoten,
//                 capnhat_sodienthoai: capnhat_sodienthoai,
//                 capnhat_sonha: capnhat_sonha,
//                 capnhat_thanhpho: capnhat_thanhpho,
//                 capnhat_tinh: capnhat_tinh,
//                 capnhat_huyen: capnhat_huyen,
//                 capnhat_email: capnhat_email,
//             }, success:function(data){    
//                 console.log(data)

//                 setTimeout(()=>{
//                     window.location.href = "/Student/studentAddress.php";
//                 }, 800 );

//                 if(data == "Failed"){
//                     $('#successMsg').html("<span class='alert alert-bg-danger'> Cập nhật địa chỉ thất bại!</span>")
//                 }else if(data == "OK"){
//                     $('#successMsg').html("<span class='alert alert-success'> Cập nhật địa chỉ thành công!</span>")
//                     //clearStuRegField();
//                     setTimeout(()=>{
//                         window.location.href = "/Student/studentAddress.php";
//                     }, 800 );
//                 }
//             }
//         });
//         }
// }