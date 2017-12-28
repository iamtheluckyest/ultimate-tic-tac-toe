/* global $ */

var click;
// $(document).on("ready", function() {
//     $.get("boardData")
//     .then(function(res){
        
//     })
// }



$(document).on("click", "input", function(event){
    // Ids of inputs equal their coordinates. First number is large cell array index, second number is small cell array index.
    var coord = $(this).attr("id");
    
    // Holds coord so that user can click around as they consider their choices, then click again to confirm.
    if (click !== coord) {
        click = coord;
    } else {
        $.ajax({
            method: "POST" ,
            url: "board",
            contentType: 'application/json',
            data: JSON.stringify({
                "coord": coord
            })
        }).then(function(res){
            /*---------------------------------------------------
            For the version that sends back html
            ---------------------------------------------------*/
            // console.log(res)
            // if (res) {
            //     // console.log(JSON.parse(res));
            //     // console.log(res)
            //     $("form").html(res);
                
            // } else {
            //     console.log(res);
            //     console.log("select a different cell");
            // }
            
            /*---------------------------------------------------
            For the version that sends back data
            ---------------------------------------------------*/
            
            // If response is successful, swap player, update button class
            if (res) {
                res = JSON.parse(res);
                console.log(res);
                
                // Color the cell that was just clicked.
                $("label[for='" + coord + "'], #" + coord).addClass("p" + (res.player ? "0" : "1") )
                
                // Remove border on "checked" property that comes from Materialize
                $("#" + coord).prop("checked", false);
                // Want to turn off animation on before/after, but can't target with jQuery
                // $("#" + coord + ":before", "#" + coord + ":after").css("transition", "")
                
                drawActiveCells(res);
                
                // If player 1's turn, add class. Otherwise remove class.
                $("label").toggleClass("p1-turn")
                
            } 
            // If response fails
            // This is only a safeguard as disabling the input will not allow you to change a cell that's already been clicked.
            else {
                console.log(res)
                console.log("cell has been chosen already or the game is over");
            }
            
            
        });
    }
});

$(".btn").click(function(event){
    $.ajax({
        method: "PUT" ,
        url: "reset",
        contentType: 'application/json'
    }).then(function(result){
        console.log(result);
        window.location.reload();
    });
})

function drawActiveCells(board){
    // Disable/enable inactive/active boards
    $(board.cells).each(function(index, value) {
        var hasWinner = ""
        if(value.winner !== null) {
            hasWinner = "hasWinner" + value.winner;
        }
        
        if (value.active === true) {
            // Toggle disabled off for anything with id starting with key (coord of large cell)
            $("input[id^="+ index +"]:not(.p0), input[id^="+ index +"]:not(.p1)").removeAttr("disabled");
            $("#cell" + index).removeClass("inactive")
        } else {
            // Toggle disabled on for anything with id starting with key (coord of large cell), unless cell has state
            $("input[id^="+ index +"]").attr("disabled", "disabled");
            $("#cell" + index).addClass("inactive " + hasWinner)
        }
    });
}