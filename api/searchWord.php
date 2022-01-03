<?php

session_start();

use App\Manager\DicManager;

require_once $_SERVER["DOCUMENT_ROOT"] . "/class/DB.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Trait/ManagerTrait.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Manager/DicManager.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

$manager = new DicManager();

switch($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        echo json_encode(match($data->word, $manager));
        break;
    default:
        break;
}

function match(string $word, DicManager $manager): array{
    $return = [];
    foreach($manager->wordMatch($word) as $wordMatched){
        $return[] = [
            "word" => $wordMatched["mot"]
        ];
    }
    return $return;
}