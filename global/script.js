const menu = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".slidebar-toggler");
const container_calendario = document.querySelector(".cont");
const row_calendario =document.querySelector(".row")
const contenedor = document.querySelector(".contenedor_effect");


sidebarToggler.addEventListener("click", ()=> {
    sidebar.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    menu.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    container_calendario.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    row_calendario.classList.toggle("collapsed");
});

sidebarToggler.addEventListener("click", ()=> {
    contenedor.classList.toggle("collapsed");
});


