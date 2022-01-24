let positionSort = document.getElementById('position-sort');
let countriesSort = document.getElementById('country-sort');
let firstPositionSort = document.getElementById('first-position-sort');
let secondPositionSort = document.getElementById('second-position-sort');
let thirdPositionSort = document.getElementById('third-position-sort');
let allMedalsNumberSort = document.getElementById('all-medals-number-sort');

function removeAttributes(elements) {
    for(let i = 0; i < arguments.length; i++) {
        arguments[i].removeAttribute('direction');
    }
}

function setDirection(element) {
    if (element.getAttribute('direction') !== 'ASC') {
        element.setAttribute('direction', 'ASC');
    } else {
        element.setAttribute('direction', 'DESC');
    }
}

function redirect(sortParameter) {
    // location.href = `src/data_tools/sort_tools/sorted_data.php?parameter=${sortParameter.getAttribute('id')}&direction=${sortParameter.getAttribute("value")}`;
}

positionSort.onclick = function () {
    removeAttributes(countriesSort, firstPositionSort, secondPositionSort, thirdPositionSort, allMedalsNumberSort);
    setDirection(positionSort);
    redirect(positionSort);
}

countriesSort.onclick = function () {
    removeAttributes(positionSort, firstPositionSort, secondPositionSort, thirdPositionSort, allMedalsNumberSort);
    setDirection(countriesSort);
    redirect(countriesSort);
}

firstPositionSort.onclick = function () {
    removeAttributes(positionSort, countriesSort, secondPositionSort, thirdPositionSort, allMedalsNumberSort);
    setDirection(firstPositionSort);
    redirect(firstPositionSort);
}

secondPositionSort.onclick = function () {
    removeAttributes(positionSort, countriesSort, firstPositionSort, thirdPositionSort, allMedalsNumberSort);
    setDirection(secondPositionSort);
    redirect(secondPositionSort);
}

thirdPositionSort.onclick = function () {
    removeAttributes(positionSort, countriesSort, firstPositionSort, secondPositionSort, allMedalsNumberSort);
    setDirection(thirdPositionSort);
    redirect(thirdPositionSort);
}

allMedalsNumberSort.onclick = function () {
    removeAttributes(positionSort, countriesSort, firstPositionSort, secondPositionSort, thirdPositionSort);
    setDirection(allMedalsNumberSort);
    redirect(allMedalsNumberSort);
}