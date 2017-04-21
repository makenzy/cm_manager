<?php
session_start();
if(!isset($_SESSION) || empty($_SESSION['user'])){
    header("location:login.php");
}
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="icon" href="logo/tw_logo.ico"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> CM Manager | Accueil</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" id="theme-style" href="css/app-blue.css">
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
                                <div class="logo"><img src="logo/tw_logo-6.png"></div> CM Manager </div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li class="active">
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
                                <hr>
                                                      
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
                                     <h3 class="title"><i class="fa fa-twitter"> Comptes Twitter  
                                    </i></h3>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <!--<form class="form-inline">
                                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..."> <span class="input-group-btn">
					<button class="btn btn-secondary rounded-s" type="button">
						<i class="fa fa-search"></i>
					</button>
				</span> </div>
                            </form>-->
                        </div>
                    </div>

                    <!--######################################################################-->
                    <div class="card items">
                        <ul class="item-list striped">
                            <li class="item item-list-header hidden-sm-down">
                                <div class="item-row">
                                   
                                    
                                    <div class="item-col item-col-header item-col-title">
                                        <div class="no-overflow"> <span>Compte</span> </div>
                                    </div>
                                    <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            echo '
                                    
                                    <div class="item-col item-col-header item-col-author">
                                        <div class="no-overflow"> <span>Attribué à</span> </div>
                                    </div>';
                                    }
                                    ?>
                                    <div class="item-col item-col-header item-col-date">
                                        <div> <span>Date Création</span> </div>
                                    </div>
                                    <div class="item-col item-col-header item-col-date">
                                        <div> <span>Dernière MàJ</span> </div>
                                    </div>
                                    
                                </div>
                            </li>
<!--//////////////////////////////////////////////////////////////////////////////////////////////-->
<?php 
require('cnx.php');
if ($_SESSION['type'] !== 'user') {
    $comptes = getAllCpts($con);
} else {
    $comptes = getUserCpts($con,$_SESSION['id']);
}
foreach ($comptes as $cpt){
$tmp = explode('https://twitter.com/',$cpt['lien_c']);
$screenN = $tmp[1];

?>
                            <li class="item">
                                <div class="item-row">
                                    
                                    
                                    <div class="item-col fixed pull-left item-col-title">
                                        <!--<div class="item-heading">Name</div>-->
                                        <div>
                                            <a href="<?php echo $cpt['lien_c']; ?>" class="">
                                                <div class="item-title"> <?php echo $cpt['lien_c']; ?> </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            $linkedU = getLinkedUser($con,$cpt['id_c']);
                                            echo '
                                    
                                        <div class="item-col item-col-author">
                     
                                        <div> '.$linkedU['nom_u'].' </div>
                                        </div>';
                                        } ?>
                                    <div class="item-col item-col-date">
                                        <!--<div class="item-heading">Published</div>-->
                                        <div> <?php echo $cpt['date_crea_c']; ?> </div>
                                    </div>
                                    <div class="item-col item-col-date">
                                        <!--<div class="item-heading">Published</div>-->
                                        <div class="no-overflow"> 
                                        <?php 
                                        $response = file_get_contents('http://localhost/dist/api/index.php/'.$screenN);
                                        $response = json_decode($response);
                                        print_r($response);
                                        echo $cpt['date_maj_c']; ?> 
                                        </div>
                                    </div>
                                </div>
                            </li>  
<?php
    }
?>
    <!-- ---------------------------------- / COMPTE------------------------------------------------- -->
                        </ul>
                    </div>
                
                </article>
                <div class="modal fade" id="modal-media">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    					<span class="sr-only">Close</span>
    				</button>
                                <h4 class="modal-title">Media Library</h4>
                            </div>
                            <div class="modal-body modal-tab-container">
                                <ul class="nav nav-tabs modal-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a> </li>
                                    <li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
                                </ul>
                                <div class="tab-content modal-tab-content">
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="images-container">
                                            <div class="row"> </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                        <div class="upload-container">
                                            <div id="dropzone">
                                                <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                    <div class="dz-message-block">
                                                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Insert Selected</button> </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal fade" id="confirm-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
                                <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to do this?</p>
                            </div>
                            <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
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