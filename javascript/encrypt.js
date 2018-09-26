$("#submitButton").click(function(){
    $.ajax({url: "register.php", success: function(result){
        $("#div1").html(result);
    }});
});