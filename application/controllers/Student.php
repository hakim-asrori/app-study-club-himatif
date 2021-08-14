<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	protected $user = '';

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row();

		if (empty($this->session->userdata('email'))) {
			redirect('auth','refresh');
		} elseif ($this->user->nim == '') {
			redirect('student/profil','refresh');
		} elseif ($this->session->userdata('role_id') != 3) {
			echo '<script>history.back(-1)</script>';
		}
	}

	public function index()
	{
		$study = $this->user->study;
		$skor = $this->user->skor;

		$materi = $this->db->get_where('tb_materi', ['study' => $study])->result();
		$tugas = $this->db->get_where('tb_tugas', ['study' => $study])->result();
		$pemateri = $this->db->get_where('tb_users', ['role_id' => 2, 'study' => $study])->num_rows();

		$data = [
			'title' => 'Home',
			'materi' => $materi,
			'pemateri' => $pemateri,
			'tugas' => $tugas,
			'skor' => $skor,
			'id_user' => $this->user->id_user,
		];

		$this->load->view('layout/head', $data);
		$this->load->view('student/side', $data);
		$this->load->view('student/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function materi()
	{
		$study = $this->user->study;

		$queryMateri = "SELECT tb_materi.*, tb_users.nama_lengkap FROM tb_materi JOIN tb_users ON tb_materi.pemateri = tb_users.id_user WHERE tb_materi.study = '$study' ORDER BY tb_materi.id_materi DESC";
		$materi = $this->db->query($queryMateri)->result();

		$data = [
			'title' => 'Materi',
			'id_user' => $this->user->id_user,
			'materi' => $materi
		];

		$this->load->view('layout/head', $data);
		$this->load->view('student/side', $data);
		$this->load->view('student/materi/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function materiView($slug = '')
	{
		if ($slug == null) {
			$this->materi();
		} else {
			$slug = anti_inject($slug);
			$id_user = $this->user->id_user;

			$queryMateri = "SELECT * FROM tb_materi WHERE slug = '$slug'";
			$materi = $this->db->query($queryMateri)->row();

			$countMhs = $this->db->get_where('tb_users', ['study' => $materi->study])->num_rows();

			$materi_view = $this->db->get_where('tb_materi_view', ['materi' => $materi->id_materi, 'user' => $id_user])->num_rows();
			if ($materi_view < 1) {
				$this->db->insert('tb_materi_view', ['user' => $id_user, 'materi' => $materi->id_materi]);

				$this->db->where('id_user', $id_user);
				$this->db->update('tb_users', ['skor' => $this->user->skor + 5]);
			}

			$data = [
				'title' => 'Lihat Materi',
				'materi' => $materi,
				'count' => $countMhs
			];

			$this->load->view('layout/head', $data);
			$this->load->view('student/side', $data);
			$this->load->view('student/materi/view', $data);
			$this->load->view('layout/foot', $data);

		}
	}

	public function tugas()
	{
		$study = $this->user->study;

		$qury = "SELECT tb_tugas.*, tb_users.nama_lengkap FROM tb_tugas JOIN tb_users ON tb_tugas.user = tb_users.id_user WHERE tb_tugas.study = '$study' ORDER BY tb_tugas.id_tugas DESC";
		$tugas = $this->db->query($qury)->result();

		$data = [
			'title' => 'Tugas',
			'id_user' => $this->user->id_user,
			'tugas' => $tugas
		];

		$this->load->view('layout/head', $data);
		$this->load->view('student/side', $data);
		$this->load->view('student/tugas/home', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugasWork($slug = '')
	{
		$id_user = $this->user->id_user;
		$slug = anti_inject($slug);

		$query = "SELECT * FROM tb_tugas WHERE slug = '$slug'";
		$tugas = $this->db->query($query)->row();

		$tugas_view = $this->db->get_where('tb_tugas_view', ['tugas' => $tugas->id_tugas, 'user' => $id_user])->num_rows();
		if ($tugas_view < 1) {
			$this->db->insert('tb_tugas_view', ['user' => $id_user, 'tugas' => $tugas->id_tugas]);

			$this->db->where('id_user', $id_user);
			$this->db->update('tb_users', ['skor' => $this->user->skor + 5]);
		}

		if (date('d-m-Y H:i', strtotime($tugas->stop_at)) <= date('d-m-Y H:i')) {
			redirect('student/tugas','refresh');
		}

		$data = [
			'title' => 'Tugas ' . $tugas->tugas,
			'tugas' => $tugas,
		];

		$this->load->view('layout/head', $data);
		$this->load->view('student/side', $data);
		$this->load->view('student/tugas/work', $data);
		$this->load->view('layout/foot', $data);
	}

	public function tugasEdit($slug = '')
	{
		$id_user = $this->user->id_user;
		$slug = anti_inject($slug);

		$queryTugas = "SELECT * FROM tb_tugas WHERE slug = '$slug'";
		$tugas = $this->db->query($queryTugas)->row();

		$jawaban = $this->db->get_where('tb_tugas_upload', ['user' => $id_user, 'tugas' => $tugas->id_tugas])->row();

		$data = [
			'title' => 'Edit Tugas ' . $tugas->tugas,
			'tugas' => $tugas,
			'jawaban' => $jawaban,
		];

		if (date('d-m-Y H:i', strtotime($tugas->stop_at)) <= date('d-m-Y H:i')) {
			redirect('student/tugas','refresh');
		}

		$this->load->view('layout/head', $data);
		$this->load->view('student/side', $data);
		$this->load->view('student/tugas/edit', $data);
		$this->load->view('layout/foot', $data);
	}

}

/* End of file Student.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Student/Student.php */