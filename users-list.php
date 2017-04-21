<?php
session_start();
if(!isset($_SESSION) || empty($_SESSION['user'])){
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
        <title> CM Manager | Liste des CM </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/users.css">
        <link rel="stylesheet" id="theme-style" href="css/app-blue.css">
        <script src="js/twitterFetcher.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <!-- Theme initialization -->

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
                                <li>
                                    <a href="index.php"> <i class="fa fa-home"></i> Accueil </a>
                                </li>
                                <?php
                                if ($_SESSION['type'] !== 'user') {
                                    echo '
                                <li class="active open">
                                    <a href=""> <i class="fa fa-users"></i> Utilisateurs (CM)<i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="active"> <a href="users-list.php">
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
                        <h3 class="title"><i class="fa fa-users"> Utilisateurs
                        </i></h3>

                    </div>
                    <?php
                    if ($_SESSION['type'] !== 'user') {
                    echo '
                    <div class="col-md-6" align="right">
                        <a href="add-user.php" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-plus"></i> Ajouter</a>
                    </div>';}
                    ?>
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
<?php
if(!empty($_GET)){
                   
    if ($_GET['op'] == 'success'){
        echo '<div class="alert alert-success">
            <i class="fa fa-check-circle-o icon"></i> <strong>Suppression réussie</strong>
        </div>';
    } else if($_GET['op'] == 'erreur'){
        echo '<div class="alert alert-danger">
           <i class="fa fa-times-circle-o icon"></i> <strong>Echec de la suppression</strong>
        </div>';
    }
}
?>

                    
<div class="card items">
    <div class="col-md-12">
        <div class="page-people-directory">
            <div class="list-group contact-group">
<?php
require('cnx.php');
if ($_SESSION['type'] !== 'super') {
    $users = getAllSimpleUsers($con);
} else {
    $users = getAllUsers($con);
}

foreach ($users as $user){
?>   
                     
                
                     <span class="list-group-item">
                        <div class="media">
                            <div class="pull-left">
                                <img class="img-circle" src="user.png" alt="...">
                            </div>
                            <div class="media-body">
                                <center><strong><a href="edit-user.php?id=<?php echo $user['id_u'];?>" class="user">
                                <h3 class=""><?php echo ucfirst($user['nom_u']);?></h3></a>
                                </strong>
                                <div class="media-content">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-pencil-square-o"></i> <?php echo ucfirst($user['nom_u']);?></li>
                                        <li><i class="fa fa-envelope-o"></i> <?php echo $user['email_u'];?></li>
                                        <li><i class="fa fa-lock"></i> <?php echo $user['pwd_u'];?></li>
                                        <li><a class="remove pull-right" href="" data-toggle="modal" data-target="#confirm-modal"  data-id="<?php echo $user['id_u'];?>"> <i class="fa fa-trash-o "></i> </a></li>
                                    </ul>
                                </div>
                                </center>
                            </div>
                        </div>
                    </span> 
   

<?php }?>
            </div>
        </div>
    </div>
</div>
  

        <div class="modal modal-pull-right" data-easein="fadeInRight" data-easeout="fadeOutRight" id="modal-pull-right-add" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content animated fadeOutRight">
                    <div class="modal-body">
                        <div class="row modal-close">
                            <div class="col-md-12 padding-bottom-8 padding-top-8 bg-silver">
                                <h4 class="pull-left"><b>Create New Contact</b></h4>
                                <ul class="list-unstyled list-inline text-right">
                                    <li class="close-right-modal"><span class="fa fa-times fa-2x" data-dismiss="modal"></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-add-content">
                                    <form class="form-horizontal tabular-form margin-top-10">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10 tabular-border">
                                                <input type="text" class="form-control" id="name" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10 tabular-border">
                                                <input type="text" class="form-control" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-10 tabular-border">
                                                <input type="text" class="form-control" id="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10 tabular-border">
                                                <input type="text" class="form-control" id="address" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-silver btn-flat">Cancel</button> <button type="button" class="btn btn-green btn-flat">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <h4 class="modal-title"><i class="fa fa-warning"></i> Suppression</h4>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr?</p>
                            </div>
                            <div class="modal-footer"> <button type="button" class="btn btn-primary yes" data-dismiss="modal" >Oui</button> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button> 
                            </div>
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
                var editorExtensionId = "fhbakcemlkboijepimpihnbkgkilafao";
                idc = idc.toString();
                chrome.runtime.sendMessage(editorExtensionId, {action: "login", user: "", idcompte: idc},
                function(response) {
                });
            };
        
        $(document).on("click", ".remove", function () {
            var compteId = $(this).data('id');
            var lien = "location.href='del_user.php?id="+compteId+"'";
            $(".modal-footer .yes").attr('onclick',lien );

        });
        </script>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>