<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Testmodel;


class Mysqltest extends Controller
{
    public function index()
    {
        $testtable = new Testmodel();
        $qry = $testtable->get_query();
        foreach($qry->getResult() as $row)
        {
            echo $row->id . "<br/>";
            echo $row->name . "<br/>";
            echo "<hr/>";
        }
    }
}