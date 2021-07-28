<?php

namespace App\Traits;

use App\Classes\DB;
use PDO;

trait ManagerTrait {

    private ?PDO $db;

    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}