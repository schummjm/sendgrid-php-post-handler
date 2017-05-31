<?php

require("sendgrid-php/sendgrid-php.php");

// Add your Sendgrid API Key
$apiKey = 'SENDGRID_API_KEY';
$sg = new \SendGrid($apiKey);

// Collect in POST data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$listId = $_POST['listId'];

// Add Contact
$request_body = json_decode('[
  {
    "email": "'.$email.'",
    "first_name": "'.$firstName.'",
    "last_name": "'.$lastName.'"
  }
]');
$response = $sg->client->contactdb()->recipients()->post($request_body);
$responseData = $response->body();
$responseObject = json_decode($responseData);
$recipientId = $responseObject->persisted_recipients[0];

// Add Contact to List
$list_id = $listId;
$recipient_id = $recipientId;
$response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->_($recipient_id)->post();

?>
