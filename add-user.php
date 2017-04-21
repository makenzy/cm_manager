<?php
session_start();
if(!isset($_SESSION) || empty($_SESSION['user']) ){
    header("location:login.php");
}
if($_SESSION['type'] == 'user'){
    header("location:index.php");
}
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="icon" href="logo/tw_logo.ico"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> CM Manager | Ajouter un CM</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <script src="js/twitterFetcher.js"></script>
        <link rel="stylesheet" id="theme-style" href="css/app-blue.css">
        <style>
            .form-group .col-sm-8, .form-group .col-sm-12 {
                margin-bottom: 1rem;
            }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
    			<i class="fa fa-bars"></i>
    		</button> </div>
                    <div class="header-block header-block-search hidden-sm-down"></div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('user.png'); background-color: transparent"> </div> 
                                    <!--<i class="fa fa-user-md"></i> &nbsp;-->
                                    <span class="name">
                                    <?php echo ucfirst($_SESSION['nom']);?>
                                    </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <!--<div class="dropdown-divider"></div>-->
                                    <a class="dropdown-item" href="login.php"> <i class="fa fa-power-off icon"></i> Déconnexion </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo"><img src="logo/tw_logo-6.png"></div> CM Manager</div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li>
                                    <a href="index.php"> <i class="fa fa-home"></i> Accueil </a>
                                </li>
                                
                                <?php
                                if ($_SESSION['type'] !== 'user') {
                                    echo '
                                <li class="active open">
                                    <a href=""> <i class="fa fa-users"></i> Utilisateurs (CM)<i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="users-list.php">
                                            Liste des CM
                                        </a> </li>
                                        <li class="active"> <a href="add-user.php">
                                            Ajouter CM
                                        </a> </li>
                                    </ul>
                                </li>'; } ?>
                                <li>
                                    <a href=""> <i class="fa fa-twitter"></i> Comptes TW <i class="fa arrow"></i> </a>
                                    <ul>
                                        
                                        <li> <a href="accounts-list.php">
                                            Liste des comptes
                                        </a> </li>
                                        
                                        <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            echo '
                                            <li> <a href="add-account.php">
                                                Ajouter un compte
                                            </a> </li>
                                            <li> <a href="user-account.php">
                                                Attribution <br>Comptes <i class="fa fa-arrows-h"></i> Utilisateurs
                                            </a> </li>';
                                        }
                                        ?>
                                    </ul>
                                </li>                                       
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="nav metismenu" id="customize-menu">
                            <center> <li>
                                    <a href="login.php"> <i class="fa fa-power-off icon"></i>  Se déconnecter </a>
                            </li></center>
                        </ul>
                    </footer>
                </aside>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content items-list-page">
                    <div class="title-search-block">
                        <div class="title-block">
                            <div class="row">
                               <div class="col-md-6">
                                     <h3 class="title"><i class="fa fa-user"> Ajouter un utilisateur  
                                    </i></h3>
                                </div>
                                <div class="col-md-6" align="right">
                                    <a href="users-list.php" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-list-ol"></i> Retour à la liste</a>
                                </div>
                            </div>
                        </div>
       
                    </div>

                    <!--######################################################################-->
<?php if(!empty($_GET)){
                   
    if ($_GET['op'] == 'success'){
        echo '<div class="alert alert-success">
            <i class="fa fa-check-circle-o icon"></i> <strong>Succès de l\'ajout</strong>
        </div>
        <script>setTimeout(function(){ location.href="users-list.php"; }, 1500);</script>';
        
    } else if($_GET['op'] == 'erreur'){
        echo '<div class="alert alert-danger">
           <i class="fa fa-times-circle-o icon"></i> <strong>Echec de l\'ajout</strong>
        </div>';
    }
}?>
<div class="card items">
    <div class="row ng-scope">
    <div class="col-md-12">
        <div class="container">
			<div class="row main">
				<div class="main-login main-center">
					<form class="" method="post" action="add_up_user.php" role="form">
						<br>
						<div class="form-group">
							<label for="name" class="col-sm-12 control-label">Nom</label>
							<div class="col-lg-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="Nom affiché de l'utilisateur" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-12 control-label">E-mail</label>
							<div class="col-lg-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Adresse E-mail (login)" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-sm-12 control-label">Mot de passe</label>
							<div class="col-lg-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="password" id="password"  placeholder="Mot de passe" required/>
								</div>
							</div>
						</div>
                        <input type="hidden" class="form-control" name="action" value="add"/>

						<div class="form-group">
                            <div class="col-sm-12" align="right">
                                    <br>
                                <button class="btn btn-success" type="submit">Ajouter</button>
                            </div>
                        </div>
						
					</form>
				</div>
			</div>
		</div>

    </div>
</div>
</div>
                
                </article>
                
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script>
            function connecter(idc){
                var editorExtensionId = "mlbcmjpahokfgkghabmfjgmnafffphpd";
                idc = idc.toString();
                chrome.runtime.sendMessage(editorExtensionId, {action: "login", user: "makenzy84", idcompte: idc},
                function(response) {
                });
            };
        </script>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>