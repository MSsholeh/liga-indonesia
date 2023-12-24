<?php namespace App\Controllers;

use App\Models\ClubModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Club extends BaseController
{
	public function index()
	{
        $club = new ClubModel();
        $data['clubs'] = $club->where('deleted_at', NULL)->orderBy('created_at', 'DESC')->findAll();

        $data['title'] = 'List Club';
		echo view('club/index', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            ['name' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            $club = new ClubModel();
            $logo = $this->request->getFile('logo');
		    $fileName = $logo->getRandomName();
            $logo->move('uploads/logo/', $fileName);
            $club->insert([
                "name"  => $this->request->getPost('name'),
                "slug"  => url_title($this->request->getPost('name'), '-', TRUE),
                "photo" => $fileName
            ]);
            session()->setFlashdata('success', 'Data Inserted Successfully !');
        }else{
            session()->setFlashdata('error', 'Data Inserted Error !');
        }
        return redirect()->to('/clubs');
    }

    public function edit($slug)
    {
        $club = new ClubModel();
        $post = $club->where('slug', $slug)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'name' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            if(!empty($_FILES['logo']['name'])){
                $logo = $this->request->getFile('logo');
                $fileName = $logo->getRandomName();
                $logo->move('uploads/logo/', $fileName);
            }else{
                $fileName = $post['photo'];
            }
            $club->update($post['id'], [
                "name"  => $this->request->getPost('name'),
                "slug"  => url_title($this->request->getPost('name'), '-', TRUE),
                "photo" => $fileName
            ]);
             session()->setFlashdata('success', 'Data Updated Successfully !');
        }else{
            session()->setFlashdata('error', 'Data Updated Error !');
        }

        return redirect()->to('/clubs');
    }

	public function delete($slug){
        $club = new ClubModel();
        $post = $club->where('slug', $slug)->first();
        if (isset($post)) {
            $club->delete($post['id']);
            session()->setFlashdata('success', 'Data Deleted Successfully !');
        }else{
            session()->setFlashdata('error', 'Data Deleted Error !');
        }

        return redirect()->to('/clubs');
    }
}
