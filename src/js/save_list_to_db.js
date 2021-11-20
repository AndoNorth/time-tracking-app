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
const uri = 'src/php/receive.php';
/* using Fetch API to make request to server */
function testFetchAPI(){
    console.log('POST(Fetch): ' + JSON.stringify(testJson))
    fetch(uri, {
        method: 'POST',
        body: JSON.stringify(testJson),
        headers: {
            'Content-Type' : 'application/json'
        }
    })
    // handle response from the server
    .then(response => { 
        if(response.status == 200){
            return response.text(); // can be .json()
        }else{
            throw new Error('Error Message');
        }
    })
    .then((text) => console.log('RESPONSE: ' + text))
    // error handling
    .catch(error => console.error('ERROR: ' + error.message));
}

/* using AJAX API to make request to server */
function testAJAXAPI(){
    console.log('POST(Fetch): ' + JSON.stringify(testJson))
	const xhr = new XMLHttpRequest();
	// open request - method, uri, is request asynchronous (default=true)
	xhr.open('POST', uri, true);
	xhr.setRequestHeader("Content-Type", "application/json");
    // handle the response from the server
    xhr.addEventListener('load',function(response){
        var data = response.responseTest; // or responseXML
        var text = JSON.parse(data); // JSON object
        console.log('RESPONSE: ' + text);
    });
    // error handling
    xhr.addEventListener('error', function(error){
        console.error('ERROR: ' + error);
    })
    // send request
    xhr.send(JSON.stringify(testJson));
}