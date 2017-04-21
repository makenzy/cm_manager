
var configProfile = {
  "profile": {"screenName": 'makenzy84'},
  "domId": 'exampleProfile',
  "maxTweets": 1,
  "enableLinks": false, 
  "showUser": false,
  "showTime": true,
  "showImages": false,
  "dataOnly": true,
  "customCallback": populateTpl,
  "lang": 'fr',
  "showInteraction": false
};
twitterFetcher.fetch(configProfile);


function populateTpl(tweets){
  var element = document.getElementById('lastTweet');
  var html = tweets[0]['timestamp'];
  var dateT = new Date(html);
  var tStamp = Date.parse(html);
  dateT = dateT.toLocaleString();
  element.innerHTML = dateT+'=>'+tStamp;
}

