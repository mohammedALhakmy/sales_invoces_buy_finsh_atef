$(document).ready(function (){
    $(document).on('input',"#search_by_text",function (){
       var search_by_text = $(this).val();
       let token_search = $("#token_search").val();
       let ajax_search_url = $("#ajax_search_url").val();
       $.ajax({
          url:ajax_search_url,
          type:"post",
          dataType:"html",
          cache:false,
          data:{search_by_text:search_by_text,"_token":token_search},
          success:function (data){
            $("#ajax_response_searchDiv").html(data);
          },error:function (){
                alert("####");
           }
       });
    });


    $(document).on('click',"#ajax_pagenation_in_serach a",function (e){
        e.preventDefault();
        let search_by_text = $("#search_by_text").val();
        let token_search = $("#token_search").val();
        let url = $(this).attr('href');
        $.ajax({
            url:url,
            type:"post",
            dataType:"html",
            cache:false,
            data:{search_by_text:search_by_text,"_token":token_search},
            success:function (data){
                $("#ajax_response_searchDiv").html(data);
            },error:function (){
                alert("####");
            }
        });
    })
});
