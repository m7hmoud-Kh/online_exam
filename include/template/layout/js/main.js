$(function(){

    $("input").focus(function(){
        $(this).attr("thisval",$(this).attr("placeholder"));
        $(this).attr("placeholder","");
    });
    $("input").blur(function(){
        $(this).attr("placeholder",$(this).attr("thisval"));
    });
    $("textarea").focus(function(){
        $(this).attr("thisval",$(this).attr("placeholder"));
        $(this).attr("placeholder","");
    });
    $("textarea").blur(function(){
        $(this).attr("placeholder",$(this).attr("thisval"));
    });

    $("#chnagepass").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#chnagepass")[0].reset();
                $("#result").html(data);
            }
        });
    });

    $("#chnagepassprof").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#chnagepassprof")[0].reset();
                $("#result").html(data);
                console.log(data);
            }
        });
    });

    $("#addexam").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#addexam")[0].reset();
                $("#addex").html(data);
            }
        });
    });
});