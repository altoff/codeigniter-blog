<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personal extends CI_Controller {
	public function _remap($method, $params = array())
	{
		global $data;
		$data['categorytree'] = $this->categorytree->getSectionOptions(array('first' => false, 'delimiter' => '&nbsp;&nbsp;'));

		if (method_exists($this, $method))
			return call_user_func_array(array($this, $method), $params);
		show_404();
	}
	public function index()
	{
		global $data;
		$this->load->view('header');
		$this->load->view('footer');
	}
	public function auth()
	{
		global $data;
		$this->config->set_item('title', 'Мой блог // Авторизация');
		$this->config->set_item('description', 'Страница авторизации');
		$this->config->set_item('keywords', 'авторизация');
		
		$this->load->library('ulogin');
		$this->load->library('uauth');
		$this->ulogin->set_fields(array('email','nickname'));
		$this->ulogin->set_fields(array('first_name','last_name','photo', 'city', 'country'),false);
		$this->ulogin->set_providers(array('vkontakte','odnoklassniki','mailru','facebook','twitter','google','yandex','livejournal','openid'));
		$data['ulogin'] = $this->ulogin->get_html();

		if($this->input->post('token'))
		{
			$uUser = $this->uauth->userdata();
			$this->db->where('EMAIL',$uUser['email']);
			$this->db->where('UID',$uUser['uid']);
			$query = $this->db->get('users');
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				$this->db->where('ID', $row->ID);
	            $this->db->update('users', array('AUTH_DATE' => date('Y-m-d H:i:s')));
				$newdata = array(
					'id'  		=> $row->ID,
					'mail'     	=> $row->EMAIL,
					'fname'     => $row->FNAME,
					'lname'     => $row->LNAME,
					'group' 	=> $row->GROUP
				);
				$this->session->set_userdata($newdata);		//	добовляем данные пользователя в сессию
				$content = $this->load->view('personal/authsuccess', false, true);	// Загружаем новый шаблон, о том что авторизация прошла успешно
			}
			else
			{
				$indata = array(
					'UID'		=>	(isset($uUser['uid'])) ? $uUser['uid'] : 0,
					'EMAIL'		=>	(isset($uUser['email'])) ? $uUser['email'] : '',
					'NICKNAME'	=>	(isset($uUser['nickname'])) ? $uUser['nickname'] : '',
					'FNAME'		=>	(isset($uUser['first_name'])) ? $uUser['first_name'] : '',
					'LNAME'		=>	(isset($uUser['last_name'])) ? $uUser['last_name'] : '',
					'GROUP'		=>	1,
					'STATUS'	=>	1,
					'NETWORK'	=>	(isset($uUser['network'])) ? $uUser['network'] : '',
					'IDENTITY'	=>	(isset($uUser['identity'])) ? $uUser['identity'] : '',
					'PROFILE'	=>	(isset($uUser['profile'])) ? $uUser['profile'] : '',
					'SOCPHOTO'	=>	(isset($uUser['photo'])) ? $uUser['photo'] : '',
					'CITY'		=>	(isset($uUser['city'])) ? $uUser['city'] : '',
					'COUNTRY'	=>	(isset($uUser['country'])) ? $uUser['country'] : '',
					'REG_DATE'	=>	date('Y-m-d H:i:s'),
					'AUTH_DATE'	=>	date('Y-m-d H:i:s')
				);
	            if($this->db->insert('users', $indata))
	            {
					$newdata = array(
						'id'  	=> $this->db->insert_id(),
						'mail'	=> (isset($uUser['email'])) ? $uUser['email'] : '',
						'fname'	=> (isset($uUser['first_name'])) ? $uUser['first_name'] : '',
						'lname'	=> (isset($uUser['last_name'])) ? $uUser['last_name'] : '',
						'group' => 1
					);
					$this->session->set_userdata($newdata);		//	добовляем данные пользователя в сессию
					$content = $this->load->view('personal/authsuccess', false, true);	// Загружаем новый шаблон, о том что авторизация прошла успешно
	            }
	            else
	            {
	            	$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Ошибка базы данных!</div>';
	            	$content .= $this->load->view('personal/auth', false, true);
	            }
			}
		}
		else
		{
			$this->form_validation->set_rules('inputPassword', 'Пароль', 'required');		// Устанавливаем правила для поля Пароль
			$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');		// Устанавливаем правила для поля Почта
			$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');		// Текст ошибки, если срабатывает правило required
			$this->form_validation->set_message('valid_email', 'Не соответствующий адрес электронного ящика!');		// Текст ошибки, если срабатывает правило valid_email
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');		// Устанавливаем код который будет окружать наши ошибки при выводе

			if ($this->form_validation->run() === FALSE)	// Запускаем проверку
			{
				$content = $this->load->view('personal/auth', $data, true);	// если не прошло хотябы одно правило, то обратно выводим нашу форму
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
						$this->db->where('ID', $row->ID);
	           			$this->db->update('users', array('AUTH_DATE' => date('Y-m-d H:i:s')));
						$newdata = array(
							'id'  		=> $row->ID,
							'mail'     	=> $row->EMAIL,
							'fname'     => $row->FNAME,
							'lname'     => $row->LNAME,
							'group' 	=> $row->GROUP
						);
						$this->session->set_userdata($newdata);		//	добовляем данные пользователя в сессию
						$content = $this->load->view('personal/authsuccess', false, true);	// Загружаем новый шаблон, о том что авторизация прошла успешно
					}
					else
					{
						$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Не верный пароль!</div>';
						$content .= $this->load->view('personal/auth', $data, true);	// если пароли не совпали, то загружаем нашу форму
					}
				}
				else
				{
					$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Пользователь с таким email не найден!</div>';
					$content .= $this->load->view('personal/auth', $data, true);
				}
			}
		}
		$this->load->view('header', $data);
		$this->output->append_output($content);
		$this->load->view('footer');
	}
	public function reg()
	{
		global $data;
		$this->config->set_item('title', 'Регистрация');

		$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email|is_unique[users.EMAIL]');
		$this->form_validation->set_rules('inputPassword', 'Пароль', 'required|min_length[6]|matches[inputPasswordConf]');
		$this->form_validation->set_rules('inputPasswordConf', 'Повторить пароль', 'required|min_length[6]');

		$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');
		$this->form_validation->set_message('valid_email', 'Не соответствующий адрес электронного ящика!');
		$this->form_validation->set_message('min_length', 'Значение поля "%s" слишком короткое!');
		$this->form_validation->set_message('is_unique', 'Значение поля "%s" уже занято!');
		$this->form_validation->set_message('matches', 'Значение полей "%s" и "%s" не совпадают!');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');

		if ($this->form_validation->run() === FALSE)
		{
			$content = $this->load->view('personal/reg', false, true);
		}
		else
		{
			$indata = array(
				'PASSWORD'		=>	md5($this->input->post('inputPassword')),
				'EMAIL'			=>	$this->input->post('inputEmail'),
				'REG_DATE'		=>	date('Y-m-d H:i:s'),
				'GROUP'			=>	1
			);
            if($this->db->insert('users', $indata))
            {
            	$content = $this->load->view('personal/regsuccess', false, true);
				$newdata = array(
					'id'  	=> $this->db->insert_id(),
					'mail'	=> $this->input->post('inputEmail'),
					'fname'	=> '',
					'lname'	=> '',
					'group' => 1
				);
				$this->session->set_userdata($newdata);
            }
            else
            {
            	$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Ошибка базы данных!</div>';
            	$content .= $this->load->view('personal/reg', false, true);
            }
		}
		$this->load->view('header',$data);
		$this->output->append_output($content);
    	$this->load->view('footer');
	}
	public function recover()
	{
		global $data;

		$this->config->set_item('title', 'Восстановление пароля');

		$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');

		$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');
		$this->form_validation->set_message('valid_email', 'Не соответствующий адрес электронного ящика!');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');

		if ($this->form_validation->run() === FALSE)
		{
			$content = $this->load->view('personal/recover', false, true);
		}
		else
		{
			$this->db->where('EMAIL', $this->input->post('inputEmail'));
			$query = $this->db->get('users');
			if ($query->num_rows() > 0)
			{
				$user = $this->categorytree->ObjectToMass($query->row());

				$this->load->helper('tools');
				$newPass = randString(10);

				$this->db->where('ID', $user['ID']);
	            if($this->db->update('users', array('PASSWORD' => md5($newPass))))
	            {
	            	$this->load->library('email');
	            	$config = array('mailtype' => 'html', 'charset' => 'utf-8');
	            	$this->email->initialize($config);
					$this->email->from($this->config->item('admin-email'), $this->config->item('admin-name'));
					$this->email->to($user['EMAIL']);
					$this->email->subject('Восстановление пароля');
					$this->email->message('Это письмо выслано для подтверждения, что мы получили запрос на восстановление пароля для Вашего аккаунта '.$user['EMAIL'].'. Мы создали временный пароль, указаный ниже. Вы можете использвать его для входа на сайт.<br/><br/>URL: <a href="'.$this->config->item('base_url').'personal/auth/">'.$this->config->item('base_url').'personal/auth/</a><br/><br/>Имя пользователя: '.$user['EMAIL'].'<br/><br/>Временный пароль: '.$newPass.'<br/><br/>как можно скорее Вы должны войти на сайт и сменить Ваш временный пароль.');
					if($this->email->send())
					{
						$content = $this->load->view('personal/recoversuccess', false, true);
					}
					else
					{
						$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Проблема отправки сообщения!</div>';
						$content .= $this->load->view('personal/recover', false, true);
					}
	            }
	            else
	            {
					$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Ошибка базы данных!</div>';
					$content .= $this->load->view('personal/recover', false, true);
	            }
			}
			else
			{
				$content = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> Пользователь с таким email не найден!</div>';
				$content .= $this->load->view('personal/recover', false, true);
			}
		}

		$this->load->view('header',$data);
		$this->output->append_output($content);
    	$this->load->view('footer');
	}
	public function logout()
	{
		$this->load->library('ulogin');
		$this->load->library('uauth');
		$this->uauth->logout();
		$this->session->sess_destroy();
		redirect('/');
	}
}