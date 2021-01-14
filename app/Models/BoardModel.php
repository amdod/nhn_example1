<?php namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model 
{
    protected $table = 'board';
    protected $primaryKey = 'number';

    protected $createField = 'create_date';
    protected $modifyField = 'modify_date';

    protected $allowedFields = ['title', 'id', 'password','content', 'create_date', 'modify_date'];
}
?>