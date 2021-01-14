<?php namespace App\Controllers;

use App\Models\BoardModel;

class Home extends BaseController
{
	public function index()
	{
		return view('boardlist');
	}

	public function boardview()
	{
		return view('boardview');
	}

	public function boardwrite()
	{
		return view('boardwriter');
	}

	public function boardmodify()
	{
		return view('boardmodifier');
	}



	//--------------------------------------------------------------------

}
