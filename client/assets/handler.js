$(document).on("click", function(event){
    console.log(event.target)
})

$("input").click(function () {
    console.log($(this).id)
})