<?php

namespace App\Controllers;

use App\Models\UserModel;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Reader\Csv;
use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Home extends BaseController {


    public function index() {
        echo view( 'layouts/header' );
        echo view( 'users/index' );
        echo view( 'layouts/footer' );
    }

    public function list() {
        $request = $this->request->getPost();
        $jsonArray = array();
        $jsonArray['draw'] = intval( $request['draw'] );
        $columns = array(
            0 => 'name',
            1 => 'email',
            2 => 'phone',
            3 => 'address',
            4 => 'created_at'
        );
        $column = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];
        $offset = $request['start'];
        $limit = $request['length'];

        $users = new UserModel();
        $jsonArray['recordsTotal'] = $users->countAllResults();
        if ( $request['search']['value'] ) {
            $search = $request['search']['value'];
            $users = $users->Like( 'name', $search );
            $users = $users->orLike( 'email', $search );
            $users = $users->orLike( 'phone', $search );
            $users = $users->orLike( 'address', $search );
        }
        $jsonArray['recordsFiltered'] = $users->countAllResults();
        $users = $users->orderby( $column, $dir );
        $users = $users->limit( $limit, $offset)->find();
        $jsonArray['data'] = array();
        foreach ( $users as $user ) {
            $jsonObject = array();
            $jsonObject[] = $user['name'];
            $jsonObject[] = $user['email'];
            $jsonObject[] = $user['phone'];
            $jsonObject[] = $user['address'];
            $jsonObject[] = '<button class="px-2 py-1 bg-red-400 hover:bg-red-600 rounded text-white" onclick="deleteData('.$user['id'].')"> Delete </button>';
            $jsonArray['data'][] = $jsonObject;
        }
        echo json_encode( $jsonArray );
        exit();
    }

    public function import() {
        $arr_file = explode('.', $_FILES['excel']['name']);
        $extension = end($arr_file);
        if('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        if (!empty($sheetData)) {
            for ($i=1; $i<count($sheetData); $i++) {
                $store = [
                    'name' => $sheetData[$i][0],
                    'email' => $sheetData[$i][1],
                    'phone' => $sheetData[$i][2],
                    'address' => $sheetData[$i][3],
                    'created_at' => date("Y-m-d"),
                    'updated_at' => date("Y-m-d")
                ];
                $users = new UserModel();
                $users->insert($store);
            }
        }
        return redirect()->to('/');
    }

    public function userDelete() {
        $users = new UserModel();
        $users = $users->where('id', $_REQUEST['user_id'])->delete();
    }
}
