<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPoli extends CI_Model
{
    //manajemen poli
    public function getPoli()
    {
         return $this->db->get('poli');
    }
         
    public function poliWhere($where)
    {
        return $this->db->get_where('poli', $where);
    }
 
    public function simpanPoli($data = null)
    {
        $this->db->insert('poli',$data);
    }

    public function updatePoli($data = null, $where = null)
    {
        $this->db->update('poli', $data, $where);
    }
 
    public function hapusPoli($where = null)
    {
        $this->db->delete('poli', $where);
    }
 
    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
    }
        $this->db->from('poli');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }
 
    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }
 
    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }
 
    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }
 
    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }
    
    //join
    public function joinKategoriPoli($where)
    {
        $this->db->select('*');
        $this->db->from('poli');
        $this->db->join('kategori','kategori.id = poli.id');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getLimitPoli()
    {
        $this->db->limit(1);
        return $this->db->get('poli'); 
    }
}
