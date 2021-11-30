const elements = document.getElementsByClassName("nav-link");

const myFunction = function () {
    const attribute = this.getAttribute("aria-expanded");
    let div = this.parentNode.children[1];
    if (attribute === 'false') {
        this.classList.remove("collapsed");
        div.setAttribute("class", "collapse show")
        this.setAttribute("aria-expanded", "true");
    }
    if (attribute === 'true') {
        this.classList.add("collapsed");
        div.setAttribute("class", "collapse")
        this.setAttribute("aria-expanded", "false");
    }
};

for (let i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', myFunction, false);
}
