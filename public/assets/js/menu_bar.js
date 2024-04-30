const hamBurgers = document.querySelectorAll(".toggle-btn");
hamBurgers.forEach(function(hamBurger) {
  hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
  });
});