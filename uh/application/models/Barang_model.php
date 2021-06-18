<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model 
{
    
    public function get_barang($cari_nama = '', $cari_deskripsi='', $cari_stock='')
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('status_delete', 0);

        if($cari_nama != '' && $cari_nama != null) {
            $this->db->like('nama_barang', $cari_nama);
        }

        if($cari_deskripsi != '' && $cari_deskripsi != null) {
            $this->db->like('deskripsi', $cari_deskripsi);
        }

        if($cari_stock != '' && $cari_stock != null) {
            $this->db->where('stok <=', $cari_stock);
        }


        return $this->db->get();
    }

    public function insert_data($data)
    {
        $this->db->insert('barang', $data);
    }

    function get_by_id($id_barang)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get();
    }

    public function update_data($id_barang, $data)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $data);
    }

    public function hapus_data($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }

    public function soft_delete($id_barang)
    {
        $data = array(
            'status_delete' => 1,
        );

        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $data);
    }
}