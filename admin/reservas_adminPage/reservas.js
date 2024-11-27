const menu = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".slidebar-toggler");
const contenedor_reservas = document.querySelector(".container-reservas")
const row_calendario =document.querySelector(".row")
const contenedor = document.querySelector(".contenedor_effect");


sidebarToggler.addEventListener("click", ()=> {
    sidebar.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    menu.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    contenedor_reservas.classList.toggle("collapsed");
});


sidebarToggler.addEventListener("click", ()=> {
    contenedor.classList.toggle("collapsed");
});

