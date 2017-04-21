var pict = document.getElementsByClassName('DashboardProfileCard-avatarImage');
if (pict.length === 0){ //diconnected
     changeLogin(); 
} else { // connected
    // setTimeout(function(){window.location.href = "http://twitter.com/logout";},3000);
    var url = window.location.href;
    // alert (url);
} 

function changeLogin(){
    var loginField = document.getElementById('signin-email');
    var passwordField = document.getElementById('signin-password');
    //loginField and passwordField are each an HTMLCollection
    if( loginField && passwordField ){
        loginField.value = 'makenzy84';
        passwordField.value = '07379040Makenzy_';
        var login = document.querySelectorAll('button.submit');
        setTimeout(function(){login[0].click();},2000);
        
    } else {
            //The elements we need don't exst yet, wait a bit to try again.
            setTimeout(changeLogin,250);
    }
}