<?php
require_once("./Game.php");
require_once("./model.php");
require('./keys.php');
$f = file_get_contents('./data/sample_urls.csv');
$urls = explode(",", rtrim($f, "\n"));

try{
    $dm = new Dobutushogi_model(new PDO(DB_DSN, DB_USER, DB_PASS));
} catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

foreach ($urls as $url) {
    $ga = new Game($url);
    echo "{$ga->black_level} - {$ga->white_level} \n";
    echo "WIN: " . ($ga->win == HAND_BLACK ? "●" : ($ga->win == HAND_WHITE ? "○" : "引き分け")) . PHP_EOL;
    $moves = $ga->dump_moves();
    $dm->regist_moves($moves);
}
die('exit');
