document.addEventListener('DOMContentLoaded', function() {

    var newURL = "https://twitter.com/login";
    //Must not make the tab active, or the popup will be destroyed preventing any
    //  further processing.
    chrome.tabs.create({ url: newURL,active:false }, function(tab){
        // console.log('Attempting to inject script into tab:',tab);
        chrome.tabs.executeScript(tab.id,{code:`
            (function(){
               /* function changeLoginWhenExists(){
                    var loginField = document.getElementsByClassName('js-username-field');
                    var passwordField = document.getElementsByClassName('js-password-field');
                    //loginField and passwordField are each an HTMLCollection
                    if( loginField[0] && passwordField[0] ){
                        loginField[0].value = 'makenzy84';
                        passwordField[0].value = '07379040Makenzy_';
                        var login = document.querySelectorAll('button.submit');
                        // setTimeout(function(){login[0].click();},2000);
                        
                    } else {
                        if(count-- > 0 ){
                            //The elements we need don't exst yet, wait a bit to try again.
                            setTimeout(changeLoginWhenExists,250);
                        }
                    }
                }
                var pict = document.getElementsByClassName('DashboardProfileCard-avatarImage');
                if (pict.length === 0){ //diconnected
                    changeLoginWhenExists();
                } else { // connected
                    setTimeout(function(){window.location.href = "http://twitter.com/logout";},3000);
                } */         
            })();
        `},function(results){
            //Now that we are done with processing, make the tab active. This will
            //  close/destroy the popup.
            chrome.tabs.update(tab.id,{active:true});
        });
    });

}, false);