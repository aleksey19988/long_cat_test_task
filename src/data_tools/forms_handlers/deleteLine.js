let deleteBtns = document.getElementsByClassName("deleteBtn");
console.log(deleteBtns);

function getCountryName() {
    console.log("Получаем название страны");
}

function getNeighbor(elem) {
    let neighbor = elem.parentNode.previousSibling.previousSibling;

    let currentWayInArr = window.location.href.split('/');
    console.log(currentWayInArr);
    let newWayPrototype = '';
    for(let i = 0; i < currentWayInArr.length - 2; i++) {//Вычитаю из длины два потому, что для перехода в файл-обработчик нужно подняться на уровень выше (первый минус - это минус имя файла, второй минус - это минус имя текущей папки)
        newWayPrototype += `${currentWayInArr[i]}/`;
    }
    console.log(newWayPrototype);
    let currentFileName = currentWayInArr[currentWayInArr.length - 1];
    let handlerName = currentFileName.split('_');
    console.log(`${handlerName[0]}_${handlerName[1]}`);
    location.href = `${newWayPrototype}forms_handlers/${handlerName[0]}_${handlerName[1]}_handler.php?country=${neighbor.getAttribute("value")}`;
    console.log(neighbor.getAttribute("value"));
}