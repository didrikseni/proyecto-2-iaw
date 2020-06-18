function stars(n) {
    for (let i = 1; i < 6; i++) {
        let item = document.getElementById("star-" + i).firstChild;
        if (i < n+1) {
            item.classList.remove('far');
            item.classList.add('fas');
        } else {
            item.classList.remove('fas');
            item.classList.add('far');
        }
    }
}

function setSelected(n) {
    let elem = document.getElementById("form-value");
    elem.value = n;
}
