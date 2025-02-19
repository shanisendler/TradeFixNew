<?php

/**
 * Car Model 
 */

class OtpModel
{


  function setOtp($session_id, $phone, $otp)
  {

    global $db;

    try {

      // שמירת ה-OTP בטבלה זמנית
      $query = $db->prepare("INSERT INTO otp_codes (session_id, phone, otp) VALUES (?, ?, ?)");
      $query->execute([$session_id, $phone, $otp]);

      echo json_encode(["success" => true, "message" => "OTP נשמר בהצלחה"]);
    } catch (PDOException $e) {
      // טיפול בשגיאה – הדפסת השגיאה עם פרטי השגיאה
      echo json_encode([
        "success" => false,
        "message" => "שגיאה בשמירת ה-OTP: " . $e->getMessage()
      ]);

      die();
    }

  }


  function verifyOtp($session_id, $phone, $otp)
  {

    global $db;

    // בדיקה שה-OTP נכון
    $stmt = $db->prepare("SELECT * FROM otp_codes WHERE session_id = ? AND phone = ? AND otp = ? AND insert_date > NOW() - INTERVAL 10 MINUTE");
    $stmt->execute([$session_id, $phone, $otp]);

    if ($stmt->rowCount() === 0) {
      return json_encode(["success" => false, "message" => "OTP שגוי או פג תוקף"]);
      //exit;
    }

    // מחיקת ה-OTP לאחר השימוש
    $db->prepare("DELETE FROM otp_codes WHERE session_id = ?")->execute([$session_id]);

    // הוספת המשתמש למסד הנתונים
    //$conn->prepare("INSERT INTO users (name, phone, created_at) VALUES (?, ?, NOW())")->execute([$data["name"], $phone]);

    return json_encode(["success" => true]);

  }


}
