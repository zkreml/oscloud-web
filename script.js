window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("scrollToTopBtn").style.display = "block";
    } else {
        document.getElementById("scrollToTopBtn").style.display = "none";
    }
}

// Posunout nahoru, když uživatel klikne na tlačítko
function scrollToTop() {
    document.body.scrollTop = 0; // Pro Safari
    document.documentElement.scrollTop = 0; // Pro ostatní prohlížeče
}