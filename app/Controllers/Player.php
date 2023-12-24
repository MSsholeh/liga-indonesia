<?php namespace App\Controllers;

use App\Models\PlayerModel;
use App\Models\ClubModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Player extends BaseController
{
	public function index()
	{
        $player = new PlayerModel();
        $club = new ClubModel();
        $data['players'] = $player->getPlayer();
        $data['clubs'] = $club->where('deleted_at', NULL)->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'List Player';
		echo view('player/index', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            ['name' => 'required',
             'club_id' => 'required',
             'birth_date' => 'required',
             'back_number' => 'required',
             'position' => 'required',
             'country' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            $player = new PlayerModel();
            $clubs = new ClubModel();

            $count = $player->where('club_id', $this->request->getPost('club_id'))->countAllResults();
            $club = $clubs->where('id', $this->request->getPost('club_id'))->first();

            if($count<=30){
                $photo = $this->request->getFile('photo');
                $fileName = $photo->getRandomName();
                $photo->move('uploads/photo/', $fileName);
                $player->insert([
                    "club_id"  => $this->request->getPost('club_id'),
                    "name"  => $this->request->getPost('name'),
                    "birth_date"  => $this->request->getPost('birth_date'),
                    "back_number"  => $this->request->getPost('back_number'),
                    "position"  => $this->request->getPost('position'),
                    "country"  => $this->request->getPost('country'),
                    "slug"  => url_title($this->request->getPost('name'), '-', TRUE),
                    "photo" => $fileName
                ]);
                session()->setFlashdata('success', 'Data Inserted Successfully !');
            }else{
                session()->setFlashdata('info', 'Data Player on '.$club['name'].' Club more than 30 Data !');
            }
        }else{
            session()->setFlashdata('error', 'Data Inserted Error !');
        }
        return redirect()->to('/players');
    }

    public function edit($slug)
    {
        $player = new PlayerModel();
        $post = $player->where('slug', $slug)->first();

        $validation = \Config\Services::validation();
        $validation->setRules(
            ['name' => 'required',
             'club_id' => 'required',
             'birth_date' => 'required',
             'back_number' => 'required',
             'position' => 'required',
             'country' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            if(!empty($_FILES['photo']['name'])){
                $photo = $this->request->getFile('photo');
                $fileName = $photo->getRandomName();
                $photo->move('uploads/photo/', $fileName);
            }else{
                $fileName = $post['photo'];
            }
            $player->update($post['id'], [
                "club_id"  => $this->request->getPost('club_id'),
                "name"  => $this->request->getPost('name'),
                "birth_date"  => $this->request->getPost('birth_date'),
                "back_number" => $this->request->getPost('back_number'),
                "position"  => $this->request->getPost('position'),
                "country"  => $this->request->getPost('country'),
                "slug"  => url_title($this->request->getPost('name'), '-', TRUE),
                "photo" => $fileName
            ]);
             session()->setFlashdata('success', 'Data Updated Successfully !');
        }else{
            session()->setFlashdata('error', 'Data Updated Error !');
        }

        return redirect()->to('/players');
    }

	public function delete($slug){
        $player = new PlayerModel();
        $post = $player->where('slug', $slug)->first();
        if (isset($post)) {
            $player->delete($post['id']);
            session()->setFlashdata('success', 'Data Deleted Successfully !');
        }else{
            session()->setFlashdata('error', 'Data Deleted Error !');
        }

        return redirect()->to('/players');
    }
}
