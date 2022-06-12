let logojustificatif =document.getElementById("logojustificatif");
let listejustificatif =document.getElementById("listejustificatif");


logojustificatif.addEventListener("click", () => {
    if(getComputedStyle(listejustificatif).display != "none"){
        listejustificatif.style.display = "none";
    } else {
        listejustificatif.style.display = "block";
    }
})







  