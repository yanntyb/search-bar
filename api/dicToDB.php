<?php

session_start();

use App\Manager\DicManager;

require_once $_SERVER["DOCUMENT_ROOT"] . "/class/DB.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Trait/ManagerTrait.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Manager/DicManager.php";



if(!isset($_SESSION["dic"])){
    $dic = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/misc/liste_francais.txt");
    $dic = explode("\n", $dic);
    $_SESSION["dic"] = $dic;
}



$manager = new DicManager();

$lastInserted = getWordIndex($manager->getLastInserted()["mot"], $_SESSION["dic"]);

if($lastInserted === count($_SESSION["dic"])){
    echo json_encode(["mot" => "Insertion fini"]);
}
else{
    echo json_encode([
            "mot" => $manager->insertToDB($_SESSION["dic"][$lastInserted + 1]),
            "stat" => $lastInserted . " / " . count($_SESSION["dic"])
        ]
    );
}




function getWordIndex(string $word, array $dic): int{
    return array_search($word,$dic);
}