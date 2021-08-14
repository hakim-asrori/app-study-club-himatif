<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecturer extends CI_Controller {


	protected $user = '';

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row();

		if (empty($this->session->userdata('email'))) {
			redirect('auth','refresh');
		} elseif ($this->user->nim == '') {
			redirect('lecturer/profil','refresh');
		} elseif ($this->session->userdata('role_id') != 2) {
			echo '<script>history.back(-1)</script>';
		}
	}

	public function index()
	{
		$pemateri = $this->db->get_where('tb_users', ['role_id' => 2, 'study' => $this->user->study])->num_rows();

		$peserta = $this->db->get_where('tb_users', ['role_id' => 3, 'study' => $this->user->study])->num_rows();

		$data = [
			'title' => 'Home',
			'pemateri' => $pemateri,
			'peserta' => $peserta,
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function materi()
	{
		$data = [
			'title' => 'Materi'
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/materi/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function materiEdit($slug = '')
	{
		$materi = $this->db->get_where('tb_materi', ['slug' => $slug])->row();

		$data = [
			'title' => 'Edit Materi ' . $materi->materi,
			'materi' => $materi
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/materi/edit', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugas()
	{
		$data = [
			'title' => 'Tugas'
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/tugas/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugasAdd()
	{
		$data = [
			'title' => 'Tambah Tugas',
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/tugas/add', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugasEdit($slug = '')
	{
		$slug = anti_inject($slug);

		$query = "SELECT tb_users.nama_lengkap, tb_tugas.* FROM tb_tugas JOIN tb_users ON tb_tugas.user = tb_users.id_user WHERE tb_tugas.slug = '$slug'";
		$tugas = $this->db->query($query)->row();

		$materi = $this->db->get_where('tb_materi', ['study' => $this->user->study])->result();

		$data = [
			'title' => 'Edit Tugas ' . $tugas->tugas,
			'tugas' => $tugas,
			'materi' => $materi
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/tugas/edit', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugasSource($slug = '')
	{
		$tugas = $this->db->get_where('tb_tugas', ['slug' => anti_inject($slug)])->row();

		$data = [
			'title' => 'Jawaban ' . $tugas->tugas,
		];

		$this->load->view('layout/head', $data);
		$this->load->view('lecturer/side', $data);
		$this->load->view('lecturer/tugas/source', $data);
		$this->load->view('layout/foot', $data);
	}

}

/* End of file Lecturer.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Lecturer/Lecturer.php */