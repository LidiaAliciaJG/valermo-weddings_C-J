<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    echo "There was a problem with your submission, please try again.";
} else {
    $party_id= $name= $email= $phone= $adultcomp= $undercomp= $adult_1= $adult_2= $adult_3= $adult_4= $adult_5= $under_1= $under_2= $under_3= $under_4 = $under_5= $message="";
    function sanitize($data) {
        if(isset($data)){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data ?? null;
        }
      }
    
    $token = $_POST['token'];
    $action = 'contact_form';
    $secret = '6Ld0Da0ZAAAAAKty2fjjTPy7i-9JAahf-CQuVNJ9';
    if(!$token){
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        exit;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secret, 'response' => $token)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);
    if($arrResponse['success'] == '1' && $arrResponse['action'] == $action && $arrResponse['score'] >= 0.5) {
        $party_id = sanitize($_POST['mpartyid']);
        $name= sanitize($_POST['mname']);
        $email= sanitize($_POST['memail']);
        $phone= sanitize($_POST['mphone']);
        $adultcomp= sanitize($_POST['mcompanionad']);
        $undercomp= sanitize($_POST['mcompanionun']);
        $adult_1= sanitize($_POST['my-companion1'] ?? null);
        $adult_2= sanitize($_POST['my-companion2'] ?? null);
        $adult_3= sanitize($_POST['my-companion3'] ?? null);
        $adult_4= sanitize($_POST['my-companion4'] ?? null);
        $adult_5= sanitize($_POST['my-companion5'] ?? null);
        $under_1= sanitize($_POST['mn-companion1'] ?? null);
        $under_2= sanitize($_POST['mn-companion2'] ?? null);
        $under_3= sanitize($_POST['mn-companion3'] ?? null);
        $under_4= sanitize($_POST['mn-companion4'] ?? null);
        $under_5= sanitize($_POST['mn-companion5'] ?? null);
        $message= sanitize($_POST['mmessage'] ?? null);
    
        // $conn = new mysqli('localhost', 'root', 'Isma2003051003', 'movaparty');
        $conn = new mysqli('localhost', 'ideas_digitales', '^$76_,di%HFJ', 'id_wedding');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO quince (party_id, mname, email, phone, adults, underages, adult_1, adult_2, adult_3, adult_4, adult_5, under_1, under_2, under_3, under_4, under_5, messages)
        VALUES ('$party_id', '$name', '$email', '$phone', '$adultcomp', '$undercomp', '$adult_1', '$adult_2', '$adult_3', '$adult_4', '$adult_5', '$under_1', '$under_2', '$under_3', '$under_4', '$under_5', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo 'success';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    };
}