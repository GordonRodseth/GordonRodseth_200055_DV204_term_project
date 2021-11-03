$(document).ready(function(){

    //onclick like function
    $(".delete").click(function(){
        //get the current count set in the p tag of the div as a integer
        //var currentCount = parseInt($(this).children("p").text()); 
        //get the id of the mood that was clicked on with the data attr
        var postId = $(this).data("id");
        console.log(postId);

        //perform AJAX
        $.ajax({
            url: "/delete",
            type: "POST",
            data: { id: postId },
            dataType: "text",
            async: true,

        });
        $(this).hide();
        $(this).siblings("post").hide();


    
    });


});