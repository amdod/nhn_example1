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
        $data = [
            'title' => $this->request->getVar('title'),
            'id' => $this->request->getVar('id'),
            'password' => $this->request->getVar('password'),
            'content' => $this->request->getVar('content'),
            'create_date' => $this->request->getVar(CURRENT_TIMESTAMP),
            'modify_date' => $this->request->getVar(CURRENT_TIMESTAMP)
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response);
    }

    public function update($number = null)
    {
        $model = new BoardModel();
        
        if ($this->request->getVar('password') == $model->find($number)->password) {
            $input = $this->request->getRawInput();
            $data = [
                'title' => $this->request->getVar('title'),
                'content' => $this->request->getVar('content'),
                'modify_date' => $this->request->getVar(CURRENT_TIMESTAMP)
            ];
            $model->update($number, $data);
            $response = [
             'status'   => 200,
             'error'    => null,
             'messages' => [
                    'success' => 'Data Updated'
                ]
            ];
            return $this->respond($response); 
        }
        else {
            return $this->failNotFound('Incorrect Password;.');
        }
    }

    public function delete($number = null)
    {
        $model = new BoardModel();
        $data = $model->find($number);
        if($data){
            $model->delete($number);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with number '.$number);
        }
         
    }

	//--------------------------------------------------------------------

}