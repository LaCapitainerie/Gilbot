<?php

session_start();
$bdd = include('bdd.php');

if($bdd != "error"){
    $sql = "SELECT * FROM users WHERE username=:id AND pwd=:pwd LIMIT 1;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":id" => $_POST['user'], ":pwd" => $_POST['pwd']));
    $users = $stmt->fetchAll();

    echo "A";

    if(count($users)==0){
        function rdstr($length = 10) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        };

        echo "B";

        $secure = rdstr(15);
        
        echo "+".$_POST['user']."+".$_POST['pwd']."+".$secure;

        $sql = "INSERT INTO users(username, pwd, secure) VALUES (:id, :pwd, :secure)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":id" => $_POST['user'], ":pwd" => $_POST['pwd'], ":secure" => $secure));
        $_SESSION['secure'] = $secure;

        echo "C";
    } else {
        $_SESSION['secure'] = $users[0]['secure'];
        echo "D";
    };

    if($_POST['remember'] == "on"){
        echo "E";
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie("secure", $_SESSION['secure'], time()+60*60*24*365, '/', $domain, false);
        $_COOKIE["secure"] = $_SESSION['secure'];
        
    };
};
header('location: ../Html/');
exit;

?>