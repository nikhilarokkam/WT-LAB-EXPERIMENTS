function rImg(x){
    x.style.borderRadius="50%";
}
function normalImg(x){
    x.style.borderRadius="0%";
}
function rFont(x){
    x.style.fontSize="25px";
    x.style.color="white";
}
function normalFont(x){
    x.style.fontSize="24px";
    x.style.color="black";
}
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {

  var dropdowns = document.getElementsByClassName("dropdown-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
    var openDropdown = dropdowns[i];
    if (openDropdown.classList.contains('show')) {
      openDropdown.classList.remove('show');
    }
  }
}
}