/* load list state
*  brief: load list state from database
*/
// when load button is clicked
loadButton.addEventListener('click', () => {
    loadListItemsFromLS();
    refreshListState();
    });
/* load list items from local storage */
function loadListItemsFromLS(){
    listItems = JSON.parse(localStorage.getItem('listItems'));
    // listItems.forEach(listItem => {
    //     const timeStamps = listItem['time-stamps'];
    //     if(isValueUndefined(timeStamps)){ return; }
    //     timeStamps.forEach(timeStamp =>{
    //         Object.keys(timeStamp).forEach(key => {
    //             Date.parse(datetime);
    //         });
    //     });
    // });
    console.log('listItems loaded from local storage');
}
/* load list items from session storage */
function loadListItemsFromSS(){
    listItems = JSON.parse(sessionStorage.getItem('listItems'));
    console.log('listItems loaded from session storage');
}
/* refresh list state */
function refreshListState(){
    // remove all child elements (list-item s)
    lists.forEach(list => {
        list.innerHTML = `${list.id.replace('-',' ')}`;
    });
    listItems.forEach(item => {
        tarList = document.getElementById(item['list']);
        addListItemEleToList(tarList, item);
    })
}