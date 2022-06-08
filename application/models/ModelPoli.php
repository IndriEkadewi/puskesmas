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

    //manajemen dokter
    public function getDokter()
    {
         return $this->db->get('dokter');
    }
         
    public function DokterWhere($where)
    {
        return $this->db->get_where('dokter', $where);
    }
 
    public function simpanDokter($data = null)
    {
        $this->db->insert('dokter',$data);
    }

    public function updateDokter($data = null, $where = null)
    {
        $this->db->update('dokter', $data, $where);
    }
 
    public function hapusDokter($where = null)
    {
        $this->db->delete('dokter', $where);
    }

    //join
    public function joinDokterPoli($where)
    {
        $this->db->select('*');
        $this->db->from('poli');
        $this->db->join('dokter','dokter.id = poli.id');
        $this->db->where($where);
        return $this->db->get();
    }
}