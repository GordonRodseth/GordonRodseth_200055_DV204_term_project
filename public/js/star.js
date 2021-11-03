$(document).ready(function(){
    
    //onclick like function
    $("#star").on("click", function(){
        //get the current count set in the p tag of the div as a integer
        //var currentCount = parseInt($(this).children("p").text()); 
        //get the id of the mood that was clicked on with the data attr
        var commentId = $(this).data("id");
        console.log(commentId);

        //perform AJAX
        $.ajax({
            url: "/star",
            type: "POST",
            data: { id: commentId },
            dataType: "text",
            async: true,

        });


        $(this).text("star");

    
    });

    $("#unstar").on("click", function(){
        //get the current count set in the p tag of the div as a integer
        //var currentCount = parseInt($(this).children("p").text()); 
        //get the id of the mood that was clicked on with the data attr
        var commentId = $(this).data("id");
        console.log(commentId);

        //perform AJAX
        $.ajax({
            url: "/unstar",
            type: "POST",
            data: { id: commentId },
            dataType: "text",
            async: true,

        });

        $(this).text("star_outline");

    
    });
})
