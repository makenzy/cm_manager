chrome.runtime.onMessageExternal.addListener(
  function(request, sender, sendResponse) {
    //  alert(/*'sender : '+JSON.stringify(sender, null, 4)+'<br>msg received '+*/JSON.stringify(request, null, 4));

    // if (sender.url !== "http://localhost/cm_manager")
    //   return;  // don't allow this web page access

   /* if(request && request.action === 'logout'){
         chrome.tabs.create({ url: "https://twitter.com/logout",active:false }, function(tab){
                chrome.tabs.executeScript(tab.id,{code:`
                    (function(){
                    var logout = document.querySelectorAll('button.js-submit');
                        // setTimeout(function(){
                            logout[0].click();//},3000);
                            window.onunload = window.onbeforeunload = function() {
                                open(location, '_self').close();
                            };
                        // setTimeout(function(){open(location, '_self').close();},1000);
                    })();
                `},function(results){
                    chrome.tabs.update(tab.id,{active:true});
                    // alert(JSON.stringify(results, null, 4));
                });
                
        });
    }else */if(request && request.action === 'login'){
        var newURL = "https://twitter.com/";//+request.user;    

        chrome.tabs.create({ url: newURL,active:false }, function(tab){
            chrome.tabs.executeScript(tab.id,{code:`
                (function(){
                
                    var pict = document.getElementsByClassName('DashboardProfileCard-avatarImage');
                    
                    function logMeIn(){
                        var loginField = document.getElementById('signin-email');
                        var passwordField = document.getElementById('signin-password');
                        
                        if( loginField && passwordField ){
                            loginField.value = 'makenzy84';
                            passwordField.value = '07379040Makenzy_';
                            var login = document.querySelectorAll('button.submit');
                            setTimeout(function(){login[0].click();},2000);
                        } else {
                                setTimeout(logMeIn,250);
                        }
                    };

                    /*function logMeOut(){
                    chrome.tabs.create({ url: "https://twitter.com/logout",active:false }, function(tab){
                            chrome.tabs.executeScript(tab.id,{code:\`
                                (function(){
                                var logout = document.querySelectorAll('button.js-submit');
                                    setTimeout(function(){logout[0].click();},3000);
                                    // setTimeout(function(){window.close();},3000);
                                    window.close();
                                })();
                            \`},function(results){
                                // chrome.tabs.update(tab.id,{active:true});
                            });
                    });
                    };*/

                    if (pict.length === 0){ //diconnected
                        logMeIn();
                    } else { // connected
                        //logMeOut();
                        // window.open('https://twitter.com/logout', '_blank');
                        setTimeout(function(){newTab;},7000);
                    }    


                })();
            `},function(results){
                //Now that we are done with processing, make the tab active. This will
                //  close/destroy the popup.
                chrome.tabs.update(tab.id,{active:true});
            });
        });

    }

});

//   function clearCookies(){
//       chrome.cookies.getAll({domain: "twitter.com"}, function(cookies) {
//         for(var i=0; i<cookies.length;i++) {
//             chrome.cookies.remove({url: "https://twitter.com" + cookies[i].path, name: cookies[i].name});
//         }
//     });
//   };

chrome.tabs.create({"url":"http://localhost/cm_manager/","selected":true});

