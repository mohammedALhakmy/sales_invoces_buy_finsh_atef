$(document).ready(function (){

    $(document).on('click',"#update_image",function (e){
        e.preventDefault();
        if (!$('#photo').length){
            $("#oldimage").html('<br><input type="file" value="اختيار صورة"  onchange="readURL(this)" name="photo" id="photo">');
            $("#update_image").hide();
            $("#cancel_update_image").show();
        }
        return false

    });

    $(document).on('click',"#cancel_update_image",function (e){
        e.preventDefault();
        $("#update_image").show();
        $("#cancel_update_image").hide();
        $("#oldimage").html('');
        return false
    });
    $(document).on('click',"#are_you_sure",function (){

        let res = confirm('هل انت متاكد من عملية الحذف ');
        if (!res){
            return false;
        }
   })
});
