<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaderboard extends CI_Controller {

	protected $user = '';

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row();

		if (empty($this->session->userdata('email'))) {
			redirect('auth','refresh');
		}
	}

	public function index()
	{
		$this->db->limit(10);
		$this->db->order_by('skor', 'desc');
		$mahasiswa = $this->db->get_where('tb_users', ['role_id' => 3])->result();

		$data = [
			'title' => 'Leaderboard',
			'user' => $this->user,
			'mahasiswa' => $mahasiswa
		];

		$this->load->view('layout/head', $data);
		if ($this->session->userdata('role_id')==1) {
			$this->load->view('admin/side', $data);
		} elseif ($this->session->userdata('role_id')==2) {
			$this->load->view('lecturer/side', $data);
		} elseif ($this->session->userdata('role_id')==3) {
			$this->load->view('student/side', $data);
		}
		$this->load->view('leaderboard/home', $data);
		$this->load->view('layout/foot', $data);
	}

}

/* End of file Leaderboard.php */
/* Location: ./application/controllers/Leaderboard.php */