let deleteBtns = document.getElementsByClassName("deleteBtn");
console.log(deleteBtns);

function getCountryName() {
    console.log("Получаем название страны");
}

function getNeighbor(elem) {
    let neighbor = elem.parentNode.previousSibling.previousSibling;
    console.log(neighbor.getAttribute("value"));
}