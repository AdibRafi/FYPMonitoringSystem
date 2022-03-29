window.addEventListener("load",function (){
    var menuIcon = document.querySelector('.menu-icon');

    menuIcon.addEventListener('click', ()=>{
        var sidebar = document.getElementsByClassName('sidebar');
        sidebar.item(0).classList.toggle("hidden");
    })
})