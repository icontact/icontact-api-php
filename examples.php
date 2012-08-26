<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL);

// Load the iContact library
require_once('lib/iContactApi.php');

// Give the API your information
iContactApi::getInstance()->setConfig(array(
	'appId'       => '', 
	'apiPassword' => '', 
	'apiUsername' => ''
));

// Store the singleton
$oiContact = iContactApi::getInstance();
// Try to make the call(s)
try {
	//  are examples on how to call the  iContact PHP API class
	// Grab all contacts
	var_dump($oiContact->getContacts());
	// Grab a contact
	var_dump($oiContact->getContact(42094396));
	// Create a contact
	var_dump($oiContact->addContact('joe@shmoe.com', null, null, 'Joe', 'Shmoe', null, '123 Somewhere Ln', 'Apt 12', 'Somewhere', 'NW', '12345', '123-456-7890', '123-456-7890', null));
	// Get messages
	var_dump($oiContact->getMessages());
	// Create a list
	var_dump($oiContact->addList('somelist', 1698, true, false, false, 'Just an example list', 'Some List'));
	// Subscribe contact to list
	var_dump($oiContact->subscribeContactToList(42094396, 179962, 'normal'));
	// Move contact to another list
	var_dump($oiContact->moveSubscriptionToList("179962_42094396", 179963, 'normal'));
	// Grab all campaigns
	var_dump($oiContact->getCampaigns());
	// Create message
	var_dump($oiContact->addMessage('An Example Message', 585, '<h1>An Example Message</h1>', 'An Example Message', 'ExampleMessage', 33765, 'normal'));
	// Schedule send
	var_dump($oiContact->sendMessage(array(33765), 179962, null, null, null, mktime(12, 0, 0, 1, 1, 2012)));
	// Upload data by sending a filename (execute a PUT based on file contents)
	var_dump($oiContact->uploadData('/path/to/file.csv', 179962));
	// Upload data by sending a string of file contents
	$sFileData = file_get_contents('/path/to/file.csv');  // Read the file
	var_dump($oiContact->uploadData($sFileData, 179962)); // Send the data to the API
} catch (Exception $oException) { // Catch any exceptions
	// Dump errors
	var_dump($oiContact->getErrors());
	// Grab the last raw request data
	var_dump($oiContact->getLastRequest());
	// Grab the last raw response data
	var_dump($oiContact->getLastResponse());
}
