<?php 
	date_default_timezone_set("Europe/London");
	$today = $date = date("Y-m-d H:i");
	$datetime1 = strtotime('2014-12-25 00:00');
	$datetime2 = strtotime($today);
	$interval = $datetime1-$datetime2;
	$days = floor($interval / 86400);
	$hour = floor(($interval - ($days * 86400)) / 3600);
	$minutes = floor(($interval - ($days * 86400) - ($hour * 3600))/60);
	if ($hour == 0){
		$hour = 23;	
	} else {
		$hour = $hour - 1;
	}
	$countphp = "in ";
	$countphp .= $days;
	if ($day == '1') {
		$countphp .= " day, ";
	} else {
		$countphp .= " days, ";
	}
	$countphp .= $hour;
	if ($hours == '1'){
		$countphp .= " hour and ";
	} else {
		$countphp .= " hours and ";
	}
	$countphp .= $minutes;
	if ($minutes == '1'){
		$countphp .= " minute ";
	} else {
		$countphp .= " minutes ";
	}

	switch($emailtype){
		case "forgottenpassword":
			require('process/forgottenpassword.php');
			break;
		case "register":
			require('process/register.php');
			break;
		case "report":
			require('process/report.php');
			break;
		case "reportImportant":
			require('process/reportImportant.php');
			break;
		default:
			$emailmsg = "Error";
			$errorTitle = "Error";
			break;
	}




$echoprintmsg ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>' . $emailTitle . '</title>
	<style type="text/css">
		@media only screen and (max-device-width: 600px), only screen and (max-width: 600px) {
			a[href^="tel"], a[href^="sms"] {
				text-decoration: none;
				color: black; /* or whatever your want */
				pointer-events: none;
				cursor: default;
			}
			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
				text-decoration: default;
				color: orange !important; 
				pointer-events: auto;
				cursor: default;
			}
			table, tr, td, img {width:100%!important;height:auto!important}
		}

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			a[href^="tel"], a[href^="sms"] {
				text-decoration: none;
				color: blue; 
				pointer-events: none;
				cursor: default;
			}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
				text-decoration: default;
				color: orange !important;
				pointer-events: auto;
				cursor: default;
			}
		}

		@media only screen and (-webkit-min-device-pixel-ratio: 2) {
			table, tr, td, img {width:100%!important;height:auto!important}
		}
		@media only screen and (-webkit-device-pixel-ratio:.75){
			table, tr, td, img {width:100%!important;height:auto!important}
		}
		@media only screen and (-webkit-device-pixel-ratio:1){
			table, tr, td, img {width:100%!important;height:auto!important}
		}
		@media only screen and (-webkit-device-pixel-ratio:1.5){
			table, tr, td, img {width:100%!important;height:auto!important}
		}
	</style>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;background: #f7f7f7;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;width: 100% !important;">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" bgcolor="#f7f7f7" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 0;padding: 0;width: 100% !important;line-height: 100% !important;">
		<tr>
            <td align="center" style="border-collapse: collapse;">
            	<table cellpadding="0" cellspacing="0" border="0" width="600" bgcolor="#FFFFFF" style="background: #ffffff;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width:600px;">
                	<tr>
                        <td style="border-collapse: collapse;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF" style="max-width:600px;width:100%;background: #ffffff;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td valign="top" style="border-collapse: collapse;">
                                        <a href="http://www.its-xmas.co.uk" target="_blank">
                                            <img src="http://www.its-xmas.co.uk/images/emailHeader.jpg" alt="It\'s Christmas" class="image_fix" title="It\'s Christmas" width="100%" height="150" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;display: block;height:auto!important;width:100%;max-width:600px;" />
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF" style="width:100%;background: #ffffff;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td valign="top" style="border-collapse: collapse;" align="center">
										<table width="500px" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF" style="width:500px;background: #ffffff;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
											<tr>
												<td valign="top" style="border-collapse: collapse;">
													<br>
													' . $emailmsg . '
												</td>
											</tr>
										</table>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF" style="width:100%;background: #ffffff;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td valign="top" style="border-collapse: collapse;" align="center">
										<table width="500px" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF" style="width:500px;background: #ffffff;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
											<tr>
												<td valign="top" style="border-collapse: collapse;"> 
												
												<br>
			                                       <p style="font-size:11px;line-height:19px;color:#808080;"> Pssshhhhttt - It\'s Christmas ' . $countphp . '</p>
												 <br >
												</td>
											</tr>
										</table>								
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
		</tr>
	</table>
</body>
</html>';