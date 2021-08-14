<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	protected $user = '';

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row();

		if (empty($this->session->userdata('email'))) {
			redirect('auth','refresh');
		} elseif ($this->user->nim == '') {
			redirect('profil','refresh');
		} elseif ($this->session->userdata('role_id') != 1) {
			echo '<script>history.back(-1)</script>';
		}
	}

	public function index()
	{
		$pemateri = $this->db->get_where('tb_users', ['role_id' => 2])->num_rows();
		$peserta = $this->db->get_where('tb_users', ['role_id' => 3])->num_rows();
		$materi = $this->db->get('tb_materi')->num_rows();
		$tugas = $this->db->get('tb_tugas')->num_rows();
		$study = $this->db->get('tb_study')->num_rows();

		$data = [
			'title' => 'Home',
			'pemateri' => $pemateri,
			'peserta' => $peserta,
			'study' => $study,
			'materi' => $materi,
			'tugas' => $tugas,
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function kelas()
	{
		$data = [
			'title' => 'Kelas'
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/kelas/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function lecturer()
	{
		$data = [
			'title' => 'Pemateri'
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/lecturer/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function mahasiswa()
	{
		$query = "SELECT tb_users.*, tb_kelas.kelas AS desc_kelas FROM tb_users JOIN tb_kelas ON tb_users.kelas = tb_kelas.id_kelas WHERE tb_users.role_id = 3";
		$mahasiswa = $this->db->query($query)->result();

		$data = [
			'title' => 'Mahasiswa',
			'mahasiswa' => $mahasiswa
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/mahasiswa/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function study()
	{
		$data = [
			'title' => 'Bidang Study'
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/study/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function materi()
	{
		$query = "SELECT tb_materi.*, tb_study.study as desc_study FROM tb_materi JOIN tb_study ON tb_materi.study = tb_study.id_study";
		$materi = $this->db->query($query)->result();

		$data = [
			'title' => 'List Materi',
			'materi' => $materi
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/materi/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugas()
	{
		$query = "SELECT tb_tugas.*, tb_study.study as desc_study FROM tb_tugas JOIN tb_study ON tb_tugas.study = tb_study.id_study";
		$tugas = $this->db->query($query)->result();

		$data = [
			'title' => 'List Tugas',
			'tugas' => $tugas
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('admin/tugas/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function jawaban($slug = '')
	{
		$tugas = $this->db->get_where('tb_tugas', ['slug' => $slug])->row();

		$data = [
			'title' => 'Jawaban ' . $tugas->tugas,
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('lecturer/tugas/source', $data);
		$this->load->view('layout/foot', $data);
	}

}

/* End of file Admin.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Admin/Admin.php */