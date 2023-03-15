// Chức năng thêm địa chỉ
$(document).ready(function(){
    $(".thanhpho").change(function(){ // class thanhpho thay doi thì
        var idThanhPho = $(".thanhpho").val();
         //alert(idThanhPho);
        $.post("/Student/dataAddressProvince.php", {id: idThanhPho}, function(dataAddressProvince){
            $(".tinh").html(dataAddressProvince);
        })
    })

    $(".tinh").change(function(){ // class tinh thay doi thì
        var idTinh = $(".tinh").val();
        //alert(idTinh);
         $.post("/Student/dataAddressDistrict.php", {idHuyen: idTinh}, function(dataAddressDistrict){
             $(".huyen").html(dataAddressDistrict);
         })
    })
})

// Chức năng cập nhật địa chỉ
$(document).ready(function(){
    $(".capnhat_thanhpho").change(function(){ 
        var idThanhPho = $(".capnhat_thanhpho").val();
         //alert(idThanhPho);
        $.post("/Student/dataAddressProvince.php", {id: idThanhPho}, function(dataAddressProvince){
            $(".capnhat_tinh").html(dataAddressProvince);
        })
    })

    $(".capnhat_tinh").change(function(){ 
        var idTinh = $(".capnhat_tinh").val();
        //alert(idTinh);
         $.post("/Student/dataAddressDistrict.php", {idHuyen: idTinh}, function(dataAddressDistrict){
             $(".capnhat_huyen").html(dataAddressDistrict);
         })
    })
})