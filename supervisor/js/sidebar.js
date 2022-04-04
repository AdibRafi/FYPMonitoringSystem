const menuIcon = document.querySelector(".menu-icon");

menuIcon.addEventListener("click", () => {
  const sidebar = document.getElementsByClassName("sidebar");
  sidebar.item(0).classList.toggle("hidden");
});
