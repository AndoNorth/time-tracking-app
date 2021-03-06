/* load list state
 *  brief: load list state from database
 */
// when load button is clicked
loadButton.addEventListener("click", () => {
  loadListItemsFromLS();
  refreshListState();
});
/* using Fetch API to make request to server */
function loadListStateFetch() {
  let itemName = document.getElementsByClassName(".form-name").value;
  const testJson = { firstName: "Bob", lastName: "Kong", age: 50 };
  fetch("src/php/loadFromDB.php", {
    method: "POST",
    body: JSON.stringify(testJson),
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
