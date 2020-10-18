$(document).ready(function(){
    
    $("#searchZomato").keyup(function(){
            var searchText = $(this).val();
    $.ajax({
        url:"search.php?searchtext="+searchText,
        type: "GET",
        data: "hasan",
        dataType: "text",
        success: successFn,
        error: errorFn,
        complete:function(xhr, status){
            console.log("request is completed");
        }
        });
    });
            function successFn(result){
            console.log("successfully request sent ...");
            console.log(result);
            
            $("#suggestions").html(result);
        }
        function errorFn(xhr,status,result){
            console.log("failed to request sent");
        }
    

    });		