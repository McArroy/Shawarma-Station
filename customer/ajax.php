<?php

if (isset($_GET["method"]))
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://shawarma-station-admin.rf.gd/menu/get");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	$output = curl_exec($ch);

	// Check for cURL errors
	if (curl_errno($ch))
	{
		echo "cURL error: " . curl_error($ch);
	}
	else
	{
		// Check if the output is a valid JSON string
		$decodedData = json_decode($output, true);

		if ($decodedData !== null)
		{
			// If valid JSON, return the JSON data with the proper header
			header("Content-Type: application/json");
			echo json_encode($decodedData);
		}
		else
		{
			echo "Invalid JSON response.";
		}
	}

	curl_close($ch);
}

?>