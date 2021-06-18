<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
    }

    public function index()
    {
        echo 'mw ap lo?';
    }

    public function list_barang()
    {


        $data_barang = $this->Barang_model->get_barang();

        $konten = '<tr>
        <td>Nama</td>
        <td>Deskripsi</td>
        <td>Stok</td>
        <td>Harga</td></td>
        <td>Nama Admin</td>
        <td>Tanggal</td>
        <td>Aksi</td>
        </tr>';

        foreach ($data_barang->result() as $key => $value) {
            $konten .= '<tr>
            <td>' . $value->nama_barang . '</td>
            <td>' . $value->deskripsi . '</td>
            <td>' . $value->stok . '</td>
            <td>' . $value->harga . '</td>
            <td>' . $value->nama_admin . '</td>
            <td>' . $value->tanggal . '</td>
            <td>Read | <a href="#' . $value->id_barang . '" class="linkHapusBarang">Hapus</a> | <a href="#' . $value->id_barang . '" class="linkEditBarang">Edit</a></td>
            </tr>';
        }

        $data_json = array(
            'konten' => $konten
        );

        echo json_encode($data_json);
    }

    public function create_action()
    {
        $this->db->trans_start();

        $arr_input = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tanggal' => $this->input->post('tanggal'),
            'nama_admin' => $this->input->post('nama_admin'),
            'harga' => $this->input->post('harga'),
        );

        $this->Barang_model->insert_data($arr_input);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Cok');
        } else {
            $this->db->trans_commit();
            $data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil anjay');
        }

        echo json_encode($data_output);
    }

    public function detail()
    {
        $id_barang = $this->input->get('id');
        $data_detail = $this->Barang_model->get_by_id($id_barang);

        if ($data_detail->num_rows() > 0) {
            $data_output = array('sukses' => 'ya', 'detail' => $data_detail->row_array());
        } else {
            $data_output = array('sukses' => 'tidak');
        }

        echo json_encode($data_output);
    }

    public function update_action()
    {
        $this->db->trans_start();

        $id_barang = $this->input->post('id_barang');

        $arr_input = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'deskripsi' => $this->input->post('deskripsi'),
        );

        $this->Barang_model->update_data($id_barang, $arr_input);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal update Cok');
        } else {
            $this->db->trans_commit();
            $data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil update anjay');
        }

        echo json_encode($data_output);
    }

    public function delete_data()
    {
        $this->db->trans_start();

        $id_barang = $this->input->get('id_barang');

        $this->Barang_model->hapus_data($id_barang);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $data_output = array('sukses' => 'tidak', 'pesan' => 'delete gagal');
        } else {
            $this->db->trans_commit();

            $data_output = array('sukses' => 'ya', 'pesan' => 'delete berhasil');
        }

        echo json_encode($data_output);
    }

    public function soft_delete_data()
    {
        $this->db->trans_start();

        $id_barang = $this->input->get('id_barang');

        $this->Barang_model->soft_delete($id_barang);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('sukses' => 'tidak', 'pesan' => 'gagal');
        } else {
            $this->db->trans_commit();
            $data_output = array('sukses' => 'ya', 'pesan' => 'berhasil');
        }

        echo json_encode($data_output);
    }

    public function cari_barang()
    {
        $cari_nama = $this->input->post('cari_nama');
        $cari_deskripsi = $this->input->post('cari_deskripsi');
        $cari_stock = $this->input->post('cari_stock');


        $data_barang = $this->Barang_model->get_barang($cari_nama, $cari_deskripsi, $cari_stock);

        $konten = '<tr>
        <td>Nama</td>
        <td>Deskripsi</td>
        <td>Stok</td>
        <td>Harga</td></td>
        <td>Nama Admin</td>
        <td>Tanggal</td>
        <td>Aksi</td>
        </tr>';

        foreach ($data_barang->result() as $key => $value) {
            $konten .= '<tr>
            <td>' . $value->nama_barang . '</td>
            <td>' . $value->deskripsi . '</td>
            <td>' . $value->stok . '</td>
            <td>' . $value->harga . '</td>
            <td>' . $value->nama_admin . '</td>
            <td>' . $value->tanggal . '</td>
            <td>Read | <a href="#' . $value->id_barang . '" class="linkHapusBarang">Hapus</a> | <a href="#' . $value->id_barang . '" class="linkEditBarang">Edit</a></td>
            </tr>';
        }

        $data_json = array(
            'konten' => $konten
        );

        echo json_encode($data_json);
    }
}
