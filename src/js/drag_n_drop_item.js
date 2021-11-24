/* drag n drop items
*  brief: allow .list-items to be dragged and dropped between .lists
*/
/* add dragging event listeners to list-items */
// when list-item is picked up
addGlobalEventListener('dragstart', '.list-item', e =>{
    e.target.classList.add('dragging');
    // if removed from doing list add entry to end time paired with start time
    const listItemEle = document.querySelector('.dragging'); // reference to currently held element
    var listItem = findListItemByName(listItemEle.innerText, listItems); // reference to element in listItems
    const list = listItem.list; // list when element was picked up
    console.log(`list item (${listItem['item-name']}) picked from "${list}"`);
    if(list == doingList.id){ // if picked from doing list do...
        let timeStamps = listItem['time-stamps']; // current timeStamps
        //console.log(`timeStampsBefore:${JSON.stringify([...timeStamps])}`); // DEBUG POINT
        // if timeStamps is undefined or empty, add new timeStamp
        if(isValueUndefined(timeStamps) || timeStamps.length == 0){return;}
        // remove the last value out of timeStamps, and set timeStamp equal to it
        const timeStamp = timeStamps.pop();
        // if min time has passed, then add endTime to timeStamp and append to the end of timeStamps
        if(Math.abs((currentTime() - timeStamp.startTime)) > MIN_TIME_IN_LIST){
            timeStamp.endTime = currentTime();
            timeStamps.push(timeStamp);
        }
        //console.log(`timeStampsAfter:${JSON.stringify([...timeStamps])}`); // DEBUG POINT
        listItem['time-stamps'] = timeStamps;
    }
});
// when list-item is dropped
addGlobalEventListener('dragend', '.list-item', e =>{
    // if added to doing list add entry to start time
    const listItemEle = document.querySelector('.dragging');
    var listItem = findListItemByName(listItemEle.innerText, listItems);
    const list = listItem.list;
    console.log(`list item (${listItem['item-name']}) dropped into "${list}"`);
    if(list == doingList.id){ // if dropped into doing list do...
        let timeStamps = listItem['time-stamps']; // current timeStamps
        //console.log(`timeStampsBefore:${JSON.stringify([...timeStamps])}`); // DEBUG POINT
        // if timeStamps is undefined or empty, set to [new timeStamp]
        if(isValueUndefined(timeStamps) || isValueUndefined(timeStamps[0]) || timeStamps.length == 0){
            const timeStamp = {'startTime': currentTime(), 'endTime' : null};
            timeStamps = [timeStamp];
            console.log('timeStamps was empty, timeStamp added');
        }
        else{
            // remove the last value out of timeStamps, and set timeStamp equal to it
            let timeStamp = timeStamps.pop();
            //console.log("lastTimeStamp:" + JSON.stringify(timeStamp)); // DEBUG POINT
            // if endTime is null dont add new timeStamp entry
            if(timeStamp.endTime != null){
                timeStamps.push(timeStamp);
                timeStamp = {'startTime': currentTime(), 'endTime' : null};
                console.log('endTime was not null, new timeStamp generated');
            }
            timeStamps.push(timeStamp);
        }
        //console.log(`timeStampsAfter:${JSON.stringify([...timeStamps])}`); // DEBUG POINT
        listItem['time-stamps'] = timeStamps;
    }
    e.target.classList.remove('dragging');
});
/* iterate lists and decide where to add held list item */
lists.forEach(list => {
    list.addEventListener('dragover', e => {
        const noItemsInlist = list.children.length
        if (isListFull(list)) {return}; // guard clause so lists dont exceed list limit
        e.preventDefault(); /* default doesnt allow items to be dropped on dragover */
        const afterElement = getItemAfterHeldItem(list, e.clientY);
        const listItemEle = document.querySelector('.dragging');
        var listItem = findListItemByName(listItemEle.innerText, listItems);
        if(listItem.list != list.id ){
            // may need some robustness for findListItemByName
            changeListOnListItem(list, listItem);
        }
        /* if no element after held item append to list */
        if(afterElement == null)
        {
            list.appendChild(listItemEle);
        }
        /* else insert element before element after held item */
        else 
        {
            list.insertBefore(listItemEle, afterElement);
        }
    })
})
/*  get list item after held list item from hovered list 
        inputs: current hovered list, cursor Y position
        outputs: list item closest to cursor Y position
*/
function getItemAfterHeldItem(list, y) {
    /* get draggable list items, ignore elements with .draggin  */
    const draggableListItems = [...list.querySelectorAll('.list-item:not(.dragging)')];
    /* reduce: loop through array and delete values as you go */
    return draggableListItems.reduce((closest, listItem) => {
        /* get div bounds for list item */
        const box = listItem.getBoundingClientRect();
        /* calculate the center of items inside list */
        const offset = y - (box.top + (box.height / 2));
        /* if offset is negative && offset is greater than current closest item */
        if (offset < 0 && offset > closest.offset)
        {
            /* return object with offset to closest for next iteration
            and closest list item to closest */
            return { offset: offset, listItem: listItem }
        }
        else 
        {
            /* return closest */
            return closest
        }
    }, {offset: Number.NEGATIVE_INFINITY }) /* initialise offset with max negative number */
    .listItem; /* return only listItem, not offset */
}