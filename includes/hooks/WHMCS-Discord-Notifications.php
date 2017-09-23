<?php

	//////// Configuration Information ////////
	// Unfortunately due to WHMCS hooks not allowing external inputs, values are required to defined within each hook. If this changes it will be updated!
	// I recommend using NotePad++ to mass replace all values at once.

	// $discordWebHookURL = ""; 
	// Found on line(s): 300
	// Your Discord WebHook URL. Please be aware that the channel which you select to create the web hook is the channel which will be used for sending messages.

	// $whmcsAdminURL = ""; 
	// Found on line(s): 24, 45, 66, 87, 125, 146, 199, 220, 259
	// Your WHMCS Admin URL. Please include the end / on your URL. An example of an accepted link would be: https://account.whmcs.com/admin/

	// $companyName = ""; 
	// Found on line(s): 25, 46, 67, 88, 126, 147, 200, 221, 260
	// Your Company Name. This will be the name of the user which sends the messages.

	// $discordGroupID = ""; 
	// Found on line(s): 26, 47, 68, 89, 127, 148, 201, 222, 261
	// Discord Group ID Config Option. If you wished for each message which is sent to ping a specific group, please place the ID here. An example of a group ID is: @&343029528563548162 

	add_hook('InvoicePaid', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'Invoice Payment Received'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('InvoiceRefunded', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'Invoice Refunded'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('AcceptOrder', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Accepted Order'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('CancellationRequest', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'cancelrequests.php',
					'timestamp' => date(DateTime::ISO8601),
					'description' => $vars['reason'],
					'color' => '5653183',
					'author' => array(
						'name' => 'New Cancellation Request'
					),
					'fields' => array(
						array(
							'name' => 'Product ID',
							'value' => $vars['relid'],
							'inline' => true
						),
						array(
							'name' => 'Cancellation Type',
							'value' => $vars['type'],
							'inline' => true
						),
						array(
							'name' => 'User ID',
							'value' => $vars['userid'],
							'inline' => true
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('FraudOrder', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'Order Marked As Fraud'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('NetworkIssueAdd', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'networkissues.php?action=manage&id=' . $vars['announcementid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => $vars['reason'],
					'color' => '5653183',
					'author' => array(
						'name' => 'New Network Issue'
					),
					'fields' => array(
						array(
							'name' => 'Start Date',
							'value' => $vars['startdate'],
							'inline' => true
						),
						array(
							'name' => 'End Date',
							'value' => $vars['enddate'],
							'inline' => true
						),
						array(
							'name' => 'Title',
							'value' => $vars['title'],
							'inline' => true
						),
						array(
							'name' => 'Description',
							'value' => $vars['description'],
							'inline' => true
						),
						array(
							'name' => 'Affecting',
							'value' => $vars['affecting'],
							'inline' => true
						),
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('PendingOrder', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Pending Order'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('TicketOpen', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'title' => $vars['subject'],
					'url' => $whmcsAdminURL . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Support Ticket'
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true
						),
						array(
							'name' => 'Ticket ID',
							'value' => $vars['ticketid'],
							'inline' => true
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	add_hook('TicketUserReply', 1, function($vars)	{
		$whmcsAdminURL  = ""; // Your WHMCS Admin URL.
		$companyName    = ""; // Your Company Name.
		$discordGroupID = ""; // Discord Group ID Config Option.
		$dataPacket     = array(
			'content' => $discordGroupID,
			'username' => $companyName,
			'embeds' => array(
				array(
					'title' => $vars['subject'],
					'url' => $whmcsAdminURL . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Ticket Reply'
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true
						),
						array(
							'name' => 'Ticket ID',
							'value' => $vars['ticketid'],
							'inline' => true
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
	function processNotification($dataPacket, $discordWebHookURL)	{
		$dataString        = json_encode($dataPacket);
		$curl              = curl_init();
		$discordWebHookURL = ""; // Your Discord WebHook URL
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json'
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
		$output = curl_exec($curl);
		$output = json_decode($output, true);
		if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
			echo "Failed " . curl_getinfo($curl, CURLINFO_HTTP_CODE) . "<br><br>";
			print_r($output);
		}
		curl_close($curl);
	}
?>
