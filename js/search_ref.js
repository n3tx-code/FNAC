let search = (function(){
    let _input = null;
    let _result = null;
    let _hover = false;

    function show()
    {
        _result.style.display = "";
    }

    function hide()
    {
        _result.style.display = 'none';
    }

    function init(input, result)
    {
        _input = input;
        _result = result;
        hide();
    }

    return{
        reference : function(input, result)
        {
            init(input, result);

            _input.addEventListener('input', (e) =>{

                let val = e.target.value
                let url = '/includes/search_ref.php?search=' + val;

                fetch(url).then((response) =>{
                    return response.text();
                }).then((html) =>{
                    _result.innerHTML = html;
                    show();
                })
            });

            _input.addEventListener('focus', (e) =>{
                show();
            });

            _input.addEventListener('blur', (e)=>{
                if(!_hover)
                {
                    hide();
                }
            });

            _result.addEventListener('mouseover', (e) =>{
               _hover = true;
            });

            _result.addEventListener('mouseout', (e) =>{
                _hover = false;
            })
        }
    }
})();