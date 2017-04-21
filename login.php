<?php
session_start();
session_destroy();
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> CM Manager </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" href="logo/tw_logo.ico" />
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <script>
           document.write('<link rel="stylesheet" id="theme-style" href="css/app-blue.css">');
        </script>
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <div class="logo"> <img src="logo/tw_logo-5.png" style="margin-top: -13px;"> </div> CM Manager </h1>
                    </header>
                    <div class="auth-content">
                        
                        <p class="text-xs-center">IDENTIFIEZ-VOUS</p>
                        <form id="login-form" action="check.php" method="POST" novalidate="">
                            <div class="form-group"> <label for="username">E-mail</label> <input type="email" class="form-control underlined" name="username" id="username" placeholder="Votre adresse e-mail" required> </div>
                            <div class="form-group"> <label for="password">Mot de passe</label> <input type="password" class="form-control underlined" name="password" id="password" placeholder="Votre mot de passe" required> </div>
                            <div id="error" style="margin-bottom: 10px;color: red;">
                                <?php
                                    if (!empty($_GET["error"])){
                                        echo "<center><b>E-mail / Mot de passe érroné!</b></center>";    
                                    }
                                    ?>
                            </div>
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary">Login</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <!--<script>
            (function(i, s, o, g, r, a, m)
            {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function()
                {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-80463319-2', 'auto');
            ga('send', 'pageview');
        </script>-->
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>