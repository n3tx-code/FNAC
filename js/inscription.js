let step = 1;

let btn_next = document.getElementsByClassName("btn-next-inscription")[0];
let btn_back = document.getElementsByClassName("btn-back-inscription")[0];

btn_next.addEventListener("click", (e) =>{
   step++;

   switch (step)
   {
       case 2:
       {
           document.getElementById("inscription-1").style.display = "none";
           document.getElementById("inscription-2").style.display = "";
           btn_back.style.display = "";
       }
       break;
       case 3:
       {
           document.getElementById("inscription-2").style.display = "none";
           document.getElementById("inscription-3").style.display = "";
           btn_next.style.display = "none";
       }
       break;
       default:
           break;
   }
});

btn_back.addEventListener("click", (e) =>{
    step--;

    switch (step)
    {
        case 1:
        {
            document.getElementById("inscription-1").style.display = "";
            document.getElementById("inscription-2").style.display = "none";
            btn_back.style.display = "none";
        }
            break;
        case 2:
        {
            document.getElementById("inscription-2").style.display = "";
            document.getElementById("inscription-3").style.display = "none";
            btn_next.style.display = "";
        }
            break;
        default:
            break;
    }
});