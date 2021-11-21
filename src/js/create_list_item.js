/* create new list item
*  brief: this script will add a new item to todo-list with the new-item-form parameters
*/
createNewItemButton.addEventListener('click', () => {
    new listItem = createNewListItemObject();
    if(typeof listItem == "undefined"){
        addListItemToList(todoList, listItem, listItems );
    }
});

/* attempt to move listItem to list */
function moveListItemToList(list, listItem, listItems){
    isListFull(list); // guard clause so lists dont exceed list limit
    /* set to new list */
    listItem.list = list.id;
}
/* attempt to add new item to listItems */
function addListItemToList(list, listItem, listItems){
    moveListItemToList(list, listItem, listItems);
    [...listItems, listItem];
}

/* convert formData to listItem Object, and return listItem */
function createNewListItemObject(){
    const formEle = document.getElementById('new-item-form');
    const formData = new FormData(formEle);
    if(validateFormData(formData.entries())) { return null; };
    listItem = Object.fromEntries(formData.entries());
    console.log("item created");
    return listItem;
}

/* validate form data, return 0 if successful, else return 1 */
function validateFormData(entries){
    // loop through formData
    for (var pair of entries) {
        // validate formData
        switch(pair[0]){
            case "item-name":
                if(doesStringLenExceedVal(pair[1], MAX_LIST_NAME_LENGTH)) {
                    console.log(`error: Item Name too long max characters=${MAX_LIST_NAME_LENGTH}`);
                    return 1;
                }
                else if(isKVPUndefined(pair) || pair[1].length == 0) {
                    console.log("error: Item Name is empty");
                    return 1;
                }
                break;
            case "item-desc":
                if(doesStringLenExceedVal(pair[1], MAX_LIST_DESC_LENGTH)){
                    console.log(`error: Item Description too long max characters=${MAX_LIST_DESC_LENGTH}`);
                    return 1;
                }
                else if(isKVPUndefined(pair) || pair[1].length == 0) {
                    console.log("error: Item Name is empty");
                    return 1;
                }
                break;
            case "tag":
                break;
            default:
                console.log("error: non-valid form data");
                return 1;
        }
    }
    return 0;
}

/* test creating a new list item and appending it to list element */
function createNewListItemTest(list, noListItems){
    const noItemsInlist = list.children.length
    if (noItemsInlist >= MAX_NO_LIST_ITEMS_PER_LIST) {
        console.log(`error: maxNoList for list maxNo: ${MAX_NO_LIST_ITEMS_PER_LIST}`)
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