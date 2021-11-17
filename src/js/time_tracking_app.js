/* time tracking app */
/* constants */
const MAX_NO_LIST_ITEMS_PER_LIST = 4
/* DOM objects */
/* fixed objects */
const lists = document.querySelectorAll('.list')
const createNewItemButton = document.querySelector('.create-item-button')
/* dynamic objects */
let listItems = document.querySelectorAll('.list-item')

/* global functions */
/*
    function: allows events to be added to new elements which match element selector query
    input: event name, element selector query, callback function
*/
function addGlobalEventListener(type, selector, callback) {
    document.addEventListener(type, e => {
        if (e.target.matches(selector)) callback(e)
    })
}