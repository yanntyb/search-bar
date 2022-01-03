<?php

namespace App\Manager;

use App\Traits\ManagerTrait;

class DicManager
{
    use ManagerTrait;

    public function getLastInserted(){
        $conn = $this->db->prepare("SELECT * FROM mots ORDER BY id DESC LIMIT 1");
        $conn->execute();
        return $conn->fetch();
    }

    public function deleteLastInserted(){
        $conn = $this->db->prepare("DELETE FROM mots WHERE id = :id");
        $conn->bindValue(":id", $this->getLastInserted()["id"]);
        $conn->execute();
    }

    public function isInDB(string $word): bool{
        $conn = $this->db->prepare("SELECT id FROM mots WHERE mot = :mot");
        $conn->bindValue(":mot", $word);
        $conn->execute();
        if($conn->fetch()){
            return true;
        }
        return false;
    }

    public function insertToDB(string $mot){
        if(!$this->isInDB($mot)){
            $conn = $this->db->query("INSERT INTO mots (mot) VALUES (:mot)");
            $conn->bindValue(":mot", $mot);
            $conn->execute();
            return $mot . " inséré";
        }
        else{
            return $mot . " deja inséré";
        }
    }

    public function createTable(): bool{
        $conn = $this->db->prepare("CREATE TABLE IF NOT EXISTS mots (id INTEGER PRIMARY KEY AUTOINCREMENT, mot VARCHAR( 255 ))");
        return $conn->execute();
    }

    public function wordMatch(string $word): array{
        $conn = $this->db->prepare("SELECT mot FROM mots WHERE mot LIKE :word ORDER BY id ASC LIMIT 5");
        $conn->bindValue(':word', $word . "%");
        $conn->execute();
        $result = [];
        foreach($conn->fetchAll() as $word){
            $result[] = $word;
        }
        return $result;
    }
}