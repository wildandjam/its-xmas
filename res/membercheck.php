<?php
if (!isset($xID) && isset($membercheck) && $membercheck == true){
	header('location: /?error=nonmember');	
}
?>