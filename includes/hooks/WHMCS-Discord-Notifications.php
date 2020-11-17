<?php

///////////////////////// Provided For Free By /////////////////////////
//                                                                    //
//            PrimeNodes - Premium Infrastructure Provider            //
//                William Phillips - MetallicGloss.com                //
//                                                                    //
////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////
////////////////////////// Configuration Area //////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below variables to allow the script to work correct and connect to both your WHMCS install and Discord channel.
// NOTE: Be careful not to accidentily remove any of the " characters when copying and pasting details into the script.

// Your Discord WebHook URL.
$GLOBALS['discordWebHookURL'] = "";
// Note: Please be aware that the channel that you select when creating the web hook will be where the messages are sent.

// Your WHMCS Admin URL.
$GLOBALS['whmcsAdminURL'] = "";
// Note: Please include the end / on your URL. An example of an accepted link would be: https://account.whmcs.com/admin/

// Your Company Name.
$GLOBALS['companyName'] = "";
// Note: This will be the name of the user that sends the message in the Discord channel.

// Discord Message Color
$GLOBALS['discordColor'] = hexdec("");
// Note: The color code format within this script is standard hex. Exclude the beginning # character if one is present.

// Discord Group ID Notification
$GLOBALS['discordGroupID'] = "";
// Note: If you'd like to have a specific group pinged on each message, please place the ID here. An example of a group ID is: <@&343029528563548162>

// Discord Avatar Dynamic Image
$GLOBALS['discordWebHookAvatar'] = "";
// (OPTIONAL SETTING) Your desired Webhook Avatar. Please make sure you enter a direct link to the image (E.G. https://example.com/iownpaypal.png ).


///////////////////////////////////////////////////////////////////////
////////////////////////// Notification Area //////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below notification settings to meet the requirements of your team and what you wish to send to the Discord channel.
// true = Notification enabled.
// false = Notification disabled.

// Ticket Notifications
$ticketOpened = true;               // New Ticket Opened Notification
$ticketUserReply = true;            // Ticket User Reply Received Notification
$ticketFlagged = true;              // Ticket Flagged To Staff Member Notification
$ticketNewNote = true;              // New Note Added To Ticket Notification

// Invoice Notifications
$invoicePaid = false;               // Invoice Paid Notification
$invoiceRefunded = false;           // Invoice Refunded Notification
$invoiceLateFee = false;            // Invoice Late Fee Notification

// Order Notifications
$pendingOrder = true;               // Order Set to Pending Notification
$orderPaid = true;                  // Order Paid Notification
$orderAccepted = false;             // Order Accepted Notification
$orderCancelled = false;            // Order Cancelled Notification
$orderCancelledRefunded = false;    // Order Cancelled & Refunded Notification
$orderFraud = false;                // Order Marked As Fraud Notification

// Network Issue Notifications
$networkIssueAdd = true;            // New Network Issue Added Notification
$networkIssueEdit = true;           // Network Issue Edited Notification
$networkIssueClosed = true;         // Network Issue Closed Notification

// Miscellaneous Notifications
$cancellationRequest = false;       // New Cancellation Request Received Notification



///////////////////////////////////////////////////////////////////////
////////  Don't edit below unless you know what you're doing.   ///////
///////////////////////////////////////////////////////////////////////

if($invoicePaid === true):
	add_hook('InvoicePaid', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'] . ' Has Been Paid',
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Paid'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;
		
if($invoiceRefunded === true):
	add_hook('InvoiceRefunded', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'] . ' Has Been Refunded',
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Refunded'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($invoiceLateFee === true):
	add_hook('AddInvoiceLateFee', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'] . ' Has Had A Late Fee Added',
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Late Fee Added'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($orderAccepted === true):
	add_hook('AcceptOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Accepted',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Accepted'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($orderCancelled === true):
	add_hook('CancelOrder', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Cancelled',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Cancelled'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($orderCancelledRefunded === true):
	add_hook('CancelAndRefundOrder', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Cancelled & Refunded',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Cancelled & Refunded'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($orderFraud === true):
	add_hook('FraudOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Marked As Fraudulent',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Marked As Fraud'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($orderPaid === true):
	add_hook('OrderPaid', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Paid',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Has been Paid'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($pendingOrder === true):
	add_hook('PendingOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Set to Pending',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Was Marked as Pending'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($networkIssueAdd === true):
	add_hook('NetworkIssueAdd', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A New Network Issue Has Been Created',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => simpleFix($vars['description']),
					'color' => $GLOBALS['discordColor'],
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
							'value' => simpleFix($vars['title']),
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
endif; 

if($networkIssueEdit === true):
	add_hook('NetworkIssueEdit', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Network Issue Has Been Edited',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => simpleFix($vars['description']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Network Issue Edited'
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
							'value' => simpleFix($vars['title']),
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
endif; 

if($networkIssueClosed === true):
	add_hook('NetworkIssueClose', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Network Issue Has Been Closed',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Network Issue Closed'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($ticketOpened === true):
	add_hook('TicketOpen', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => '#' . $vars['ticketmask'] . ' - ' . simpleFix($vars['subject']),
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => simpleFix($vars['message']),
					'color' => $GLOBALS['discordColor'],
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
							'value' => '#' . $vars['ticketmask'],
							'inline' => true
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($ticketUserReply === true):
	add_hook('TicketUserReply', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => simpleFix($vars['subject']),
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => simpleFix($vars['message']),
					'color' => $GLOBALS['discordColor'],
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
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($ticketFlagged === true):
	add_hook('TicketFlagged', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A ticket has been flagged to ' . $vars['adminname'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Flagged'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($ticketNewNote === true):
	add_hook('TicketAddNote', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Ticket Note Has Been Added',
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => simpleFix($vars['message']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Note Added'
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

if($cancellationRequest === true):
	add_hook('CancellationRequest', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Cancellation Request Has Been Received',
					'url' => $GLOBALS['whmcsAdminURL'] . 'cancelrequests.php',
					'timestamp' => date(DateTime::ISO8601),
					'description' => simpleFix($vars['reason']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'New Cancellation Request'
					),
					'fields' => array(
						array(
							'name' => 'Cancellation Type',
							'value' => $vars['type'],
							'inline' => true
						)
					)
				)
			)
		);
		processNotification($dataPacket);
	});
endif;

function processNotification($dataPacket)	{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['discordWebHookURL']);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataPacket));
    $output = curl_exec($curl);
    $output = json_decode($output, true);
	
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
        logModuleCall('Discord Notifications', 'Notification Sending Failed', json_encode($dataPacket), print_r($output, true));
    } else {
		logModuleCall('Discord Notifications', 'Notification Successfully Sent', json_encode($dataPacket), print_r($output, true));
	}
	
    curl_close($curl);
}

function simpleFix($value){
	if(strlen($value) > 150) {
		$value = trim(preg_replace('/\s+/', ' ', $value));
		$valueTrim = explode( "\n", wordwrap( $value, 150));
		$value = $valueTrim[0] . '...';
	}
	$value = mb_convert_encoding($value, "UTF-8", "HTML-ENTITIES"); // Allows special characters to be displayed on Discord.
	return $value;
}

?>
