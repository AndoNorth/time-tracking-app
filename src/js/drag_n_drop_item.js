/* drag n drop items
*  brief: allow .list-items to be dragged and dropped between .lists
*/

/* add dragging event listeners to list-items */
addGlobalEventListener('dragstart', '.list-item', e =>{
    e.target.classList.add('dragging')
})
addGlobalEventListener('dragend', '.list-item', e =>{
    e.target.classList.remove('dragging')
})

/* iterate lists and decide where to add held list item */
lists.forEach(list => {
    list.addEventListener('dragover', e => {
        const noItemsInlist = list.children.length
        if (noItemsInlist >= MAX_NO_LIST_ITEMS_PER_LIST) {return}; // guard clause so lists dont exceed lsit limit
        e.preventDefault(); /* default doesnt allow items to be dropped on dragover */
        const afterElement = getItemAfterHeldItem(list, e.clientY);
        const listItem = document.querySelector('.dragging');
        /* if no element after held item append to list */
        if(afterElement == null)
        {
            list.appendChild(listItem);
        }
        /* else insert element before element after held item */
        else 
        {
            list.insertBefore(listItem, afterElement);
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