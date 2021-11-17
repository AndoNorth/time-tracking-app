createNewItemButton.addEventListener('click', () => {
    /* consider moving these to global scope */
    const todoList = document.querySelector('.todo-list')
    const noToDoListItems = todoList.children.length
    /* TODO: add error message pop-up for this */
    if (noToDoListItems >= MAX_NO_LIST_ITEMS_PER_LIST) return
    let listItem = document.createElement("div")
    listItem.classList.add('list-item')
    listItem.classList.add('draggable')
    listItem.draggable = true
    listItem.innerText = "item" + (listItems.length + 1)
    todoList.append(listItem)
})