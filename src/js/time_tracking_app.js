/*** time tracking app ***/
/** constants **/
const MAX_NO_LIST_ITEMS_PER_LIST = 7;
const MAX_LIST_NAME_LENGTH = 15;
const MAX_LIST_DESC_LENGTH = 40;
/**  DOM objects **/
/* fixed objects */
const lists = document.querySelectorAll('.list');
const doingList = document.querySelector('.doing-list');
const todoList = document.querySelector('.todo-list');
const doneList = document.querySelector('.done-list');
/* buttons */
const saveButton = document.querySelector('.save-button');
const loadButton = document.querySelector('.load-button');
const createNewItemButton = document.querySelector('.create-item-button');
/** dynamic objects **/
let noListItems = document.querySelectorAll('.list-item').length;
let listItems = Array(Object());
/** main app **/
console.log(currentTime());
/** global functions **/
/*
    function: allows events to be added to new elements which match element selector query
    input: event name, element selector query, callback function
*/
function addGlobalEventListener(type, selector, callback) {
    document.addEventListener(type, e => {
        if (e.target.matches(selector)) callback(e)
    });
}    
/* guard clause so lists dont exceed list limit */
function isListFull(list){
    if (list.children.length >= MAX_NO_LIST_ITEMS_PER_LIST) {
        console.log("error: list is full");
        return 1;
    }
    return 0;
}
/* return current date time */
function currentTime(){
    return new Date();
}
/* is key value pair value undefined */
function isKVPUndefined(pair){
    return typeof pair[1] == "undefined";
}
/* does string length exceed value */
function doesStringLenExceedVal(string, maxVal){
    return string.length > maxVal;
}