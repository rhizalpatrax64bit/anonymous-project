<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_sms extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_sms');
	}

	public function index()
	{
		/*if($this->client_logon)
		{*/
			$data['logs'] = $this->m_sms->getLogs();
			$data['title'] = "Log Pengiriman Pesan";
			$data['pesan'] = 'Anda sudah berhasil login! Klik di sini untuk <a href="http://localhost/school/logout">LOGOUT</a>.';
			$this->load->view('v_header', $data);
			$this->load->view('v_sms', $data);
			$this->load->view('v_footer', $data);
		/*}
		else
		{
			redirect('login');
		}*/
	}
}
?>