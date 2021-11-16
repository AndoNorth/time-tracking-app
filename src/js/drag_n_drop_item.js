/* 
    drag n drop items
    brief: this script lets users drag and drop list items between lists
*/
const listItems = document.querySelectorAll('.list-item')
const lists = document.querySelectorAll('.list')

/* add dragging event listeners to list items */
listItems.forEach(listItem => {
    /* add dragging class to list item is picked up */
    listItem.addEventListener('dragstart', () => {
        listItem.classList.add('dragging');
    });
    /* remove dragging class from list item is dropped */
    listItem.addEventListener('dragend', () => {
        listItem.classList.remove('dragging');
    });
})

/* iterate lists and decide where to add held list item */
lists.forEach(list => {
    list.addEventListener('dragover', e => {
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
        outputs: 
*/
function getItemAfterHeldItem(list, y) {
    /* get draggable list items, ignore elements with .draggin  */
    const draggableListItems = [...list.querySelectorAll('.list-item:not(.draggin)')];
    /* reduce array to one value */
    draggableListItems.reduce((closest, child) => {
        /* get div bounds for child */
        const box = child.getBoundingClientRect();
        /* calculate the center of items inside list */
        const offset = y - box.top - (box.height / 2); /* when below neg values, when above pos values */
        /* if offset is negative && offset is greater negative than current closest item */
        if (offset < 0 && offset > closest.offset)
        {
            /* */
            return { offset: offset, element: child }
        }
        else 
        {
            /* previous closest */
            return closest
        }
    }, {offset: Number.NEGATIVE_INFINITY }); /* initialise offset with max negative number */
}