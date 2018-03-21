function $(selector){
    return document.querySelectorAll(selector);
}

function deleteElement(element){
    element.parentElement.removeChild(element);
}

// delete elements in array, starting from start index (inclusive) to end index (exclusive)
function deleteElements(elements, start= 0, end= elements.length){
    for(i = start; i<end; i++){
        deleteElement(elements[i]);
    }

}