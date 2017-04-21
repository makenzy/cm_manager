function changeLoginWhenExists(){
        var loginField = document.getElementsByClassName('js-username-field');
        var passwordField = document.getElementsByClassName('js-password-field');
        //loginField and passwordField are each an HTMLCollection
        if( loginField[0] && passwordField[0] ){
            loginField[0].value = 'makenzy84';
            passwordField[0].value = '07379040Makenzy_';
            var login = document.querySelectorAll('button.submit');
            setTimeout(function(){login[0].click();},2000);
            
        } else {
            if(count-- > 0 ){
                //The elements we need don't exst yet, wait a bit to try again.
                setTimeout(changeLoginWhenExists,250);
            }
        }
    }
    
changeLoginWhenExists();    