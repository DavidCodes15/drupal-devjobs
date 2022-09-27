// const click = document.querySelector(".click");
// const html = document.querySelector("html");
// const modal = document.getElementById("modalBtn");
// const simplemodal = document.getElementById("simpleModal");
// const home = document.querySelector('.home');

// click.addEventListener("click",function(){
//   click.classList.toggle("translate-x-6");
//   html.classList.toggle("dark");
// })

// modal.addEventListener("click",function(){

//   simplemodal.classList.remove("hidden");
// })
// const click = document.querySelector(".click");
// click.addEventListener("click",function(){
//   console.log("click");
//   }) 

let darkMode;
function darkModeSwitch () {
  darkMode = document.getElementsByClassName("dark-off");

  if(darkMode.length){
    Object.values(darkMode).forEach(elem => {
      elem.classList.remove("dark-off");
      elem.classList.add("dark");
    })
  }else{
    darkMode = document.getElementsByClassName("dark");
    
    Object.values(darkMode).forEach(elem => {
      elem.classList.remove("dark");
      elem.classList.add("dark-off");
    })
  }
}
