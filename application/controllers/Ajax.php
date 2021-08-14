<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	protected $user = '';

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row();

		if (empty($this->session->userdata('email'))) {
			redirect('auth','refresh');
		}
	}

	public function kelasGet()
	{
		$queryKls = "SELECT * FROM tb_kelas ORDER BY kelas DESC";
		$kelas = $this->db->query($queryKls)->result();

		$data = array();

		foreach ($kelas as $k) {
			$queryMhs = "SELECT count(kelas) as kelas FROM tb_users WHERE kelas = '$k->id_kelas'";
			$mahasiswa = $this->db->query($queryMhs)->row();
			$data[] = array(
				'id_kelas' => $k->id_kelas,
				'kelas' => $k->kelas,
				'mahasiswa' => $mahasiswa->kelas,
			);
		}

		echo json_encode($data);

		exit;
	}

	public function kelasAdd()
	{
		$insert = $this->db->insert('tb_kelas', ['kelas' => anti_inject($this->input->post('kelas'))]);

		if ($insert) {
			echo 1;
		} else {
			echo 2;
		}

	
	}

	public function kelasDestroy()
	{
		$this->db->where('id_kelas', anti_inject($this->input->post('kelas')));
		$destroy = $this->db->delete('tb_kelas');

		if ($destroy) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function lecturerGet()
	{
		$query = "SELECT tb_users.*, tb_kelas.kelas AS desc_kelas FROM tb_users JOIN tb_kelas ON tb_users.kelas = tb_kelas.id_kelas WHERE tb_users.role_id = 2";
		$users = $this->db->query($query)->result();

		$data = array();

		foreach ($users as $u) {
			$data[] = array(
				'id_user' => $u->id_user,
				'kelas' => $u->desc_kelas,
				'nama_lengkap' => $u->nama_lengkap.' ( '.$u->nim.' )',
				'email' => $u->email,
			);
		}

		echo json_encode($data);

		exit;
	}

	public function lecturerUsers()
	{
		$this->db->select('nama_lengkap, nim');
		$this->db->where('role_id', 3);
		$result = $this->db->get('tb_users')->result();

		$data = array();
		foreach ($result as $r) {
			$data[] = $r->nim . ' - ' . $r->nama_lengkap;
		}

		echo json_encode($data);

		exit;
	}

	public function lecturerAdd()
	{
		$this->db->where('nim', anti_inject($this->input->post('nim')));
		$update = $this->db->update('tb_users', ['role_id' => 2]);

		if ($update) {
			echo 1;
		} else {
			echo 1;
		}
	}

	public function lecturerDestroy()
	{
		$this->db->where('id_user', anti_inject($this->input->post('user')));
		$update = $this->db->update('tb_users', ['role_id' => 3]);

		if ($update) {
			echo 1;
		} else {
			echo 1;
		}
	}

	public function studyGet()
	{
		$queryStd = "SELECT * FROM tb_study";
		$study = $this->db->query($queryStd)->result();

		$data = array();

		foreach ($study as $s) {
			$queryMhs = "SELECT count(study) as study FROM tb_users WHERE study = '$s->id_study'";
			$mahasiswa = $this->db->query($queryMhs)->row();
			$data[] = array(
				'id_study' => $s->id_study,
				'study' => $s->study,
				'mahasiswa' => $mahasiswa->study,
			);
		}

		echo json_encode($data);

		exit;
	}

	public function studyAdd()
	{
		$insert = $this->db->insert('tb_study', ['study' => anti_inject($this->input->post('study'))]);

		if ($insert) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function studyDestroy()
	{
		$this->db->where('id_study', anti_inject($this->input->post('study')));
		$destroy = $this->db->delete('tb_study');

		if ($destroy) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function materiGet()
	{
		$study = $this->user->study;

		$queryMateri = "SELECT * FROM tb_materi JOIN tb_users ON tb_materi.pemateri = tb_users.id_user WHERE tb_materi.study = $study ORDER BY tb_materi.id_materi DESC";
		$materi = $this->db->query($queryMateri)->result();

		$data = array();

		foreach ($materi as $m) {
			$data[] = array(
				'id_materi' => $m->id_materi,
				'materi' => $m->materi,
				'nama_lengkap' => $m->nama_lengkap,
				'file' => $m->file,
				'slug' => $m->slug,
			);
		}

		echo json_encode($data);

		exit;
	}

	public function materiAdd()
	{
		$slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower(anti_inject($this->input->post('materi')))));
		$object = [
			'pemateri' => $this->user->id_user,
			'study' => $this->user->study,
			'materi' => anti_inject($this->input->post('materi')),
			'slug' => $slug
		];

		$insert = $this->db->insert('tb_materi', $object);

		if ($insert) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function materiUpdate()
	{
		$slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower(anti_inject($this->input->post('materi')))));

		$this->db->set('materi', anti_inject($this->input->post('materi')));
		$this->db->set('slug', $slug);
		$this->db->set('file', $this->input->post('file'));
		$this->db->where('id_materi', anti_inject($this->input->post('id')));
		
		$update = $this->db->update('tb_materi');

		if ($update) {
			echo 1;
		}
	}

	public function materiDestroy()
	{
		$materi = $this->db->get_where('tb_materi', ['id_materi' => anti_inject($this->input->post('materi'))])->row();

		$this->db->where('id_materi', anti_inject($this->input->post('materi')));
		$destroy = $this->db->delete('tb_materi');

		if ($destroy) {
			echo 1;
		} else {
			echo 2;
		}
		
	}

	public function tugasGet()
	{
		$query = "SELECT tb_users.nama_lengkap, tb_tugas.* FROM tb_tugas JOIN tb_users ON tb_tugas.user = tb_users.id_user ORDER BY created_at DESC";
		$tugas = $this->db->query($query)->result();


		$data = array();

		foreach ($tugas as $t) {
			$selesai = $this->db->get_where('tb_tugas_upload', ['tugas' => $t->id_tugas])->num_rows();
			$data[] = array(
				'id_tugas' => $t->id_tugas,
				'slug' => $t->slug,
				'tugas' => $t->tugas,
				'selesai' => $selesai,
				'nama_lengkap' => $t->nama_lengkap,
			);
		}

		echo json_encode($data);

		exit;
	}

	public function tugasAdd()
	{
		$slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower(anti_inject($this->input->post('tugas')))));

		$object = [
			'user' => $this->user->id_user,
			'study' => $this->user->study,
			'tugas' => anti_inject($this->input->post('tugas')),
			'slug' => $slug,
			'soal' => $this->input->post('soal'),
			'created_at' => $this->input->post('created_at'),
			'stop_at' => $this->input->post('stop_at'),
		];

		$insert = $this->db->insert('tb_tugas', $object);

		if ($insert) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function tugasUpdate()
	{
		$slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower(anti_inject($this->input->post('tugas')))));

		$object = [
			'user' => $this->user->id_user,
			'study' => $this->user->study,
			'tugas' => anti_inject($this->input->post('tugas')),
			'slug' => $slug,
			'soal' => $this->input->post('soal'),
			'created_at' => $this->input->post('created_at'),
			'stop_at' => $this->input->post('stop_at'),
		];

		$this->db->where('id_tugas', anti_inject($this->input->post('id_tugas')));
		$update = $this->db->update('tb_tugas', $object);

		if ($update) {
			echo 1;
		}
	}

	public function tugasDestroy()
	{
		$this->db->where('id_tugas', anti_inject($this->input->post('tugas')));
		$destroy = $this->db->delete('tb_tugas');

		if ($destroy) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function jawabanGet($slug = '')
	{
		$tugas = $this->db->get_where('tb_tugas', ['slug' => anti_inject($slug)])->row();

		$query = "SELECT tb_users.nama_lengkap, tb_users.id_user, tb_kelas.kelas as desc_kelas, tb_users.nim, tb_tugas_upload.jawaban FROM tb_tugas_upload JOIN tb_users ON tb_tugas_upload.user = tb_users.id_user JOIN tb_kelas ON tb_users.kelas = tb_kelas.id_kelas WHERE tugas = '$tugas->id_tugas'";
		$tugas_upload = $this->db->query($query)->result();

		$data = array();

		foreach ($tugas_upload as $t) {
			$data[] = array(
				'id_user' => $t->id_user,
				'nama_lengkap' => $t->nama_lengkap,
				'desc_kelas' => $t->desc_kelas,
				'nim' => $t->nim,
			);
		}

		echo json_encode($data);

		exit;
	}

	public function jawabanAdd()
	{
		$tugas_view = $this->db->get_where('tb_tugas_upload', ['tugas' => $this->input->post('tugas'), 'user' => $this->user->id_user])->num_rows();
		if ($tugas_view < 1) {
			$object = [
				'user' => $this->user->id_user,
				'tugas' => $this->input->post('tugas'),
				'jawaban' => $this->input->post('jawaban'),
			];

			$this->db->insert('tb_tugas_upload', $object);

			$this->db->where('id_user', $this->user->id_user);
			$this->db->update('tb_users', ['skor' => $this->user->skor + 10]);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tugas anda berhasil diupload!</div>');
		redirect('student/tugas','refresh');
	}

	public function jawabanEdit()
	{
		$this->db->where('tugas', $this->input->post('tugas'));
		$this->db->update('tb_tugas_upload', ['jawaban' => $this->input->post('jawaban')]);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tugas anda berhasil diupload!</div>');
		redirect('student/tugas','refresh');
	}

	public function jawabanView()
	{
		$user = $this->input->post('user');

		$query = "SELECT tb_users.nama_lengkap, tb_tugas_upload.jawaban FROM tb_tugas_upload JOIN tb_users ON tb_tugas_upload.user = tb_users.id_user WHERE user = '$user'";
		$jawaban = $this->db->query($query)->row();

		$data = array();

		$data[] = array(
			'nama_lengkap' => $jawaban->nama_lengkap,
			'jawaban' => $jawaban->jawaban,
		);

		echo json_encode($data);

		exit;
	}

}

/* End of file Ajax.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Ajax.php */