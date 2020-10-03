<?php

require_once './mysql.php';
$db = new PHPMySQLi(
    'localhost',
    'root',
    '',
    'database'
);

// create table if not exists
$table = '
CREATE TABLE IF NOT EXISTS `redirects`  (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `hash` varchar(255) NOT NULL,
    `url` varchar(255) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
';
$db->query($table);

// add http:// to url if doesnt exist
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

// random hash generator
function generateHash() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// handle ?p=...
if(isset($_GET['p'])){
    
    $hash = $_GET['p'];
    // check if it exists in database
    $query = $db->query("SELECT `url` FROM `redirects` WHERE `hash`=? LIMIT 1", [$hash]);
    if($query->num_rows > 0){
        // redirect
        echo $url = $query->fetch_row()[0];die();
        header("Location: ".addhttp($url));
    }else{
        // return to index
        header("Location: ../index.php");
    }
}




// handle request
if(isset($_POST["url"])){
    $url = $_POST["url"];
    $name = $_POST["name"];

    // if no name given generate hash which doesnt exist in database
    if(strlen($name) === 0){
        $name = generateHash();
        while($db->query("SELECT * FROM `redirects` WHERE `hash`=?", [ $name ])->num_rows !== 0){
            $name = generateHash();
        }
    }else{
        // check if given name is not in database
        $n = $db->query("SELECT * FROM `redirects` WHERE `hash`=?", [ $name ])->num_rows;
        if($n > 0){
            $result = [
                "error" => 1
            ];
            echo json_encode($result);
            return;
        }
    }

    // insert url to database and return name
    $query = $db->query("INSERT INTO `redirects`(`url`, `hash`) VALUES (?, ?)", [ $url, $name ]);

    $result = [
        "url" => $url,
        "name" => $name
    ];
    echo json_encode($result);
}

?>