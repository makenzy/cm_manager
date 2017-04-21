var pict = document.getElementsByClassName('DashboardProfileCard-avatarImage');
function logMeIn(){
    var loginField = document.getElementsByClassName('js-username-field');
    var passwordField = document.getElementsByClassName('js-password-field');
    if( loginField[0] && passwordField[0] ){
        loginField[0].value = 'makenzy84';
        passwordField[0].value = '07379040Makenzy_';
        var login = document.querySelectorAll('button.submit');
        // setTimeout(function(){login[0].click();},2000);   
    } else {
            setTimeout(logMeIn,250);
    }
};

function logMeOut(){
chrome.tabs.create({ url: "https://twitter.com/logout",active:false }, function(tab){
        chrome.tabs.executeScript(tab.id,{code:`
            (function(){
               var logout = document.querySelectorAll('button.js-submit');
                setTimeout(function(){logout[0].click();},3000);
                // setTimeout(function(){window.close();},5000);
                window.close();
            })();
        `},function(results){
            // chrome.tabs.update(tab.id,{active:true});
        });
});
};

if (pict.length === 0){ //diconnected
    logMeIn();
} else { // connected
    logMeOut();
    setTimeout(function(){window.close();},8000);
    chrome.tabs.create({ url: newURL,active:false }, function(tab){
        chrome.tabs.executeScript(tab.id,{code:`
            (function(){
                function changeLoginWhenExists(){
                    var loginField = document.getElementsByClassName('js-username-field');
                    var passwordField = document.getElementsByClassName('js-password-field');
                    //loginField and passwordField are each an HTMLCollection
                    if( loginField[0] && passwordField[0] ){
                        loginField[0].value = 'makenzy84';
                        passwordField[0].value = '07379040Makenzy_';
                        var login = document.querySelectorAll('button.submit');
                        // setTimeout(function(){login[0].click();},2000);
                        
                    } else {             
                        setTimeout(changeLoginWhenExists,250);
                    }
                }
                changeLoginWhenExists();
            })();
        `},function(results){
            //Now that we are done with processing, make the tab active. This will
            //  close/destroy the popup.
            chrome.tabs.update(tab.id,{active:true});
        });
    });
}        









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





                function logMeOut(){
                chrome.tabs.create({ url: "https://twitter.com/logout",active:false }, function(tab){
                        chrome.tabs.executeScript(tab.id,{code:`
                            (function(){
                            var logout = document.querySelectorAll('button.js-submit');
                                setTimeout(function(){logout[0].click();},3000);
                                // setTimeout(function(){window.close();},5000);
                                window.close();
                            })();
                        `},function(results){
                            // chrome.tabs.update(tab.id,{active:true});
                        });
                });
                };