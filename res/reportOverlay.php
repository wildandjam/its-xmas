<div id="reportOverlay">
    <div id="reportBox">
        <h3>Report Post</h3>
        <?php if (isset($xID)) { ?>
            <form id="reportForm" name="reportForm" method="post" action="/process/reportPost.php">
                <p>Please explain why you are reporting this post:</p>
                 <textarea type="text" name="reasonReport" id="reasonReport" placeholder="Reason for reporting"></textarea>
                 <input type="hidden" id="reporterID" name="reporterID" value="<?php if (isset($xUser) && $xUser === true){echo $xID;} ?>"/>
                 <input type="hidden" id="reportedPost" name="reportedPost" value=""/>
                 <input type="hidden" id="reportedPoster" name="reportedPoster"  />
                 <input type="hidden" id="reportFrom" name="reportFrom" value="<?php echo $_SERVER["REQUEST_URI"]; ?>" />
                 <button>Report</button>
            </form>
        <? } else { ?>
            <p>Please <a href='/login/'>log in</a> or <a href='/register/'>register</a> to report any issues.
        <?php } ?>
        <div class="reportClose">
            Close
        </div>
    </div>
</div>