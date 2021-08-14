<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

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
			$data = [
				'materi' => $this->db->get_where('tb_materi', ['slug' => $slug])->row(),
			];

			$data['title'] = 'Materi ' . $data['materi']->materi;

			$this->load->view('layout/head', $data);
			if ($this->session->userdata('role_id')==1) {
				$this->load->view('admin/side', $data);
			} elseif ($this->session->userdata('role_id')==2) {
				$this->load->view('lecturer/side', $data);
			} elseif ($this->session->userdata('role_id')==3) {
				$this->load->view('student/side', $data);
			}
			$this->load->view('materi/view', $data);
			$this->load->view('layout/foot', $data);
		}
	}

}

/* End of file Materi.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Materi.php */