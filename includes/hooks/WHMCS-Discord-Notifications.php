<?php

	//////// Configuration Area ////////
	
	$discordWebHookURL = ""; // Your Discord WebHook URL. 	
	// Please be aware that the channel which you select to create the web hook is the channel which will be used for sending messages.
	
	$whmcsAdminURL = ""; // Your WHMCS Admin URL.
	// Please include the end / on your URL. An example of an accepted link would be: https://account.whmcs.com/admin/
	
	$companyName = ""; // Your Company Name
	// This will be the name of the user which sends the messages.

	$discordGroupID = ""; // Discord Group ID Config Option
	// If you wished for each message which is sent to ping a specific group, please place the ID here. An example of a group ID is: @&343029528563548162
	
	//////// End Of Configuration Area ////////
		
	add_hook('TicketOpen', 1, function($vars) {
		$dataPacket = array(
			if (isset($discordGroupID)) {
				'content' => $discordGroupID,
			}
			'username' => $companyName,
			'embeds' => array(
				array(
					'title' => $vars['subject'],
					'url' => $whmcsAdminURL . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Support Ticket',
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true,
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true,
						),
						array(
							'name' => 'Ticket ID',
							'value' => $vars['ticketid'],
							'inline' => true,
						)
					),
				)
			),
		);
		$dataString = json_encode($dataPacket);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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
	});
	
	add_hook('TicketUserReply', 1, function($vars) {
		$dataPacket = array(
			if (isset($discordGroupID)) {
				'content' => $discordGroupID,
			}
			'username' => $companyName,
			'embeds' => array(
				array(
					'title' => $vars['subject'],
					'url' => $whmcsAdminURL . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Ticket Reply',
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true,
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true,
						),
						array(
							'name' => 'Ticket ID',
							'value' => $vars['ticketid'],
							'inline' => true,
						)
					),
				)
			),
		);
		$dataString = json_encode($dataPacket);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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
	});
	
	add_hook('PendingOrder', 1, function($vars) {
		$dataPacket = array(
			if (isset($discordGroupID)) {
				'content' => $discordGroupID,
			}
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Pending Order',
					),
				)
			),
		);
		$dataString = json_encode($dataPacket);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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
	});
	
	add_hook('AcceptOrder', 1, function($vars) {
		$dataPacket = array(
			if (isset($discordGroupID)) {
				'content' => $discordGroupID,
			}
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'New Accepted Order',
					),
				)
			),
		);
		$dataString = json_encode($dataPacket);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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
	});
	
	add_hook('FraudOrder', 1, function($vars) {
		$dataPacket = array(
			if (isset($discordGroupID)) {
				'content' => $discordGroupID,
			}
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => '5653183',
					'author' => array(
						'name' => 'Order Marked As Fraud',
					),
				)
			),
		);
		$dataString = json_encode($dataPacket);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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
	});
	
	add_hook('CancellationRequest', 1, function($vars) {
		$dataPacket = array(
			if (isset($discordGroupID)) {
				'content' => $discordGroupID,
			}
			'username' => $companyName,
			'embeds' => array(
				array(
					'url' => $whmcsAdminURL . 'cancelrequests.php',
					'timestamp' => date(DateTime::ISO8601),
					'description' => $vars['reason'],
					'color' => '5653183',
					'author' => array(
						'name' => 'New Cancellation Request',
					),
					'fields' => array(
						array(
							'name' => 'Product ID',
							'value' => $vars['relid'],
							'inline' => true,
						),
						array(
							'name' => 'Cancellation Type',
							'value' => $vars['type'],
							'inline' => true,
						),
						array(
							'name' => 'User ID',
							'value' => $vars['userid'],
							'inline' => true,
						)
					),
				)
			),
		);
		$dataString = json_encode($dataPacket);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $discordWebHookURL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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
	});
?>