<?php

// Load the iContact library
require_once('iContactApi.php');

// Give the API your information
$appId = 'wlqLNKTB97n5uda3jVBX5sTFcnHaDUX0';
$apiPassword = 'DamGapStudios';
$apiUsername = 'julia@mathesontravel.com-beta';
$accountID = '415542';
$clientFolderID = '126975';

//Data
$firstName  = $_POST['firstName'];
$email = $_POST['email'];

iContactApi::getInstance()
	->useSandbox(true)   // true use Icontact Sandbox ; false use official icontact 
	->setConfig(array(
	'appId'       => $appId, 
	'apiPassword' => $apiPassword, 
	'apiUsername' => $apiUsername
));

$oiContact = iContactApi::getInstance();
try{

	var_dump($oiContact->addContact($email, null, null, $firstName, null, null, null, null, null, null, null, null, null, null));
	
	// $sFileData = file_get_contents('/path/to/file.csv');  // Read the file
	// var_dump($oiContact->uploadData($sFileData, 179962)); // Send the data to the API
	
} catch (Exception $oException) { // Catch any exceptions
	// Dump errors
	var_dump($oiContact->getErrors());
	// Grab the last raw request data
	var_dump($oiContact->getLastRequest());
	// Grab the last raw response data
	var_dump($oiContact->getLastResponse());
}

