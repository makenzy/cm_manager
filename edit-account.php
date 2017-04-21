<?php
session_start();
if(!isset($_SESSION) || empty($_SESSION['user']) || ($_SESSION['type'] == 'user')){
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
        <title> CM Manager | Modifier un compte</title>
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
                                <li>
                                    <a href=""> <i class="fa fa-users"></i> Utilisateurs (CM)<i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="users-list.php">
                                            Liste des CM
                                        </a> </li>
                                        <li> <a href="add-user.php">
                                            Ajouter CM
                                        </a> </li>
                                    </ul>
                                </li>';} ?>
                                <li class="active open">
                                    <a href=""> <i class="fa fa-twitter"></i> Comptes TW <i class="fa arrow"></i> </a>
                                    <ul>
                                        
                                        <li> <a href="accounts-list.php">
                                            Liste des comptes
                                        </a> </li>
                                        
                                        <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            echo '
                                            <li > <a href="add-account.php">
                                                Ajouter un compte
                                            </a> </li>
                                            <li class="active"> <a href="edit-account.php">
                                                Modifier un compte
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
                                    <a href="login.php"> <i class="fa fa-power-off icon"></i>   Se déconnecter </a>
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
                                     <h3 class="title"><i class="fa fa-twitter"> Modifier un compte  
                                    </i></h3>
                                </div>
                                <div class="col-md-6" align="right">
                                    <a href="accounts-list.php" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-list-ol"></i> Retour à la liste</a>
                                </div>
                            </div>
                        </div>
       
                    </div>

                    <!--######################################################################-->
<?php if(!empty($_GET)){
                 
    if (isset($_GET['op']) && ($_GET['op'] == 'success')){
        echo '<div class="alert alert-success">
            <i class="fa fa-check-circle-o icon"></i> <strong>Modification réussie</strong>
            <script>setTimeout(function(){ location.href="accounts-list.php"; }, 2000);</script>
        </div>';
    } else if(isset($_GET['op']) && ($_GET['op'] == 'erreur')){
        echo '<div class="alert alert-danger">
           <i class="fa fa-times-circle-o icon"></i> <strong>Echec de la modification</strong>
        </div>';
    } 
    if (!empty($_GET['id'])){
        require('cnx.php');
        $data = getCptData($con,$_GET['id']);
        $data = $data[0]; 
        // print_r($data);
        $datecr = str_replace('/', '-', $data['date_crea_c']);
        $datec = date("Y-m-d", strtotime($datecr));

        // $datec = $data['date_crea_c'];
 

    }
}?>
<div class="card items">
    <div class="row ng-scope">
    <div class="col-md-12">
                <div class="row pv-lg">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">

                        <form class="form-horizontal ng-pristine ng-valid" role"form" method='POST' action='add_up_account.php'>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact1">Compte</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="lien" id="inputContact1" type="text" placeholder="https://twitter.com/exemple" value="<?php echo $data['lien_c'];?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact3">Mot de passe compte</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="pwd" id="inputContact3" type="password" value="<?php echo $data['pwd_c'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact2">Email</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="email" id="inputContact2" type="email" value="<?php echo $data['email_c'];?>" placeholder="mail@example.com" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact3">Mot de passe e-mail</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="pwd_email" id="inputContact3" type="password" value="<?php echo $data['pwd_email_c'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact5">Date de création</label>
                                <div class="col-sm-8">

                                    <input class="form-control" name="datec" id="inputContact5" type="date" value="<?php echo $datec;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact4">Attribuer à</label>
                                <div class="col-sm-8">
                                <?php
                                   if(!empty($_GET['id'])){ $usr = getLinkedUser($con,$_GET['id']);} else {require('cnx.php');}
                                    if(!empty($usr[0])){$usr = $usr[0];}
                                    if (!empty($usr) && $usr['nom_u'] == '--'){$title = ' selected';} else {$title = '';}
                                ?>
                                    <select class="custom-select form-control"  name="user">
                                        <option value="x" <?php echo $title;?>>Choisissez un utilisateur</option>
                                        <?php 
                                        // 
                                        
                                        $users = getAllSimpleUsers($con);
                                        foreach($users as $user){
                                            if (!empty($usr) && (!empty($usr['id_u']) && ($user['id_u'] == $usr['id_u']))){
                                                echo '<option value="'.$user['id_u'].'" selected>'.$user['nom_u'].'</option>';
                                            } else{
                                                echo '<option value="'.$user['id_u'].'">'.$user['nom_u'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                    <input class="form-control"  name="action" type="hidden" value="maj">
                                    <input class="form-control"  name="id" type="hidden" value="<?php echo $_GET['id'];?>">
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-12" align="right">
                                    <br>
                                <button class="btn btn-info" type="submit">Mettre à jour</button>
                                
                                </div>
                            </div>
                        </form>
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