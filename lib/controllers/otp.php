<?php

/**
 * Otp Controller
 *
 */

class Otp
{

	function sendOtp()
	{
		
		$data = json_decode(file_get_contents("php://input"), true);
		$name = $data["name"];
		$phone = $data["phone"];
		
		if (!$name || !$phone) {
			echo json_encode(["success" => false, "message" => "יש להזין שם וטלפון"]);
			exit;
		}
		
		$otp = rand(100000, 999999); // יצירת קוד רנדומלי
		$session_id = uniqid(); // מזהה ייחודי

		
		
		
		
	}


	
}
