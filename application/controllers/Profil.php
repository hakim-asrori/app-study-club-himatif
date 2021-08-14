<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
		$this->db->order_by('kelas', 'asc');
		$kelas = $this->db->get('tb_kelas')->result();

		$data = [
			'title' => 'Profil Saya',
			'user' => $this->user,
			'kelas' => $kelas
		];

		$this->load->view('layout/head', $data);
		if ($this->session->userdata('role_id')==1) {
			$this->load->view('admin/side', $data);
		} elseif ($this->session->userdata('role_id')==2) {
			$this->load->view('lecturer/side', $data);
		} else {
			$this->load->view('student/side', $data);
		}
		$this->load->view('profil', $data);
		$this->load->view('layout/foot', $data);
	}

	public function update()
	{
		if (validationToken()) {
			
			$object = [
				'nama_lengkap' => anti_inject($this->input->post('nama')),
				'nim' => anti_inject($this->input->post('nim')),
				'kelas' => anti_inject($this->input->post('kelas'))
			];

			$this->db->where('email', $this->session->userdata('email'));
			$this->db->update('tb_users', $object);

			if ($this->user->nim == '') {
				echo '<script>history.back(-1)</script>';
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil anda berhasil diupdate!</div>');
				redirect('profil','refresh');
			}

		}
	}

	public function image()
	{
		$upload_image = $_FILES['image']['name'];

		if ($upload_image) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
			$config['max_size']      = '2048';
			$config['upload_path'] = './assets/img/profile/';
			$config['encrypt_name'] = true;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$old_image = $this->user->foto;
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('foto', $new_image);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('tb_users');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Foto profil anda berhasil diupdate!</div>');
		redirect('profil','refresh');
	}

	public function password()
	{
		$data = [
			'title' => 'Ubah Password',
		];

		$this->load->view('layout/head', $data);
		$this->load->view('admin/side', $data);
		$this->load->view('password', $data);
		$this->load->view('layout/foot', $data);
	}

	public function changePassword()
	{
		$password = password_hash($this->input->post('new'), PASSWORD_DEFAULT);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('tb_users', ['password' => $password]);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password anda berhasil diupdate!</div>');
		redirect('profil','refresh');
	}

}

/* End of file Profil.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Admin/Profil.php */