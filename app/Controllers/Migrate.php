<?php

namespace App\Controllers;

use Config\Database;
use Exception;

class Migrate extends BaseController
{
    public function index()
    {
        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
            return "Migrations successful! <br><a href='/html/index.html'>Go back to Dashboard</a>";
        } catch (Exception $e) {
            return "Migration failed: " . $e->getMessage() . "<br><a href='/html/index.html'>Go back to Dashboard</a>";
        }
    }
}
