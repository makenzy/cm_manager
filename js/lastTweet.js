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
    element.innerHTML = dateT+"=>"+tStamp;}
    else { element.innerHTML = "Jamais"}
}
