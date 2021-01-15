<?php namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model 
{
    protected $table = 'board';
    protected $primaryKey = 'number';

    //protected $useTimestamps = true;

    protected $allowedFields = ['title', 'id', 'password','content', 'create_date', 'modify_date'];
}
?>