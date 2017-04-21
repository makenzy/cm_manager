<?php
$con = mysqli_connect("localhost","root","280884","cm_manager");
if (mysqli_connect_errno())
{
    echo "Connexion Impossible : " . mysqli_connect_error();
    die();
} else {
    // echo "Connexion établie";
}
//print_r('<pre>');
//print_r($users);
//print_r('</pre>');
if(!empty($_POST['action'])){
    switch ($_POST['action']){
        case 'users':
            $users = getAllSimpleUsers($con);
            $select = '<select class="cm custom-select us_in" style="width:100%;">
                <option value="--">--</option>';
            foreach($users as $user){
                $id = $user['id_u'];
                $nom = $user['nom_u']; 
                if($nom == $_POST['user']){
                    $selected = ' selected';
                } else {
                    $selected = '';
                }
                $select.='<option value="'.$id.'"'.$selected.'>'.$nom.'</option>';
            }
            $select .= '</select>';
            echo $select;
            break;

    }
}
function getAllCat ($cnx){
    $q = "select * from categorie";
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    } else {
        $data = "Pas de données !";
    }
return $data;
mysqli_free_result($r);
}

function getAllCpts ($cnx){
    $q = "select * from compte";
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    } else {
        $data = "Pas de données !";
    }
return $data;
mysqli_free_result($r);
}


function getCptData($cnx,$idcpt){
    $q = "select * from compte where id_c = ".$idcpt;
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    }
return $data;
mysqli_free_result($r);
}


function addCpt ($cnx,$data){
    $tmp = explode('https://twitter.com/',$data['lien']);
    $screenName = $tmp[1];
    $datec = date("d/m/Y", strtotime($data['datec']));
    $link = mysqli_real_escape_string($cnx, $data['lien']);
    $pass = mysqli_real_escape_string($cnx, $data['pwd']);
    $mail = mysqli_real_escape_string($cnx, $data['email']);
    $passmail = mysqli_real_escape_string($cnx, $data['pwd_email']);
    $dc = mysqli_real_escape_string($cnx, $datec);
    $nom =  mysqli_real_escape_string($cnx, $screenName); 
    
    $q = "INSERT INTO compte(lien_c, pwd_c, email_c, pwd_email_c, date_crea_c, nom_c) VALUES 
    ('{$link}','{$pass}','{$mail}','{$passmail}','{$dc}', '{$nom}')";
    $r = mysqli_query($cnx, $q);
    

    if ($r) {
        $last_id = mysqli_insert_id($cnx);
        
        if($data['user'] !== 'x'){ // nouveau compte + user affecté
            echo $retour = add_editLink($cnx,$last_id,$data['user']);
            if ($retour == 'success'){
                $result = "op=success";
            }else{
                $result = "op=erreur";
            }
        } else {
            $result = "op=success";
        }
            
    } else {
        $result = "op=erreur";
    }
    mysqli_free_result($r);
    header("Location: https://cm.ureputation.net/add-account.php?".$result);
    die();
}

function majCpt ($cnx,$idcpt,$data){
    $datec = date("d/m/Y", strtotime($data['datec']));
    $link = mysqli_real_escape_string($cnx, $data['lien']);
    $pass = mysqli_real_escape_string($cnx, $data['pwd']);
    $mail = mysqli_real_escape_string($cnx, $data['email']);
    $passmail = mysqli_real_escape_string($cnx, $data['pwd_email']);
    $dc = mysqli_real_escape_string($cnx, $datec);  

    $q = "UPDATE compte SET lien_c='{$link}',pwd_c='{$pass}',email_c='{$mail}',pwd_email_c='{$passmail}',date_crea_c='{$dc}' WHERE id_c = ".$idcpt;
    $r = mysqli_query($cnx, $q);
    if ($r) {
        $retour = add_editLink($cnx,$idcpt,$data['user']);
        if ($retour == 'success'){
            $result = "op=success";
        }else{
            $result = "op=erreur";
        }
    } else {
        $result = "op=erreur";
    }
    mysqli_free_result($r);
    header("Location: edit-account.php?id=".$idcpt."&".$result);
    die();
}


function delCpt ($cnx,$id){
    $q = "DELETE FROM compte WHERE id_c = ".$id;
    $r = mysqli_query($cnx, $q);
    if ($r) {
        $result = "op=success";    
    } else {
        $result = "op=erreur";
    }
    mysqli_free_result($r);
    header("Location: https://cm.ureputation.net/accounts-list.php?".$result);
    die();
}

function getLinkedUser ($cnx,$idcpt){
    $q = "select nom_u,id_u from user where id_u = (select id_user from link where id_compte = ".$idcpt.")";
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
        $data['nom_u'] =  $data[0]['nom_u'];
    } else {
        $data = array();
        $data['nom_u'] = "--";
    }
return $data;
mysqli_free_result($r);
}

function add_editLink($cnx,$idcpt,$iduser){
    // echo $idcpt.'+++'.$iduser;
    $q = "select * from link where id_compte = ".$idcpt;
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
        $data = $data[0];
        if ($iduser == 'x') {
            $qdel = "DELETE FROM link WHERE id_compte = {$idcpt}";
            $r = mysqli_query($cnx, $qdel); 
            if ($r) {
                return "success";
                die();    
            } else {
                return "erreur";
                die();
            }
        
        }else{
            $qmaj = "UPDATE link SET id_user={$iduser} WHERE id_compte = {$idcpt}";
            $r = mysqli_query($cnx, $qmaj); 
            if ($r) {
                return "success";
                die();    
            } else {
                return "erreur";
                die();
            }
        } 
        
    } else if ($nbr == 0) {
        if ($iduser !== 'x') {
            $qnew = "INSERT INTO link(id_compte, id_user) VALUES ({$idcpt},{$iduser})";
            $r = mysqli_query($cnx, $qnew); 
            if ($r) {
                return "success";
                die();    
            } else {
                return "erreur";
                die();
            }
        }
    }
// return $data;
mysqli_free_result($r);
}

function getAllUsers ($cnx){
    $q = "select * from user";
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    } else {
        $data = "Pas de données !";
    }
return $data;
mysqli_free_result($r);
}

function getAllSimpleUsers ($cnx){
    $q = "select * from user where type_u='user'";
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    } else {
        $data = "Pas de données !";
    }
return $data;
mysqli_free_result($r);
}

function getUserData($cnx,$iduser){
    $q = "select * from user where id_u = ".$iduser;
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    }
return $data;
mysqli_free_result($r);
}

function addUser ($cnx,$data){
    $nom = mysqli_real_escape_string($cnx, ucfirst($data['name']));
    $pwd = mysqli_real_escape_string($cnx, $data['password']);
    $mail = mysqli_real_escape_string($cnx, $data['email']);
    
    
    $q = "INSERT INTO user(type_u, email_u, pwd_u, nom_u) VALUES 
    ('user','{$mail}','{$pwd}','{$nom}')";
    $r = mysqli_query($cnx, $q);
    
    if ($r) {
        $result = "op=success";   
    } else {
        $result = "op=erreur";
    }
    mysqli_free_result($r);
    header("Location: add-user.php?".$result);
    die();
}

function majUser ($cnx,$iduser,$data){
    $nom = mysqli_real_escape_string($cnx, $data['name']);
    $mail = mysqli_real_escape_string($cnx, $data['email']);
    $pass = mysqli_real_escape_string($cnx, $data['password']);
    

    $q = "UPDATE user SET nom_u ='{$nom}',pwd_u='{$pass}',email_u='{$mail}' WHERE id_u = ".$iduser;
    $r = mysqli_query($cnx, $q);
    if ($r) {
        $result = "op=success";
    } else {
        $result = "op=erreur";
    }
    mysqli_free_result($r);
    header("Location: edit-user.php?id=".$iduser."&".$result);
    die();
}

function delUser ($cnx,$id){
    $q = "DELETE FROM user WHERE id_u = ".$id;
    $r = mysqli_query($cnx, $q);
    if ($r) {
        $result = "op=success";    
    } else {
        $result = "op=erreur";
    }
    mysqli_free_result($r);
    header("Location: users-list.php?".$result);
    die();
}

function getUserCpts ($cnx,$idu){
    $q = "select * from compte where id_c in (select id_compte from link where id_user = ".$idu.")";
    $r = mysqli_query($cnx, $q);
    $nbr = mysqli_num_rows($r);
    if ($nbr > 0) {
        $data = mysqli_fetch_all($r,MYSQLI_ASSOC);
    } else {
        $data = "Pas de données !";
    }
return $data;
mysqli_free_result($r);
}

?>