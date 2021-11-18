/* save list state
*  brief: save list state to database
*/

const testJson = { firstName: "Bob", lastName: "Kong"};

saveButton.addEventListener('click', () => { saveListStateFetch(); })

/* using Fetch API to make request to server */
/* TODO: convert this to an async await */
function saveListStateFetch(){
    console.log('POST(Fetch): ' + JSON.stringify(testJson))
    fetch('src/php/receive.php', {
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

loadButton.addEventListener('click', () => { saveListStateAJAX(); })
/* using AJAX API to make request to server */
function saveListStateAJAX(){
    console.log('POST(Fetch): ' + JSON.stringify(testJson))
	const xhr = new XMLHttpRequest();
	
	xhr.open('POST', 'src/php/receive.php');
	xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(testJson));
}
