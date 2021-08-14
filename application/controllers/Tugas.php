<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

	protected $user = '';

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row();

		if (empty($this->session->userdata('email'))) {
			redirect('auth','refresh');
		}
	}

	public function view($slug = '')
	{
		if ($slug == null) {
			echo '<script>history.back(-1)</script>';
		} else {
			$slug = anti_inject($slug);
			$tugas = $this->db->get_where('tb_tugas', ['slug' => $slug])->row();
			$data = [
				'tugas' => $tugas,
				'title' => 'Tugas ' . $tugas->tugas
			];

			// if (date('d-m-Y H:i', strtotime($tugas->stop_at)) <= date('d-m-Y H:i')) {
			// 	echo 'tutup';
			// } elseif (date('d-m-Y H:i', strtotime($tugas->created_at)) <= date('d-m-Y H:i')) {
			// 	echo 'buka';
			// } else {
			// 	echo 'tunggu';
			// }
			// die;

			$this->load->view('layout/head', $data);
			if ($this->session->userdata('role_id')==1) {
				$this->load->view('admin/side', $data);
			} elseif ($this->session->userdata('role_id')==2) {
				$this->load->view('lecturer/side', $data);
			} elseif ($this->session->userdata('role_id')==3) {
				$this->load->view('student/side', $data);
			}
			$this->load->view('tugas/view', $data);
			$this->load->view('layout/foot', $data);
		}
	}

}

/* End of file Tugas.php */
/* Location: ./application/controllers/Tugas.php */