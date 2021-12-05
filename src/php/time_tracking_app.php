            <div class="lists">
                <div class="doing-list list" id="doing-list">
                    doing list
                </div>
                <div class="todo-list list" id="todo-list">
                    todo list
                </div>
                <div class="done-list list" id="done-list">
                    done list
                </div>
            </div>
            <div class="menu">
                <div class="buttons">
                    <div class="save-button button">save button</div>
                    <div class="load-button button">load button</div>
                    <div class="create-item-button button">create new item</div>
                </div>
                <div class="new-item-form">
                    <form action="#" id="new-item-form">
                        <fieldset>
                            <legend>New Item Details</legend>
                            <label for="form-item-name">Name</label>
                            <input type="text" id="form-item-name" name="item-name" placeholder="Enter Item Name" value="">
                            <fieldset>
                                <legend>Tags</legend>
                                <input type="radio" id="form-tag-work" name="tag" value="Work">
                                <label for="form-tag-work">Work</label>
                                <input type="radio" id="form-tag-leisure" name="tag" value="Leisure">
                                <label for="form-tag-leisure">Leisure</label>
                                <input type="radio" id="form-tag-errand" name="tag" value="Errand">
                                <label for="form-tag-errand">Errand</label>
                                <br>
                                <input type="radio" id="form-tag-chilling" name="tag" value="Chilling">
                                <label for="form-tag-chilling">Chilling</label>
                                <input type="radio" id="form-tag-other" name="tag" value="Other" checked>
                                <label for="form-tag-other">Other</label>
                            </fieldset>
                            <label for="form-item-desc">Description</label>
                            <textarea 
                                form="new-item-form" name="item-desc" id="form-item-desc"
                                placeholder="Enter Item Description"
                                style="resize:none;" cols="30" rows="2" maxlength="40"></textarea>
                        </fieldset>
                    </form>
                </div>
            </div>