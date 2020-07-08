function animateCSS(element, animationName, callback) {
    element.classList.add("animated", animationName);
    element.addEventListener("animationend", handleAnimationEnd);

    function handleAnimationEnd() {
        element.classList.remove("animated", animationName);
        element.removeEventListener("animationend", handleAnimationEnd);

        if (typeof callback === "function") callback();
    }
}
