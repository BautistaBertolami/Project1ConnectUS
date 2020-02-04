<?php
	$inData = getRequestInfo();


	$firstName = $inData["FirstName"];
	$lastName = $inData["LastName"];
	$login = $inData["Login"];
	$passwrod = $inData["Password"];

	$conn = new mysqli("localhost", "1109270", "Poosproject321", "1109270");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$sql = "INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('" . $firstName . "','" . $lastName . "','" . $login . "','" . $passwrod . "')";
		//$result = $conn->query($sql);
		if( $result = $conn->query($sql) != TRUE )
		{
			echo "this sucks";
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
