<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>contact details page - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    margin-top:20px;
    background:#f5f7fa;
}
.panel.panel-default {
    border-top-width: 3px;
}
.panel {
    box-shadow: 0 3px 1px -2px rgba(0,0,0,.14),0 2px 2px 0 rgba(0,0,0,.098),0 1px 5px 0 rgba(0,0,0,.084);
    border: 0;
    border-radius: 4px;
    margin-bottom: 16px;
}
.thumb96 {
    width: 96px!important;
    height: 96px!important;
}
.thumb48 {
    width: 48px!important;
    height: 48px!important;
}
    </style>
</head>
<body>
<div class="container bootstrap snippet">
<div class="row ng-scope">
    <div class="col-md-12">
        
                <div class="pull-right">
                    <div class="btn-group dropdown" uib-dropdown="dropdown">
                        <button class="btn btn-link dropdown-toggle" uib-dropdown-toggle="" aria-haspopup="true" aria-expanded="false"><em class="fa fa-ellipsis-v fa-lg text-muted"></em></button>
                        <ul class="dropdown-menu dropdown-menu-right animated fadeInLeft" role="menu">
                            <li><a href=""><span>Send by message</span></a></li>
                            <li><a href=""><span>Share contact</span></a></li>
                            <li><a href=""><span>Block contact</span></a></li>
                            <li><a href=""><span class="text-warning">Delete contact</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="h4 text-center">Modifier Compte </div>
                <div class="row pv-lg">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form class="form-horizontal ng-pristine ng-valid">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact1">Compte</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="inputContact1" type="text" placeholder="https://twitter.com/exemple" value="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact3">Mot de passe compte</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="inputContact3" type="password" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact2">Email</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="inputContact2" type="email" value="" placeholder="mail@example.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact3">Mot de passe e-mail</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="inputContact3" type="password" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact5">Date de création</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="inputContact5" type="date" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputContact4">Attribuer à</label>
                                <div class="col-sm-8">
                                    <select class="custom-select form-control">
                                        <option selected>Choisissez un utilisateur</option>
                                        <?php 
                                        require('cnx.php');
                                        $users = getAllSimpleUsers($con);
                                        foreach($users as $user){
                                            echo '<option value="'.$user['id_u'].'">'.$user['nom_u'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 right">
                                    <button class="btn btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

    </div>
</div>
</div>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>