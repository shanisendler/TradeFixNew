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
		
		$data = $_REQUEST;
	
		$name = $data["name"] ?? null;
        $phone = $data["phone"] ?? null;
		
		if (!$name || !$phone) {
			echo json_encode(["success" => false, "message" => "יש להזין שם וטלפון"]);
			exit;
		}
		
		$otp_code = rand(100000, 999999); // צירת קוד רנדומלי
	
		$session_id = uniqid(); // מזהה ייחודי
		
		//var_dump($session_id);exit;
		
		$otp->setOtp($session_id, $phone, $otp_code);
		
		echo json_encode(["success" => true, "session_id" => $session_id]);
		
	}

	function verifyOtp()
	{

		global $otp;
		
		$data = $_REQUEST; //json_decode(file_get_contents("php://input"), true);
        $phone = $data["phone"];
        $otp_code = $data["otp"];
        $session_id = $data["session_id"];

		$res = $otp->verifyOtp($session_id, $phone, $otp_code);

		echo $res;
	}


	
}
