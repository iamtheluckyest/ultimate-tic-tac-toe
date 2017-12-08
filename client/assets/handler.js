/* global $ */

// **Need to get current player from server, or will be p0's turn every time screen is refreshed**
var currentPlayer = 0;
var click;
var cellElem = '[type="radio"]:not(:checked)+label:before, [type="radio"]:not(:checked)+label:after, [type="radio"]:checked+label:before, [type="radio"]:checked+label:after';

$("input").click(function(event){
    // Ids of inputs equal their coordinates. First number is large cell array index, second number is small cell array index.
    var coord = $(this).attr("id");

    // Save this so that we can access from inside the ajax callback
    var that = this;
    
    // Holds coord so that user can click around as they consider their choices, then click again to confirm.
    if (click !== coord) {
        click = coord;
    } else {

        $.ajax({
            method: "POST" ,
            url: "board",
            contentType: 'application/json',
            data: JSON.stringify({
                "coord": coord,
                "player": currentPlayer
            })
        }).then(function(response){
            
            // If response is successful, swap player, update button class
            if (response[3]) {
                console.log(response)
                // console.log(JSON.parse(response));
                $("label[for='" + coord + "']").addClass("p" + currentPlayer);
                
                // Disable radio button
                $(that).attr("disabled", "")
                $("label").toggleClass("p1-turn")
                if(!currentPlayer) {
                    currentPlayer = 1;
                } else {
                    currentPlayer = 0;
                }
                
                
            } 
            // If response fails
            // This is only a safeguard as disabling the input will not allow you to change a cell that's already been clicked.
            else {
                console.log(response)
                console.log("cell has been chosen already");
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
        console.log(result);
        currentPlayer = 0;
    });
})