$(document).ready(function(){
    
    //onclick like function
    $(".ban").on("click", function(){
        //get the current count set in the p tag of the div as a integer
        //var currentCount = parseInt($(this).children("p").text()); 
        //get the id of the mood that was clicked on with the data attr
        var userId = $(this).data("id");
        console.log(userId);

        //perform AJAX
        $.ajax({
            url: "/ban",
            type: "POST",
            data: { id: userId },
            dataType: "text",
            async: true,

        });
        $(this).hide();


        $(this).parent().hide();

    
    });

    $(".unban").on("click", function(){
        //get the current count set in the p tag of the div as a integer
        //var currentCount = parseInt($(this).children("p").text()); 
        //get the id of the mood that was clicked on with the data attr
        var userId = $(this).data("id");
        console.log(userId);

        //perform AJAX
        $.ajax({
            url: "/unban",
            type: "POST",
            data: { id: userId },
            dataType: "text",
            async: true,

        });
        $(this).hide();


        $(this).parent().hide();

    
    });
})
