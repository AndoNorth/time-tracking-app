/* save list state
*  brief: save list state to database
*/
saveButton.addEventListener('click', () => { saveListStateFetch(); })

/* using Fetch API to make request to server */
function saveListStateFetch(){
    let itemName = document.getElementsByClassName('.form-name').value;
    const testJson = { firstName: "Bob", lastName: "Kong"};
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

/* test asynchronous request/response APIs */
const testJson = { firstName: "Bob", lastName: "Kong"};
/* using Fetch API to make request to server */
function testFetchAPI(){
    console.log('POST(Fetch): ' + JSON.stringify(testJson))
    fetch('src/php/receive.php', {
        method: 'POST',
        body: JSON.stringify(testJson),
        headers: {
            'Content-Type' : 'application/json'
        }
    })
    .then(response => { return response.text(); /* returns text of response, can be replaced with .json() */ })
    /* below is enacted on the returned response.text() */
    .then((text) => console.log('RESPONSE: ' + text))
    .catch(error => console.error('ERROR: ' + error));
}
/* using AJAX API to make request to server */
function testAJAXAPI(){
    console.log('POST(Fetch): ' + JSON.stringify(testJson))
	const xhr = new XMLHttpRequest();
	
	xhr.open('POST', 'src/php/receive.php');
	xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(testJson));
}
