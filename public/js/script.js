document.addEventListener("DOMContentLoaded", function () {
    var rootLinks = document.querySelectorAll(".root-link");

    rootLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            this.classList.toggle("active");
        });
    });
});
