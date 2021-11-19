/* create new list item
*  brief: this script will add a new item to todo-list with the new-item-form parameters
*/
createNewItemButton.addEventListener('click', () => { noListItems = createNewListItem(todoList, noListItems); })

function createNewListItem(list, noListItems){
    const noItemsInlist = list.children.length
    if (noItemsInlist >= MAX_NO_LIST_ITEMS_PER_LIST) {
        /* TODO: add error message pop-up for this */
        return noListItems
    }
    noListItems++
    let listItem = document.createElement("div")
    listItem.classList.add('list-item')
    listItem.classList.add('draggable')
    listItem.draggable = true
    /* TODO: add list item description from new-item-form */
    listItem.innerText = `item${noListItems}`
    todoList.append(listItem)
    return noListItems
}