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
        <title> CM Manager | Liste des comptes </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" id="theme-style" href="css/app-blue.css">
        <script src="js/twitterFetcher.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <!-- Theme initialization -->
       <style>
            .email_in, .pwd_in, .pwd_email_in, .us_in {
                width: 100%;
                text-align: center;
            }
            .dangerous{
                background-color: rgb(245, 210, 209) !important;
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
                                <li class="active open">
                                    <a href=""> <i class="fa fa-twitter"></i> Comptes TW <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="active"> <a href="accounts-list.php">
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
                                     <h3 class="title"><i class="fa fa-twitter"> Comptes Twitter 
                                    </i></h3>
                                    
                                </div>
                                <?php
                                if ($_SESSION['type'] !== 'user') {
                                    echo '
                                <div class="col-md-6" align="right">
                                    <a href="add-account.php" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-plus"></i> Ajouter</a>
                                </div>';}
                                ?>
                            </div>
                        </div>
                        <!--div class="items-search">
                            <!--<form class="form-inline">
                                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..."> <span class="input-group-btn">
					<button class="btn btn-secondary rounded-s" type="button">
						<i class="fa fa-search"></i>
					</button>
				</span> </div>
                            </form>-->
                            <!-- ------------------------------ -->
                            <!--div class="row form-group">
                                <label class="col-sm-2 control-label pull-right">Filtrer par catégorie</label>
                                <div class="col-sm-3">
                                    <select class="custom-select form-control"  name="user">
                                        <?php
                                        // require('cnx.php');
                                        // $cats = getAllCat($con);
                                        // foreach($cats as $cat){
                                        //     echo '<option value="'.$cat['id_cat'].'">'.$cat['nom_cat'].'</option>';
                                        // }
                                    ?>
                                    </select>
                                </div>
                            </div-->
                        
                    <!--/div-->

<div class="row form-group">
    <label class="col-sm-2 control-label pull-right">Filtrer par catégorie</label>
    <div class="col-sm-3">
        <select class="custom-select form-control select-cat"  name="category">
            <?php
            require('cnx.php');
            $cats = getAllCat($con);
            foreach($cats as $cat){
                echo '<option value="'.$cat['id_cat'].'">'.htmlentities($cat['nom_cat']).'</option>';
            }
            ?>
        </select>
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
                        <ul class="item-list striped">
                            <li class="item item-list-header hidden-sm-down">
                                <div class="item-row">
                                   
                                    
                                    <div class="item-col item-col-header item-col-title">
                                        <div class="no-overflow"> <span>Compte</span> </div>
                                    </div>
                                    <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            echo '
                                    <div class="item-col item-col-header item-col-sales">
                                        <div class="no-overflow"> <span>MdP Twitter</span> </div>
                                    </div>
                                    <div class="item-col item-col-header item-col-stats">
                                        <div class="no-overflow"> <span>E-mail</span> </div>
                                    </div>
                                    <div class="item-col item-col-header item-col-category">
                                        <div class="no-overflow"> <span>MdP email</span> </div>
                                    </div>
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
                                    <div class="item-col item-col-header item-col-date">
                                        
                                    </div>
                                    <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            echo '
                                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>';
                                        }
                                    ?>
                                </div>
                            </li>
<!--//////////////////////////////////////////////////////////////////////////////////////////////-->
<?php 
// require('cnx.php');
if ($_SESSION['type'] !== 'user') {
    $comptes = getAllCpts($con);
} else {
    $comptes = getUserCpts($con,$_SESSION['id']);
}
foreach ($comptes as $cpt){
$tmp = explode('https://twitter.com/',$cpt['lien_c']);
$screenN = $tmp[1];
// $xmlString = file_get_contents("https://twitrss.me/twitter_user_to_rss/?user=".$cpt['nom_c'],true);
// $xml = simplexml_load_string($xmlString) ;//or die("Erreur lors de la récupératon de la date");

// if ($xml && isset($xml->channel->item[0]->pubDate[0])) {
//     $date = strtotime((string) $xml->channel->item[0]->pubDate[0]);
//     $dateMaj = date('d/m/Y',$date);
// } else {
//     $dateMaj = '--';
// }
###########

if (!empty($cpt['date_maj_c'])) {
    $dateMaj = $cpt['date_maj_c'];
} else {
    $dateMaj = '--';
}
?>
                            <li class="item">
                                <div class="item-row <?php echo $cpt['cat_c']; ?>" data-id="<?php echo $cpt['id_c']; ?>">
                                    
                                    
                                    <div class="item-col fixed pull-left item-col-title">
                                        <!--<div class="item-heading">Name</div>-->
                                        <div>
                                            <a href="<?php echo $cpt['lien_c']; ?>" class="compte_href">
                                                <div class="item-title"> <?php echo $cpt['lien_c']; ?> </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                        if ($_SESSION['type'] !== 'user') {
                                            $linkedU = getLinkedUser($con,$cpt['id_c']);
                                            echo '
                                    <div class="item-col item-col-sales">
                                        <div class="pwd">'.htmlentities($cpt['pwd_c']).'</div>
                                    </div>
                                    <div class="item-col item-col-stats">
                                        <div>
                                            <div class="email">'.$cpt["email_c"].'</div>
                                        </div>
                                    </div>
                                    <div class="item-col item-col-category">
                                        <div class="pwd_email">'.htmlentities($cpt['pwd_email_c']).'</div>
                                    </div>
                                    <div class="item-col item-col-author">
                                        <div class="us">'.$linkedU['nom_u'].'</div>
                                        </div>';
                                        } ?>
                                    <div class="item-col item-col-date">
                                        <div class="d_crea"><?php if(!empty($cpt['date_crea_c'])){echo $cpt['date_crea_c'];} else {echo '--';} ?></div>
                                    </div>
                                    <div class="item-col item-col-date">
                                        <div class="d_maj no-overflow"><?php echo $dateMaj; ?></div>
                                    </div>
                                    <div class="item-col item-col-cnx">
                                        <?php $idc = $cpt["id_c"];
                                         echo '<button type="button" class="btn btn-info btn-sm" onclick="connecter(\''.$idc.'\');">Connexion</button>'; 
                                         ?>
                                    </div>
                                    <?php 
                                    if ($_SESSION['type'] !== 'user') {
                                    echo '
                                    <div class="item-col fixed item-col-actions-dropdown">
                                        <div class="item-actions-dropdown">
                                            <a class="item-actions-toggle-btn"> <span class="inactive">
                                            <i class="fa fa-cog"></i>
                                            </span> <span class="active">
                                            <i class="fa fa-chevron-circle-right"></i>
                                            </span> </a>
                                            
                                            <div class="item-actions-block">
                                                <ul class="item-actions-list">
                                                    <li>
                                                        <a class="remove" href="" data-toggle="modal" data-target="#confirm-modal"  data-id="'.$cpt['id_c'].'"> <i class="fa fa-trash-o "></i> </a>
                                                    </li>
                                                    <li>
                                                        <a class="edit" href="edit-account.php?id='.$idc.'"> <i class="fa fa-pencil"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    ?>

                                </div>
                            </li>  
<?php
    } //end foreach
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
                alert(idc);
                var editorExtensionId = "fbbjdjgkgnpfodplgdojedcfkhojadhm";
                idc = idc.toString();
                chrome.runtime.sendMessage(editorExtensionId, {action: "login", user: "", idcompte: idc},
                function(response) {
                });
            };

        $('body').on('change','.select-cat',function(){
            var cat = $(this).val();
            if (cat !== '1'){
                $('.item-row').not(':first').parent().hide();
                $('.item-row.'+cat).parent().show();
                // $('.item-row:not(.'+cat+')').parent().hide()
            } else if (cat === '1') {
                $('li.item').show();
            }
        });

        
        $(document).on("click", ".remove", function () {
            var compteId = $(this).data('id');
            var lien = "location.href='del_user.php?id="+compteId+"'";
            $(".modal-footer .yes").attr('onclick',lien );

        });
 
        //------------------------------------- PWD --------------------------------------------------------------

        $('body').on('click','.pwd',function(){
            var pwd = $(this).text();
            $(this).replaceWith('<input class="pwd_in" type="text" value="'+pwd+'" style="border-top: none; border-right: none; border-left:none;" required/>');
            
            var new_pwd = $('.pwd_in');
            var strLength = new_pwd.val().length * 2;
            
            new_pwd.focus();
            new_pwd[0].setSelectionRange(strLength, strLength);
            
            new_pwd.focusout(function(){
                var id = new_pwd.parents('.item-row').data('id');
                var new_pwd_val = new_pwd.val(); 
                if(new_pwd_val !== ''){
                    var dataString = {id: id, val: new_pwd_val, col: 'pwd_c'}; 
                    $.ajax({
                        type: "POST",
                        url: "cnx.php",
                        data: {
                            action: 'test', 
                            data: dataString
                        },
                        success: function(msg)
                        {
                            // alert(msg);
                            new_pwd.replaceWith('<div class="pwd">'+new_pwd_val+'</div>');  
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Erreur: " + errorThrown); 
                        } 
                    });
                } 
            });
        });

        //------------------------------------- EMAIL --------------------------------------------------------------

        $('body').on('click','.email',function(){
            var email = $(this).text();
            $(this).replaceWith('<input class="email_in" type="email" value="'+email+'" style="border-top: none; border-right: none; border-left:none;" required/>');
            
            var new_email = $('.email_in');
            // var strLength = new_email.val().length * 2;
            
            new_email.focus();
            // new_email[0].setSelectionRange(strLength, strLength);
            
            new_email.focusout(function(){
                var id = new_email.parents('.item-row').data('id');
                var new_email_val = new_email.val(); 
                if(new_email_val !== ''){
                    var dataString = {id: id, val: new_email_val, col: 'email_c'}; 
                    $.ajax({
                        type: "POST",
                        url: "cnx.php",
                        data: {
                            action: 'test', 
                            data: dataString
                        },
                        success: function(msg)
                        {
                            // alert(msg);
                            new_email.replaceWith('<div class="email">'+new_email_val+'</div>');  
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Erreur: " + errorThrown); 
                        } 
                    });
                } 
            });
        });

        //------------------------------------- PWD EMAIL --------------------------------------------------------------

        $('body').on('click','.pwd_email',function(){
            var pwd_email = $(this).text();
            $(this).replaceWith('<input class="pwd_email_in" type="text" value="'+pwd_email+'" style="border-top: none; border-right: none; border-left:none;" required/>');
            
            var new_pwd_email = $('.pwd_email_in');
            var strLength = new_pwd_email.val().length * 2;
            
            new_pwd_email.focus();
            new_pwd_email[0].setSelectionRange(strLength, strLength);
            
            new_pwd_email.focusout(function(){
                var id = new_pwd_email.parents('.item-row').data('id');
                var new_pwd_email_val = new_pwd_email.val(); 
                if(new_pwd_email_val !== ''){
                    var dataString = {id: id, val: new_pwd_email_val, col: 'pwd_email_c'}; 
                    $.ajax({
                        type: "POST",
                        url: "cnx.php",
                        data: {
                            action: 'test', 
                            data: dataString
                        },
                        success: function(msg)
                        {
                            // alert(msg);
                            new_pwd_email.replaceWith('<div class="pwd_email">'+new_pwd_email_val+'</div>');  
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Erreur: " + errorThrown); 
                        } 
                    });
                } 
            });
        });

        //------------------------------------- USER --------------------------------------------------------------

        $('body').on('click','.us',function(){
            var user = $(this);
            var us = $(this).text();
            // console.log(us);
            
            $.ajax({
                type: "POST",
                url: "cnx.php",
                datatype: "html",
                data: {action: 'users', user: us},
                success: function(msg)
                {
                    user.replaceWith(msg);
                                   
                }
            });
        });
            
        var idu,val;
        $('body').on('change','.us_in',function(){
            var new_us = $('.us_in');
            val = $(".us_in option:selected").text();
            idu = $(this).val();
            var id = new_us.parents('.item-row').data('id');
            var dataString = {id: id, val: idu, col: ''}; 
            $.ajax({
                type: "POST",
                url: "cnx.php",
                data: {
                    action: 'link', 
                    data: dataString
                },
                success: function(msg)
                {
                    new_us.replaceWith('<div class="us">'+val+'</div>');  
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Erreur: " + errorThrown); 
                } 
            });
        });
        

        //------------------------------------- DATE CREATION --------------------------------------------------------------

        $('body').on('click','.d_crea',function(){
            var d_crea = $(this).text();
            var d_c;
            if (d_crea !== ''){
                d_c = d_crea.split("/").reverse().join("-");
            } else {
                d_c = '';
            }
            console.log(d_crea);
            $(this).replaceWith('<input class="d_crea_in" type="date" value="'+d_c+'" style="border-top: none; border-right: none; border-left:none;" required/>');
            var new_d_crea = $('.d_crea_in');
            new_d_crea.focus();
            
            new_d_crea.focusout(function(){
                console.log(new_d_crea.val());
                var id = new_d_crea.parents('.item-row').data('id');
                var new_d_crea_val = new_d_crea.val(); 
                new_d_crea_val = new_d_crea_val.split("-").reverse().join("/");
                // if(new_d_crea_val !== ''){
                    var dataString = {id: id, val: new_d_crea_val, col: 'date_crea_c'}; 
                    $.ajax({
                        type: "POST",
                        url: "cnx.php",
                        data: {
                            action: 'test', 
                            data: dataString
                        },
                        success: function(msg)
                        {
                            // alert(msg);
                            if (new_d_crea_val ===''){new_d_crea_val = '--';}
                            new_d_crea.replaceWith('<div class="d_crea">'+new_d_crea_val+'</div>');  
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Erreur: " + errorThrown); 
                        } 
                    });
                // } 
            });
        });

        //------------------------------------- DATE MAJ --------------------------------------------------------------

        $('body').on('click','.d_maj',function(){
            var d_maj = $(this).text();
            var d_m; 
            if (d_maj !== ''){
                d_m = d_maj.split("/").reverse().join("-");
            } else {
                d_m = '';
            }
            console.log(d_maj);
            $(this).replaceWith('<input class="d_maj_in" type="date" value="'+d_m+'" style="border-top: none; border-right: none; border-left:none;" required/>');
            var new_d_maj = $('.d_maj_in');
            new_d_maj.focus();
            
            new_d_maj.focusout(function(){
                console.log(new_d_maj.val());
                var id = new_d_maj.parents('.item-row').data('id');
                var new_d_maj_val = new_d_maj.val(); 
                new_d_maj_val = new_d_maj_val.split("-").reverse().join("/");
                // if(new_d_maj_val !== ''){
                    var dataString = {id: id, val: new_d_maj_val, col: 'date_maj_c'}; 
                    $.ajax({
                        type: "POST",
                        url: "cnx.php",
                        data: {
                            action: 'test', 
                            data: dataString
                        },
                        success: function(msg)
                        {
                            // alert(msg);
                            if (new_d_maj_val ===''){new_d_maj_val = '--';}
                            new_d_maj.replaceWith('<div class="d_maj">'+new_d_maj_val+'</div>');  
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Erreur: " + errorThrown); 
                        } 
                    });
                // } 
            });
        });
        
        </script>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>