<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class ModelPeriksa extends CI_Model {
   // Manipulasi model periksa
   public function simpanPeriksa($data) {
      $this->db->insert('periksa', $data);
   }

   public function selectData($table, $where) {
      return $this->db->get($table, $where);
   }

   public function updateData($data, $where) {
      $this->db->update('periksa', $data, $where);
   }

   public function deleteData($table, $where) {
      $this->db->delete($table, $where);
   }

   public function joinData() {
      $this->db->select('*');
      $this->db->from('periksa');
      $this->db->join('detail_periksa', 'detail_periksa.no_periksa=periksa.no_periksa', 'Right');
      return $this->db->get()->result_array();
   }

   // Manipulasi tabel detail periksa
   public function simpanDetail($idbooking, $noperiksa) {
      $sql = "INSERT INTO detail_periksa (no_periksa, id_poli) SELECT periksa.no_periksa, booking_detail.id_poli FROM periksa, booking_detail WHERE booking_detail.id_booking=$idbooking AND periksa.no_periksa='$noperiksa'";
      $this->db->query($sql);
   }
}