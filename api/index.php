<script src="../../js/twitterFetcher"></script>
<?php
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$screenN = $request[0];
$input = json_decode(file_get_contents('php://input'),true);
 
echo ' <script>
var configProfile = {"profile": {"screenName": "'.$screenN.'"},
    "domId": "exampleProfile","maxTweets": 1,
    "enableLinks": false,"showUser": false,
    "showTime": true,"showImages": false,
    "dataOnly": true,"customCallback": populateTpl,
    "lang": "fr","showInteraction": false
};
twitterFetcher.fetch(configProfile);
function populateTpl(tweets){
    var element = document.getElementById("lastTweet");
    if (tweets.length !== 0) {
    var html = tweets[0]["timestamp"];
    var dateT = new Date(html);
    var tStamp = Date.parse(html);
    dateT = dateT.toLocaleString();
    element.innerHTML = tStamp;
    }
    else { element.innerHTML = "Jamais"}
}
</script>';

 function getLastTweet() {
    echo '<div id="lastTweet"></div>';
}

ob_start();
getLastTweet();
 $result = ob_get_contents();
ob_get_clean();


if ($result !== "Jamais"){
     $timestamp = $result;
   echo $timestamp = substr($result, 0, -3);
} else {
    $timestamp = "0";
}




 


//   http_response_code(404);



// if ($method == 'GET') {
//   echo '[';
echo json_encode($timestamp);
//   echo ']';


?>