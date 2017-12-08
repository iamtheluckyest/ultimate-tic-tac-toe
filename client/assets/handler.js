/* global $ */

// **Need to get current player from server, or will be p0's turn every time screen is refreshed**
var currentPlayer = 0;
var click;

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
        }).then(function(res){
            
            // If response is successful, swap player, update button class
            if (res[3]) {
                console.log(JSON.parse(res));
                $("label[for='" + coord + "'], #" + coord).addClass("p" + currentPlayer);
                res = JSON.parse(res)
                // Disable radio button
                $(res).each(function(index, value){
                    if (res[index].active === true) {
                        // Toggle disabled to true for anything with id starting with index (coord of large cell)
                        $("input[id^="+ index +"]:not(.p0), input[id^="+ index +"]:not(.p1)").removeAttr("disabled");
                        $("#cell" + index).removeClass("inactive")
                    } else {
                        // Toggle disabled to false for anything with id starting with index (coord of large cell), unless cell has state
                        $("input[id^="+ index +"]").attr("disabled", "disabled");
                        $("#cell" + index).addClass("inactive")
                    }
                });
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
                console.log(res)
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