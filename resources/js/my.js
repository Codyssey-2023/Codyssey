//Parallax Background
const parallax = document.getElementById("parallax");

window.addEventListener("scroll", function(){
    let offset = window.pageYOffset;
    parallax.style.backgroundPositionY = offset * 0.08 + "px";
})

const parallax2 = document.getElementById("parallaxBody");

window.addEventListener("scroll", function(){
    let offset = window.pageYOffset;
    parallax2.style.backgroundPositionY = offset * 0.03 + "px";
})
const parallax3 = document.getElementById("parallax2");

window.addEventListener("scroll", function(){
    let offset = window.pageYOffset;
    parallax3.style.backgroundPositionY = offset * 0.08 + "px";
})
//Session message
let message = document.querySelectorAll('.alertFade');

setTimeout(() => {
    message.forEach((el) => {
        
        el.classList.add('d-none');
    });
}, 7000);