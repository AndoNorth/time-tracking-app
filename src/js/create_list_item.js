/* create new list item
 *  brief: this script will add a new item to todo-list with the new-item-form parameters
 */
createNewItemButton.addEventListener("click", () => {
  let listItem = createNewListItemObject();
  if (isValueUndefined(listItem) || listItem === null) {
    return;
  }
  if (
    isEmpty(listItems) ||
    isValueUndefined(listItems[0] || isValueUndefined(listItems))
  ) {
    // initialise listItems with listItem
    changeListOnListItem(todoList, listItem);
    listItems = [listItem];
    addListItemEleToList(todoList, listItem);
  } else {
    listItems = addListItemToList(todoList, listItem, listItems);
  }
});
/* attempt to move listItem to list */
function changeListOnListItem(list, listItem) {
  if (isListFull(list)) {
    return 1;
  } // guard clause so lists dont exceed list limit
  console.log(`list item (${listItem["item-name"]}) added to "${list.id}"`);
  /* set to new list */
  listItem.list = list.id;
  return 0;
}
/* attempt to add new item to listItems, returns a new array of listItems*/
function addListItemToList(list, listItem, listItems) {
  if (changeListOnListItem(list, listItem)) {
    return listItems;
  }
  addListItemEleToList(todoList, listItem);
  return [...listItems, listItem];
}
/* convert formData to listItem Object, and return listItem */
function createNewListItemObject() {
  const formEle = document.getElementById("new-item-form");
  const formData = new FormData(formEle);
  if (validateFormData(formData.entries())) {
    return null;
  }
  let listItem = Object.fromEntries(formData.entries());
  if (doesListItemAlreadyExist(listItem, listItems)) {
    console.log("error: item name already exists in current session");
    return null;
  }
  console.log("item created");
  return listItem;
}
/* create and add list item element to list - affects the DOM */
function addListItemEleToList(list, listItem) {
  // create list item element
  let listItemEle = document.createElement("div");
  listItemEle.classList.add("list-item");
  listItemEle.classList.add("draggable");
  listItemEle.draggable = true;
  // fill html elements with values
  listItemEle.innerText = listItem["item-name"];
  console.log("item added to DOM");
  list.append(listItemEle);
  resetFormData();
}
/* validate form data, return 0 if successful, else return 1 */
function validateFormData(entries) {
  // loop through formData
  for (var pair of entries) {
    // validate formData
    switch (pair[0]) {
      case "item-name":
        if (doesStringLenExceedVal(pair[1], MAX_LIST_NAME_LENGTH)) {
          console.log(
            `error: Item Name too long max characters=${MAX_LIST_NAME_LENGTH}`
          );
          return 1;
        } else if (isKVPUndefined(pair) || pair[1].length == 0) {
          console.log("error: Item Name is empty");
          return 1;
        }
        break;
      case "item-desc":
        if (doesStringLenExceedVal(pair[1], MAX_LIST_DESC_LENGTH)) {
          console.log(
            `error: Item Description too long max characters=${MAX_LIST_DESC_LENGTH}`
          );
          return 1;
        } else if (isKVPUndefined(pair) || pair[1].length == 0) {
          console.log("error: Item Desc is empty");
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
/* reset form data */
function resetFormData() {
  const form = document.getElementById("new-item-form");
  form.reset();
}
