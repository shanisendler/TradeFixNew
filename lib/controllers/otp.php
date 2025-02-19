<?php

/**
 * Otp Controller
 *
 */

class Otp
{

	function sendOtp()
	{

		global $otp;
		
		$data = json_decode(file_get_contents("php://input"), true);
		$name = $data["name"];
		$phone = $data["phone"];
		
		if (!$name || !$phone) {
			echo json_encode(["success" => false, "message" => "יש להזין שם וטלפון"]);
			exit;
		}
		
		$otp_code = rand(100000, 999999); // יצירת קוד רנדומלי
		$session_id = uniqid(); // מזהה ייחודי
		
		$otp->setOtp($session_id, $phone, $otp_code);
		
		echo json_encode(["success" => true, "session_id" => $session_id]);
		
	}

	function verifyOtp()
	{

		global $otp;
		
		$data = json_decode(file_get_contents("php://input"), true);
        $phone = $data["phone"];
        $otp_code = $data["otp"];
        $session_id = $data["session_id"];

		$res = $otp->verifyOtp($session_id, $phone, $otp_code);

		echo $res;
	}


	
}
