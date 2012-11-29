<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personal extends CI_Controller {
	public function index()
	{
		$data['categorytree'] = $this->categorytree->getSectionOptions(array('first' => false, 'delimiter' => '&nbsp;&nbsp;'));

		$this->load->view('header');
		$this->load->view('footer');
	}
	public function auth()
	{
		$data['categorytree'] = $this->categorytree->getSectionOptions(array('first' => false, 'delimiter' => '&nbsp;&nbsp;'));

		$this->config->set_item('title', 'Мой блог // Авторизация');
		$this->config->set_item('description', 'Страница авторизации');
		$this->config->set_item('keywords', 'авторизация');
		$this->load->view('header',$data);

		$this->form_validation->set_rules('inputPassword', 'Пароль', 'required');		// Устанавливаем правила для поля Пароль
		$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');		// Устанавливаем правила для поля Почта
		$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');		// Текст ошибки, если срабатывает правило required
		$this->form_validation->set_message('valid_email', 'Не соответствующий адрес электронного ящика!');		// Текст ошибки, если срабатывает правило valid_email
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');		// Устанавливаем код который будет окружать наши ошибки при выводе

		if ($this->form_validation->run() === FALSE)	// Запускаем проверку
		{
			$this->load->view('auth');	// если не прошло хотябы одно правило, то обратно выводим нашу форму
		}
		else
		{
			$this->db->where('EMAIL', $this->input->post('inputEmail'));
			$query = $this->db->get('users');	// делаем запрос к базе
			if ($query->num_rows() > 0)	// если кол-во пользователей больше 0, то продолжаем
			{
				$row = $query->row();
				if($row->PASSWORD == md5($this->input->post('inputPassword')))	// сверяем пароли
				{
					$newdata = array(
						'id'  => $row->ID,
						'mail'     => $row->EMAIL,
						'fname'     => $row->FNAME,
						'lname'     => $row->LNAME,
						'group' => $row->GROUP
					);
					$this->session->set_userdata($newdata);		//	добовляем данные пользователя в сессию
					$this->load->view('authsuccess');	// Загружаем новый шаблон, о том что авторизация прошла успешно
				}
				else
				{
					$this->load->view('auth');	// если пароли не совпали, то загружаем нашу форму
				}
			}
			else
			{
				$this->load->view('auth');	// если пользователь с такой почтой не найден, то загружаем нашу форму
			}
		}

		$this->load->view('footer');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}