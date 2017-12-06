/* global $ */

var currentPlayer = 0;
var clicks = {};

$("input").click(function(event){
    // Ids of inputs equal their coordinates. First number is large cell array index, second number is small cell array index.
    var coord = $(this).attr("id");
    
    // Save this so that we can access from inside the ajax callback
    var that = this;
    
    // Allows natural function of input buttons to operate as player considers choices. To confirm choice, player must click again.
    if (!clicks[coord]) {
        
        // Change cell to the color that corresponds to the players
        clicks[coord] = true;
    
    } else {
        $("label[for='" + coord + "']").addClass("p" + currentPlayer)

        $.ajax({
            method: "POST" ,
            url: "board",
            contentType: 'application/json',
            data: JSON.stringify({
                "coord": coord,
                "player": currentPlayer
            })
        }).then(function(response){
            console.log(response);
            
            // If response is successful, swap player, update button class
            if (response) {
                console.log("cell has been chosen");
                // Disable radio button
                // $(that).attr("disabled", "")
                if(!currentPlayer) {
                    currentPlayer = 1;
                } else {
                    currentPlayer = 0;
                }
            } 
            // If response fails
            // This is only a safeguard as disabling the input will not allow you to change a cell that's already been clicked.
            else {
                console.log("cell has been chosen already");
                // clicks[coord] = false;
            }
            
        });
    };
});

$(".btn").click(function(event){
    var coord = $(this).attr("id");
    $.ajax({
        method: "PUT" ,
        url: "reset",
        contentType: 'application/json'
    }).then(function(result){
        console.log(result)
        currentPlayer = 0;
    });
})