<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BoardModel;


class BoardController extends ResourceController
{
    use ResponseTrait;

	public function index()
	{
        $model = new BoardModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function board($number = null)
    {
        $model = new BoardModel();
        $data = $model->find($number);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with number '.$number);
        }
    }

    public function create()
    {
        $model = new BoardModel();
        $result = $model->insert($_POST);

        return $this->respondCreated($result);
    }

    public function update($number = null)
    {
        $model = new BoardModel();
        
        //if ($this->request->getVar('password') == $model->find($number)->password) {
        $result = $model->update($number, $_POST);

        return $this->respond($result); 
        //}
        //else {
        //    return $this->failNotFound('Incorrect Password;.');
        //}
    }

    public function delete($number = null)
    {
        $model = new BoardModel();
        $data = $model->find($number);
        if($data){
            $result = $model->delete($number);
            
            return $this->respondDeleted($result);
        }else{
            return $this->failNotFound('No Data Found with number '.$number);
        }
         
    }

	//--------------------------------------------------------------------

}