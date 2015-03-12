				<form id="searchBig" name="searchBig" action="/process/search.php" method="post">
                    <input type="text" name="bigSearchInput" id="bigSearchInput" placeholder="Search It's Christmas... " value="<?php if (isset($search)){ echo $search; } ?>" />
                    <input type="image" name="bigSearchImage" id="bigSearchImage" src="/images/icon/big-search.png" alt="Search" />
                </form>