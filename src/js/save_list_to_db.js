/* save list state
 *  brief: save list state to database
 */
// when save button is clicked
saveButton.addEventListener("click", () => {
  sendDoneItemToDB(doneList, listItems);
});
/* send done list to DB */
function sendDoneItemToDB(listEle, listItems) {
  const listChildren = Array.from(listEle.children);
  listChildren.forEach((listItem) => {
    const listItem = findListItemByName(listItem.textContent, listItems);
    sendListItemToDB(listItem);
  });
  //var listItem = findListItemByName(listItemEle.innerText, listItems); // reference to element in listItems
}
/* using Fetch API to make request to server */
function sendListItemToDB(listItem) {
  fetch("src/php/addItemToDB.php", {
    method: "POST",
    body: JSON.stringify(listItem),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      return response.text();
    })
    /* below is enacted on the returned response.text() */
    .then((text) => console.log(`RESPONSE: ${text}`))
    .catch((error) => console.error(`ERROR: ${error}`));
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
