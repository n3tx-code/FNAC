var step = 1;

$(".btn-next-inscription").click(function () {
    step++;
    if(step == 2)
    {
        $("#inscription-1").hide();
        $("#inscription-2").show();
        $(".btn-back-inscription").show();
    }
    else if(step == 3)
    {
        $("#inscription-2").hide();
        $("#inscription-3").show();
    }
    else if(step == 4)
    {
        $("#inscription-3").hide();
        $(".btn-next-inscription").hide();
        $("#inscription-4").show();
    }

});

$(".btn-back-inscription").click(function () {
    step--;
    if(step == 1)
    {
        $("#inscription-2").hide();
        $(".btn-back-inscription").hide();
        $("#inscription-1").show();
    }
    else if(step == 2)
    {
        $("#inscription-3").hide();
        $("#inscription-2").show();
    }
    else if(step == 3)
    {
        $("#inscription-4").hide();
        $("#inscription-3").show();
        $(".btn-next-inscription").show();
    }

});