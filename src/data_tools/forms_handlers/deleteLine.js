let deleteBtns = document.getElementsByClassName("deleteBtn");

function getNeighbor(elem) {
    let neighbor = elem.parentNode.previousSibling.previousSibling;

    let currentWayInArr = window.location.href.split('/');
    let newWayPrototype = '';
    for(let i = 0; i < currentWayInArr.length - 2; i++) {//Вычитаю из длины два потому, что для перехода в файл-обработчик нужно подняться на уровень выше (первый минус - это минус имя файла, второй минус - это минус имя текущей папки)
        newWayPrototype += `${currentWayInArr[i]}/`;
    }
    let currentFileName = currentWayInArr[currentWayInArr.length - 1];
    let handlerName = currentFileName.split('_');
    location.href = `${newWayPrototype}forms_handlers/${handlerName[0]}_${handlerName[1]}_handler.php?${handlerName[1]}=${neighbor.getAttribute("value")}`;
}