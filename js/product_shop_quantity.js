document.querySelector('#shop_input[list="shop_list"]').addEventListener('input', function(e) {
    if(e.cancelable === true)
    {
        let datalist_value = e.target.value;
        let ref = $("#ref_id").val();
        let url = "/includes/scripts/stock_ref_shop.php?s=" + datalist_value + "&r=" + ref;
        $.get(url , function(data, status){
            if(status === "success")
            {
                if(data !== "" && data > 0)
                {
                    $("#ref_no_stock").hide();
                    $(".has-stock").show();
                    $("#ref_quantity").attr("max", data);
                    $("#ref_add_command").prop('disabled', false);
                }
                else
                {
                    $("#ref_no_stock").show();
                    $(".has-stock").hide();
                    $("#ref_quantity").attr("max", 0);
                    $("#ref_add_command").prop('disabled', true);

                }
            }
            else
            {
                console.log("error");
            }
        });
    }
    else
    {
        $("#ref_no_stock").show();
        $(".has-stock").hide();
        $("#ref_quantity").attr("max", 1);
        $("#ref_add_command").prop('disabled', true);
    }
});