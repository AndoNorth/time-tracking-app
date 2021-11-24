/* save list state
*  brief: save list state to database
*/
// when save button is clicked
saveButton.addEventListener('click', () => { saveListItemsToLS(); });
/* using Fetch API to make request to server */
function saveListStateFetch(){
    let itemName = document.getElementsByClassName('.form-name').value;
    const testJson = { firstName: "Bob", lastName: "Kong", age: 50};
    fetch('src/php/connectToDB.php', {
        method: 'POST',
        body: JSON.stringify(testJson),
        headers: {
            'Content-Type' : 'application/json'
        }
    })
    .then(response => { return response.text(); })
    /* below is enacted on the returned response.text() */
    .then((text) => console.log('RESPONSE: ' + text))
    .catch(error => console.error('ERROR: ' + error));
}
/* save list items to local storage */
function saveListItemsToLS(){
    localStorage.setItem('listItems', JSON.stringify(listItems));
    console.log('listItems saved to local storage');
}
/* save list items to session storage */
function saveListItemsToSS(){
    sessionStorage.setItem('listItems', JSON.stringify(listItems));
    console.log('listItems saved to session storage');
}