<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => "Login"
		];

		if (validationToken()) {
			$email = anti_inject($this->input->post('email'));
			$password = anti_inject($this->input->post('password'));

			$user = $this->db->get_where('tb_users', ['email' => $email])->row_array();

			if ($user) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'status' => 'loggedin'
					];

					$this->session->set_userdata($data);
					
					if ($user['role_id'] == 1) {
						redirect('admin');
					} elseif ($user['role_id'] == 2) {
						redirect('lecturer');
					} else {
						redirect('student');
					}
				} else {
					$this->session->set_flashdata('message', "<script>Swal.fire('Ooops!', 'Password salah!', 'error')</script>");
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', "<script>Swal.fire('Ooops!', 'Email tidak terdaftar!', 'error')</script>");
				redirect('auth');
			}
		} else {
			$this->load->view('auth/login', $data);
		}
	}

	public function register()
	{
		$data = [
			'title' => "Register",
			'study' => $this->db->get('tb_study')->result(),
		];

		if (validationToken()) {
			$email = anti_inject($this->input->post('email'));
			$study = anti_inject($this->input->post('study'));
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

			$user = $this->db->get_where('tb_users', ['email' => $email])->num_rows();

			if ($user < 1) {
				$this->db->insert('tb_users', ['study' => $study, 'email' => $email, 'password' => $password]);

				$this->session->set_flashdata('message', "<script>Swal.fire('Wooww!', 'Selamat registrasi berhasil!', 'success')</script>");
				redirect('auth','refresh');
			} else {
				$this->session->set_flashdata('message', "<script>Swal.fire('Ooops!', 'Email sudah terdaftar!', 'error')</script>");
				redirect('auth/register','refresh');
			}
		} else {
			$this->load->view('auth/register', $data);
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('status');
		redirect('auth','refresh');
	}

}

/* End of file Auth.php */
/* Location: .//D/Server/laragon/www/app-sc/app/controllers/Auth.php */