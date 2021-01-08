<?php namespace App\Models;

use CodeIgniter\Model;

class Testmodel extends Model
{
    public function get_query()    
    {
        $db = \Config\Database::connect();
        $sql = "select * FROM mydb";
        return $db->query($sql);
    }
}