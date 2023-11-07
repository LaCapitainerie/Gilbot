<?php

$bdd = include('bdd.php');

$sql = "SELECT id_user FROM users WHERE secure = :secure;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":secure" => $_SESSION['secure']));
$user = $stmt->fetch();

$sql = "SELECT COUNT(id_playlist) FROM playlist JOIN users USING(id_user) WHERE playlist.name = :id;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id" => $_POST['name']));
$verif = intval($stmt->fetch()[0])==0;

if($verif){
    
    $sql = "INSERT INTO `playlist`(`Name`, `Description`, `Cover`, `Duration`, `id_user`, `ispublic`) VALUES( :nom , :desc , :img , '0' , :id, :public);";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        ":nom" => $_POST['name'],
        ":desc" => $_POST['desc'],
        ':img' => $_POST['img'],
        ":id" => $user['id_user'],
        ":public" => ($_POST['public']=="on")
    ));

    
    $sql = "INSERT INTO `sub_sidebar`(`id_sidebar`, `name`, `redirect`, `ispublic`) VALUES (2 , :nom , 'get('view.php?v=1')', :public );";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        ":nom" => $_POST['name'],
        ":public" => ($_POST['public']=="on")
    ));
    
    header('location: ../html/playlist.php');
    exit;

};

header('location: ../html/playlist.php?ex=1');
exit;

?>