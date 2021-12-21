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
  listChildren.forEach((element) => {
    const listItem = findListItemByName(element.textContent, listItems);
    sendListItemToDB(listItem, listItems);
  });
  //var listItem = findListItemByName(listItemEle.innerText, listItems); // reference to element in listItems
}
/* using Fetch API to make request to server */
function sendListItemToDB(listItem, listItems) {
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
    .then((text) => {
      console.log(`RESPONSE: ${text}`);
      // if successful remove listItem from listItems
      const index = listItems.indexOf(listItem);
      if (index > -1) {
        listItems.splice(index, 1);
      }
      refreshListState();
    })
    .catch((error) => {
      console.error(`ERROR: ${error}`);
    });
  return listItems;
}
