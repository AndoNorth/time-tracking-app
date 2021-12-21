/*** time tracking app ***/
/** constants **/
const MAX_NO_LIST_ITEMS_PER_LIST = 7;
const MAX_LIST_NAME_LENGTH = 15;
const MAX_LIST_DESC_LENGTH = 40;
// min time is list to incur a time stamp
const MIN_TIME_IN_LIST = 1000 * 60 * 1; // 1000ms, 60 seconds, 1 minutes
const SAVE_LIST_STATE_TIME = 1000 * 60 * 3; // 1000ms, 60 seconds, 3 minutes
/**  DOM objects **/
/* fixed objects */
const lists = document.querySelectorAll(".list");
const doingList = document.querySelector(".doing-list");
const todoList = document.querySelector(".todo-list");
const doneList = document.querySelector(".done-list");
/* buttons */
const saveButton = document.querySelector(".save-button");
const loadButton = document.querySelector(".load-button");
const createNewItemButton = document.querySelector(".create-item-button");
/** dynamic objects **/
let listItems = Array();
/** main app **/
console.log(currentTime());
/* load list from local storage */
loadListItemsFromLS();
refreshListState();
/* save list every so often */
setInterval(saveListItemsToLS, SAVE_LIST_STATE_TIME);
/** global functions **/
/*
    function: allows events to be added to new elements which match element selector query
    input: event name, element selector query, callback function
*/
function addGlobalEventListener(type, selector, callback) {
  document.addEventListener(type, (e) => {
    if (e.target.matches(selector)) callback(e);
  });
}
/* guard clause so lists dont exceed list limit */
function isListFull(list) {
  if (typeof list.children === "undefined") {
    return 0;
  }
  if (list.children.length >= MAX_NO_LIST_ITEMS_PER_LIST) {
    console.log("error: list is full");
    return 1;
  }
  return 0;
}
/* find list item by name */
function findListItemByName(itemName, listItems) {
  return listItems.filter((item) => {
    return item["item-name"] === itemName;
  })[0];
}
/* does list item exist, if 0 then does not exist */
function doesListItemAlreadyExist(listItem, listItems) {
  return listItems.filter((item) => {
    return item["item-name"] === listItem["item-name"];
  }).length;
}
/* return current date time */
function currentTime() {
  let x = new Date();
  // x.toString(); // local time for string representation
  // expected output: Wed Oct 05 2011 16:48:00 GMT+0200 (CEST)
  // (note: your timezone may vary)
  // x.toISOString()); // ISO-8601 format for JSON saving
  // expected output: 2011-10-05T14:48:00.000Z
  return x.toISOString();
}
/* is value undefined */
function isValueUndefined(val) {
  return typeof val == "undefined";
}
/* is key value pair value undefined */
function isKVPUndefined(pair) {
  return isValueUndefined(pair[1]);
}
/* does string length exceed value */
function doesStringLenExceedVal(string, maxVal) {
  return string.length > maxVal;
}
/* check if object is empty */
function isEmpty(obj) {
  return Object.keys(obj).length === 0;
}
/* refresh list state */
function refreshListState() {
  // remove all child elements (list-item s)
  lists.forEach((list) => {
    list.innerHTML = `${list.id.replace("-", " ")}`;
  });
  listItems.forEach((item) => {
    tarList = document.getElementById(item["list"]);
    addListItemEleToList(tarList, item);
  });
}
/* save list items to local storage */
function saveListItemsToLS() {
  localStorage.setItem("listItems", JSON.stringify(listItems));
  console.log("listItems saved to local storage");
}
/* save list items to session storage */
function saveListItemsToSS() {
  sessionStorage.setItem("listItems", JSON.stringify(listItems));
  console.log("listItems saved to session storage");
}
/* load list items from local storage */
function loadListItemsFromLS() {
  let listItemsFromLS = JSON.parse(localStorage.getItem("listItems"));
  let isNull = listItemsFromLS == null;
  if (isNull) {
    console.log("listItems from local storage is null");
    return;
  }
  listItems = listItemsFromLS;
  console.log("listItems loaded from local storage");
}
/* load list items from session storage */
function loadListItemsFromSS() {
  listItems = JSON.parse(sessionStorage.getItem("listItems"));
  console.log("listItems loaded from session storage");
}
/** test scripts **/
/* test creating a new list item and appending it to list element */
function createNewListItemTest(list, noListItems) {
  const noItemsInlist = list.children.length;
  if (noItemsInlist >= MAX_NO_LIST_ITEMS_PER_LIST) {
    console.log(
      `error: maxNoList for list maxNo: ${MAX_NO_LIST_ITEMS_PER_LIST}`
    );
    return noListItems;
  }
  noListItems++;
  let listItem = document.createElement("div");
  listItem.classList.add("list-item");
  listItem.classList.add("draggable");
  listItem.draggable = true;
  listItem.innerText = `item${noListItems}`;
  todoList.append(listItem);
  return noListItems;
}
/* test asynchronous request/response APIs */
const testJson = { firstName: "Bob", lastName: "Kong", age: 50 };
const uri = "src/php/receive.php";
/* using Fetch API to make request to server */
function testFetchAPI() {
  console.log("POST(Fetch): " + JSON.stringify(testJson));
  fetch(uri, {
    method: "POST",
    body: JSON.stringify(testJson),
    headers: {
      "Content-Type": "application/json",
    },
  })
    // handle response from the server
    .then((response) => {
      if (response.status == 200) {
        return response.text(); // can be .json()
      } else {
        throw new Error("Error Message");
      }
    })
    .then((text) => console.log("RESPONSE: " + text))
    // error handling
    .catch((error) => console.error("ERROR: " + error.message));
}
/* using AJAX API to make request to server */
function testAJAXAPI() {
  console.log("POST(AJAX): " + JSON.stringify(testJson));
  const xhr = new XMLHttpRequest();
  // open request - method, uri, is request asynchronous (default=true)
  xhr.open("POST", uri, true);
  xhr.setRequestHeader("Content-Type", "application/json");
  // handle the response from the server
  xhr.addEventListener("load", function (response) {
    var data = response.responseTest; // or responseXML
    var text = JSON.parse(data); // JSON object
    console.log("RESPONSE: " + text);
  });
  // error handling
  xhr.addEventListener("error", function (error) {
    console.error("ERROR: " + error);
  });
  // send request
  xhr.send(JSON.stringify(testJson));
}
