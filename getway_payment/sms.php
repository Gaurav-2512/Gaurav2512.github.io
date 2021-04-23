<?php
    if(isset($_POST['submit'])){
        $mobile = '91'.$_POST['mobile'];
        $massage = $_POST['massage'];

        $apiKey = urlencode('YzFmOWJhYTFlOTc0MWE2OWJmMTgxYTU2MjYyMzY2YWM=');
        $numbers = array($mobile);
        $sender = urlencode('TXTLCL');
        $message = rawurlencode($massage);
        $numbers = implode(',', $numbers);
         
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Massage Gateway</title>
</head>
<body>
    <form method="post">
        <label>Mobile</label>
        <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile No"><br><br>
        <label>Massage</label>
        <input type="text" name="massage" id="massage" placeholder="Enter Massage"><br><br>
        <input type="submit" name="submit" value="Send Massage"> 
    </form>
</body>
</html>