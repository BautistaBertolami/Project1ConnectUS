<?php
	$inData = getRequestInfo();

	$contact = $inData["contact"];
	$userId = $inData["userId"];
	$phoneNumber = $inData["phoneNumber"];
	$email = $inData["email"];

	$conn = new mysqli("localhost", "1109270", "Poosproject321", "1109270");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$sql = "INSERT into Contacts (UserId,Name,PhoneNumber,Email) VALUES ('" . $userId . "','" . $contact . "','" . $phoneNumber . "','" . $email . "')";
		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError( $conn->error );
		}
		$conn->close();
	}

	returnWithError("");

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

?>
