<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class m_absen extends CI_Model {

	public function displayAbsen() 
		{
			$this->load->database();
			$query = $this->db->query("select b.no_absensi, a.no_induk, a.nama_person, d.waktu_absen as waktu_masuk, c.waktu_absen as waktu_keluar  
				from person a inner join absen b on a.no_induk = b.no_induk 
				inner join keterangan_absen d on b.no_absensi = d.no_absensi
				left join (select b.waktu_absen, b.no_absensi from absen a inner join keterangan_absen b on a.no_absensi = b.no_absensi where keterangan = '2') c on b.no_absensi = c.no_absensi
				where d.keterangan ='1' and b.tanggal_absensi = CURRENT_DATE
				");
			return $query->result();
		}
		
		public function getTanggal() 
		{
			$this->load->database();
			$query = $this->db->query("
				select distinct tanggal_absensi from absen order by tanggal_absensi desc
				");
			return $query->result();
		}
	
		public function editAbsensi($no_absensi) 
		{
			$this->load->database();
			$query = $this->db->query("select b.no_absensi, a.no_induk, a.nama_person, d.waktu_absen as waktu_masuk, c.waktu_absen as waktu_keluar  
				from person a inner join absen b on a.no_induk = b.no_induk 
				inner join keterangan_absen d on b.no_absensi = d.no_absensi
				left join (select b.waktu_absen, b.no_absensi from absen a inner join keterangan_absen b on a.no_absensi = b.no_absensi where keterangan = '2') c on b.no_absensi = c.no_absensi
				where d.keterangan ='1' and d.no_absensi = $no_absensi
				");
			return $query->result();
		}
	
		public function updateAbsensi() 
		{
			$no = $this->input->post('no_absensi');
			$jam = "'".date ('H:i:s' ,time())."'";

			$this->load->database();
		
			if ($keluar = '1')
			{
			$query = $this->db->query("
			insert into keterangan_absen
			values ($no,'2',$jam)
			");
			}
		}
		
		public function displayBelumAbsen() 
		{
			$this->load->database();
			$query = $this->db->query("select person.no_induk, nama_person
			from person left join absen
			ON person.no_induk = absen.no_induk
				");
			return $query->result();
		}
}
?>