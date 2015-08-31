<div id="listOverlay">
    <div id="listBox">
        <h3>Add to collection</h3>
        <?php
            if (isset($xID)){
                $listQuery = mysqli_query($connect, "SELECT * FROM collections WHERE userID = '$xID'");
                $listCount = mysqli_num_rows($listQuery);
                
                if ($listCount > 0){
                    echo "<select name=\"addToL\" id=\"addToL\">";
                    echo "<option>Select</option>";
                    while ($lrow = mysqli_fetch_array($listQuery)){
                        echo "<option value='" . $lrow['listID'] . "'>" . $lrow['listName'] . "</option>";
                    }
                    echo "</select>";
                    echo "<div class='button'>Add</div>";
					
                } else {
					echo "<p>&nbsp;</p>";
                    echo "<p class=\"errorMsg\">You do not have any collections <br /><a href=\"/member/create-collection/\">Add one?</a></p> ";
                }
            } else { ?>
                <p>Please <a href='/login/'>log in</a> or <a href='/register/'>register</a> to create your own collections.
            <?php
            }
        ?>
        <div id="currentCollections"></div>
        <div id="getOtherLists">View collections with this post</div>
        <div class="listClose">
            Close
        </div>
    </div>
    
</div>