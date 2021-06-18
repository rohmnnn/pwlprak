<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function index()
	{
		$konten = $this->load->view('barang/list_barang', null, true);

        $data_json = array (
            'konten' => $konten,
            'title' => 'List Data Barang',
        );

        echo json_encode($data_json);
	}

    public function list_barang()
    {
        $data_barang = $this->Barang_model->get_barang();

        $konten = '<tr>
        <td>Nama</td>
        <td>Deskripsi</td>
        <td>Stok</td>
        <td>Aksi</td>
        </tr>';

        foreach ($data_barang->result() as $key => $value) {
            $konten .= '<tr>
            <td>'.$value->nama_barang.'</td>
            <td>'.$value->deskripsi.'</td>
            <td>'.$value->stok.'</td>
            <td>Read | Hapus | Edit</td>
            </tr>';
        }

        $data_json = array(
            'konten' => $konten
        );

        echo json_encode($data_json);
    }

    public function form_create()
    {
        $data_view = array('title' => 'Form Data Barang New');

        $konten = $this->load->view('barang/form_barang', $data_view, true);

        $data_json = array(
            'konten' => $konten,
            'title' => 'Form Data Barang New',
        );

        echo json_encode($data_json);
    }

    public function form_edit($id_barang)
    {
        $data_view = array('title' => 'Form Edit Barang', 'id_barang' => $id_barang);

        $konten = $this->load->view('barang/form_barang', $data_view, true);

        $data_json = array(
            'konten' => $konten,
            'title' => 'Form Edit Barang',
            'id_barang' => $id_barang,
        );

        echo json_encode($data_json);
    }
}
