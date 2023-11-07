<?php
session_start();


$bdd = include('bdd.php');

if(isset($_POST["discord_id"]) and $_POST["discord_id"]!="" and FALSE){
    $json = json_decode(file_get_contents('https://discordlookup.mesavirep.xyz/v1/user/'.$_POST["discord_id"]), true);
    $_POST["user"] = $json["global_name"];
    $_POST["pp"] = $json["avatar"]["link"];
    $_POST["tag"] = $json["tag"];
};

var_dump($_POST);

if($bdd != "error"){
    $sql = "SELECT * FROM users WHERE username=:id AND pwd=:pwd LIMIT 1;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":id" => $_POST['user'], ":pwd" => $_POST['pwd']));
    $users = $stmt->fetchAll();

    if(count($users)==0){
        function rdstr($length = 10) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        };

        $secure = rdstr(15);
        
        echo "+".$_POST['user']."+".$_POST['pwd']."+".$secure;

        $sql = "INSERT INTO users(username, pwd, pp, discord_id, secure, tag) VALUES (:id, :pwd, :pp, :di, :secure, :tag)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(
            ":id" => $_POST['user'] || "User",
            ":pwd" => $_POST['pwd'],
            ":pp" => $_POST['pp'],
            ":di" => (isset($_POST['discord_id'])?$_POST['discord_id']:0),
            ":secure" => $secure,
            ":tag" => (isset($_POST['tag'])?$_POST['tag']:0),
        ));

        echo "test";

        $_SESSION['secure'] = $secure;
    } else {
        $_SESSION['secure'] = $users[0]['secure'];
    };

    if($_POST['remember'] == "on"){
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie("secure", $_SESSION['secure'], time()+60*60*24*365, '/', $domain, false);
        $_COOKIE["secure"] = $_SESSION['secure'];
        
    };
};

header('location: ../Html/');
exit;

?>