let search = (function(){
    let search_ref_promo = null;
    let search_result = null;

    return{
        init : function(input, result)
        {
            search_ref_promo = document.getElementById(input);
            if(search_ref_promo == null || search_ref_promo.nodeName !== "INPUT")
            {
                console.error("Invalid input name !");
                return;
            }

            search_result = document.getElementById(result);
            if(search_result == null || search_result.nodeName !== "UL")
            {
                console.error("Invalid result name !");
                return;
            }

            search_ref_promo.addEventListener('input', function(e){

                let formdata = new FormData();
                formdata.append("search", search_ref_promo.value);

                let init = {
                    method: 'POST',
                    body: formdata
                };

                fetch('includes/search_ref.php', init).then(function(response){
                    return response.text();
                }).then(function(data){
                    search_result.innerHTML = data;
                });
            });
        }
    };
})();