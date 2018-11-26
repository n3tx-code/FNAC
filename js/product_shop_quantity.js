document.querySelector('#shop_input[list="shop_list"]').addEventListener('input', function(e) {
    if(e.cancelable === true)
    {
        let datalist_value = e.target.value;
        let ref = $("#ref_id").val();
        let url = "/includes/scripts/stock_ref_shop.php?s=" + datalist_value + "&r=" + ref;

        fetch(url).then((response) =>{
            return response.text();
        }).then((data) =>{
            if(data !== "" && data > 0)
            {
                document.getElementById("ref_no_stock").style.display = "none";
                for(let el of document.getElementsByClassName("has-stock"))
                    el.style.display = "";
                document.getElementById("ref_quantity").setAttribute("max", data);
                document.getElementById("ref_add_command").removeAttribute("disabled");
            }
            else
            {
                document.getElementById("ref_no_stock").style.display = "";
                for(let el of document.getElementsByClassName("has-stock"))
                    el.style.display = "none";
                document.getElementById("ref_quantity").setAttribute("max", 0);
                document.getElementById("ref_add_command").setAttribute("disabled", true);
            }
        });
    }
    else
    {
        document.getElementById("ref_no_stock").style.display = "";
        for(let el of document.getElementsByClassName("has-stock"))
            el.style.display = "none";
        document.getElementById("ref_quantity").setAttribute("max", 1);
        document.getElementById("ref_add_command").setAttribute("disabled", true);
    }
});