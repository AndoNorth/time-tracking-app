/* load list state
*  brief: load list state from database
*/
loadButton.addEventListener('click', () => {
    loadListItemsFromLS();
    refreshListState();
    });

/* load list items from local storage */
function loadListItemsFromLS(){
    listItems = JSON.parse(localStorage.getItem('listItems'));
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