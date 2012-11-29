<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function _remap($method, $params = array())
	{
		if($this->session->userdata('group') != '99')
		{
			redirect('/personal/auth');
		}
		else
		{
			if (method_exists($this, $method))
				return call_user_func_array(array($this, $method), $params);
		}
		show_404();
	}
	public function index()
	{
		$this->config->set_item('title', 'Панель администирования');
		$this->load->view('admin/header');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');
	}
	public function category()
	{
		$data['category'] = $this->categorytree->getSectionOptions();

		$this->config->set_item('title', 'Разделы');
		$this->load->view('admin/header');

		$this->form_validation->set_rules('category-name', 'Название раздела', 'required');
		$this->form_validation->set_rules('category-code', 'ЧПУ код', 'required|alpha_dash');
		$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');
		$this->form_validation->set_message('alpha_dash', '"%s" может содержать только латинские буквенно-цифровые символы, подчеркивания и тире!');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');

		if ($this->form_validation->run() === FALSE)	// Запускаем проверку
		{
			$this->load->view('admin/category/category',$data);
		}
		else
		{
			$indata = array(
				'NAME'		=>	$this->input->post('category-name'),
				'CODE'		=>	$this->input->post('category-code'),
				'PARENT_ID'	=>	$this->input->post('category-parent'),
			);
            if($this->db->insert('category', $indata))
            {
            	$this->load->view('admin/category/categorysuccess');
            }
            else
            {
            	$this->load->view('admin/category/category',$data);
            }
		}

		$this->load->view('admin/footer');
	}
	public function categoryedit($id = false)
	{
		if($id != false)
		{
			$this->db->where('ID', $id);
			$query = $this->db->get('category');	// делаем запрос к базе
			if ($query->num_rows() > 0)	// если кол-во пользователей больше 0, то продолжаем
			{
				$data['ccategory'] = $this->categorytree->ObjectToMass($query->row());
				$data['category'] = $this->categorytree->getSectionOptions();

				$this->config->set_item('title', 'Разделы');
				$this->load->view('admin/header');

				$this->form_validation->set_rules('category-name', 'Название раздела', 'required');
				$this->form_validation->set_rules('category-code', 'ЧПУ код', 'required|alpha_dash');
				$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');
				$this->form_validation->set_message('alpha_dash', '"%s" может содержать только латинские буквенно-цифровые символы, подчеркивания и тире!');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');		// Устанавливаем код который будет окружать наши ошибки при выводе

				if ($this->form_validation->run() === FALSE)	// Запускаем проверку
				{
					$this->load->view('admin/category/edit',$data);
				}
				else
				{
					$updata = array(
						'NAME'		=>	$this->input->post('category-name'),
						'CODE'		=>	$this->input->post('category-code'),
						'PARENT_ID'	=>	$this->input->post('category-parent'),
					);
                    $this->db->where('ID',$id);
		            if($this->db->update('category', $updata))
		            {
		            	$this->load->view('admin/category/editsuccess');
		            }
		            else
		            {
		            	$this->load->view('admin/category/edit',$data);
		            }
				}
				$this->load->view('admin/footer');
			}
			else
			{
				redirect('/admin/category');
			}
		}
		else
		{
			redirect('/admin/category');
		}
	}
	public function categorydelete($id = false)
	{
		if($id != false)
		{
			$this->db->where('ID', $id);
			$query = $this->db->get('category');
			if ($query->num_rows() > 0)
			{
				$row = $query->row();

				$this->db->where('PARENT_ID', $id);
				$this->db->update('category', array('PARENT_ID' => $row->PARENT_ID));

	            if($this->db->delete('category', array('ID' => $id)))
	            {
	            	$this->config->set_item('title', 'Разделы');
	            	$this->load->view('admin/header');
	            	$this->load->view('admin/category/deletesuccess');
	            	$this->load->view('admin/footer');
	            }
	            else
	            {
	            	redirect('/admin/category');
	            }
			}
			else
			{
				redirect('/admin/category');
			}
		}
		else
		{
			redirect('/admin/category');
		}	
	}
	public function posts()
	{
        $query = $this->db->get('category');
        foreach ($query->result() as $row)
            $data['category'][$row->ID] = $this->categorytree->ObjectToMass($row);

        $query = $this->db->get('posts');
        foreach ($query->result() as $row)
            $data['posts'][$row->POST_ID] = $this->categorytree->ObjectToMass($row);

		$this->config->set_item('title', 'Записи');

    	$this->load->view('admin/header');
    	$this->load->view('admin/posts/posts',$data);
    	$this->load->view('admin/footer');
	}
	public function editpost($id = false)
	{
		$data['category'] = $this->categorytree->getSectionOptions();

        $this->db->order_by("EMAIL", "ASC");
        $query = $this->db->get('users');
        foreach ($query->result() as $row)
            $data['users'][$row->ID] = $this->categorytree->ObjectToMass($row);

		if($id != false)
		{
			$this->db->where('POST_ID', $id);
			$query = $this->db->get('posts');
			if ($query->num_rows() > 0)
				$data['post'] = $this->categorytree->ObjectToMass($query->row());
			$this->config->set_item('title', 'Редактирование записи');
		}
		else
		{
			$this->config->set_item('title', 'Добавить запись');
		}

		$this->load->view('admin/header');

		$this->form_validation->set_rules('post-name', 'Название', 'required');
		$this->form_validation->set_rules('post-code', 'ЧПУ код', 'required|alpha_dash|is_unique[posts.POST_CODE]');
		$this->form_validation->set_rules('post-text', 'Текст', 'required');
		$this->form_validation->set_rules('post-date', 'Дата публикации');
		$this->form_validation->set_rules('post-category', 'Раздел');
		$this->form_validation->set_rules('post-author', 'Автор');
		$this->form_validation->set_rules('post-tags', 'Тэги');

		$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');
		$this->form_validation->set_message('alpha_dash', '"%s" может содержать только латинские буквенно-цифровые символы, подчеркивания и тире!');
		$this->form_validation->set_message('is_unique', 'Значение поля "%s" уже занято!');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/posts/editpost',$data);
		}
		else
		{
			$indata = array(
				'POST_NAME'		=>	$this->input->post('post-name'),
				'POST_TEXT'		=>	$this->input->post('post-text'),
				'POST_CATEGORY'	=>	$this->input->post('post-category'),
				'POST_DATE'		=>	$this->input->post('post-date'),
				'POST_USER'		=>	$this->input->post('post-author'),
				'POST_VIEW'		=>	$this->input->post('post-view'),
				'POST_CODE'		=>	$this->input->post('post-code'),
				'POST_TAGS'		=>	$this->input->post('post-tags'),
			);
			if($id != false)
			{
				$this->db->where('POST_ID', $id);
	            if($this->db->update('posts', $indata))
	            	$this->load->view('admin/posts/postsuccess');
	            else
	            	$this->load->view('admin/posts/editpost',$data);
			}
			else
			{
	            if($this->db->insert('posts', $indata))
	            	$this->load->view('admin/posts/postsuccess');
	            else
	            	$this->load->view('admin/posts/editpost',$data);
			}

		}

    	$this->load->view('admin/footer');
	}
	public function deletepost($id = false)
	{
		if($id != false)
		{
            if($this->db->delete('posts', array('POST_ID' => $id)))
            {
            	$this->config->set_item('title', 'Записи');
            	$this->load->view('admin/header');
            	$this->load->view('admin/posts/deletesuccess');
            	$this->load->view('admin/footer');
            }
            else
            	redirect('/admin/posts');
		}
		else
			redirect('/admin/posts');
	}
	public function editusers($id = false)
	{
		$data = array();
		if($id != false)
		{
			$this->db->where('ID', $id);
			$query = $this->db->get('users');
			if ($query->num_rows() > 0)
				$data['user'] = $this->categorytree->ObjectToMass($query->row());
			$this->config->set_item('title', 'Редактирование пользователя');
		}
		else
		{
			$this->config->set_item('title', 'Добавить пользователя');
		}

		$this->load->view('admin/header');

		if(isset($data['user']['EMAIL']) && $this->input->post('email') == $data['user']['EMAIL'])
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		else
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.EMAIL]');
		if(isset($data['user']['ID']) && strlen($this->input->post('password')) == 0)
			$this->form_validation->set_rules('password', 'Пароль');
		else
			$this->form_validation->set_rules('password', 'Пароль', 'required|min_length[6]');

		$this->form_validation->set_rules('group', 'Группа');
		$this->form_validation->set_rules('fname', 'Фамилия');
		$this->form_validation->set_rules('lname', 'Имя');

		$this->form_validation->set_message('required', 'Поле "%s" не заполнено!');
		$this->form_validation->set_message('valid_email', 'Не соответствующий адрес электронного ящика!');
		$this->form_validation->set_message('min_length', 'Значение поля "%s" слишком короткое!');
		$this->form_validation->set_message('is_unique', 'Значение поля "%s" уже занято!');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-warning-sign"></i> ', '</div>');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/users/edit',$data);
		}
		else
		{
			$indata = array(
				'EMAIL'			=>	$this->input->post('email'),
				'FNAME'			=>	$this->input->post('fname'),
				'LNAME'			=>	$this->input->post('lname'),
				'GROUP'			=>	$this->input->post('group')
			);
			if(strlen($this->input->post('password')) > 0)
				$indata['PASSWORD'] = md5($this->input->post('password'));

			if($id != false)
			{
				$this->db->where('ID', $id);
	            if($this->db->update('users', $indata))
	            	$this->load->view('admin/users/editsuccess');
	            else
	            	$this->load->view('admin/users/edit',$data);
			}
			else
			{
	            if($this->db->insert('users', $indata))
	            	$this->load->view('admin/users/editsuccess');
	            else
	            	$this->load->view('admin/users/edit',$data);
			}

		}
    	$this->load->view('admin/footer');
	}
	public function users()
	{
        $query = $this->db->get('users');
        foreach ($query->result() as $row)
            $data['users'][$row->ID] = $this->categorytree->ObjectToMass($row);

		$this->config->set_item('title', 'Пользователи');

		$this->load->view('admin/header');
		$this->load->view('admin/users/list',$data);
		$this->load->view('admin/footer');
	}
	public function deleteuser($id = false)
	{
		if($id != false)
		{
            if($this->db->delete('users', array('ID' => $id)))
            {
            	$this->config->set_item('title', 'Пользователи');
            	$this->load->view('admin/header');
            	$this->load->view('admin/users/deletesuccess');
            	$this->load->view('admin/footer');
            }
            else
            	redirect('/admin/users');
		}
		else
			redirect('/admin/users');
	}
}