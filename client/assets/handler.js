var currentPlayer = 0;

$(document).on("click", "input", function(event){
    var coord = $(this).attr("id");
    $.ajax({
        method: "POST" ,
        url: "board",
        contentType: 'application/json',
        data: JSON.stringify({
            "coord": coord,
            "player": currentPlayer
        })
    }).then(function(result){
        console.log(result);
        if(currentPlayer) {
            currentPlayer = 0;
        } else {
            currentPlayer = 1;
        }
    });
})

