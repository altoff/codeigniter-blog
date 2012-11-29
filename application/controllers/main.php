<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {
	public function index($category = 'all', $tag = 'all', $page = '1')
	{
		$categoryid = false;
        $query = $this->db->get('category');
        foreach ($query->result() as $row)
        {
        	if($category != 'all')
        		if($category == $row->ID || $category == $row->CODE)
        			$categoryid = $row->ID;
        	$data['category'][$row->ID] = $this->categorytree->ObjectToMass($row);
        }
        $data['categorytree'] = $this->categorytree->getSectionOptions(array('first' => false, 'delimiter' => '&nbsp;&nbsp;'));

        if($categoryid != false)
        	$this->db->where('POST_CATEGORY', $categoryid);
        if($tag != 'all')
        	$this->db->like('POST_TAGS', rawurldecode($tag));
		$post_count = $this->db->count_all_results('posts');


		if($category != 'all')
		{
			$config['first_url'] = '/'. $category;
			$config['base_url'] = '/'. $category . '/page/';
			$config['uri_segment'] = 3;
		}
		elseif($tag != 'all')
		{
			$config['first_url'] = '/tag/'. rawurldecode($tag);
			$config['base_url'] = '/tag/'. rawurldecode($tag) . '/page/';
			$config['uri_segment'] = 4;
		}
		else
		{
			$config['first_url'] = '/';
			$config['base_url'] = '/page/';
			$config['uri_segment'] = 2;
		}
		$config['total_rows'] = $post_count;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = TRUE;
		
		
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();

        if($categoryid != false)
        	$this->db->where('POST_CATEGORY', $categoryid);
        if($tag != 'all')
        	$this->db->like('POST_TAGS', rawurldecode($tag));
		$this->db->order_by('POST_DATE','DESC');
		$this->db->limit($config['per_page'], ($page-1)*$config['per_page']);
		$query = $this->db->get('posts');
        foreach ($query->result() as $row)
        {
        	$data['posts'][$row->POST_ID] = $this->categorytree->ObjectToMass($row);
        	if(strstr($data['posts'][$row->POST_ID]["POST_TEXT"],"<hr>"))
        	{
        		$list = explode("<hr>", $data['posts'][$row->POST_ID]["POST_TEXT"]);
        		$data['posts'][$row->POST_ID]["POST_TEXT"] = $list[0];
        	}
        	if(strstr($data['posts'][$row->POST_ID]["POST_TAGS"],","))
        		foreach (explode(",", $data['posts'][$row->POST_ID]["POST_TAGS"]) as $value)
        			$data['posts'][$row->POST_ID]["POST_TAGS_ARRAY"][] = ltrim($value);

        	$cat_code = (isset($data['category'][$data['posts'][$row->POST_ID]['POST_CATEGORY']]['CODE']) && strlen($data['category'][$data['posts'][$row->POST_ID]['POST_CATEGORY']]['CODE']) > 0) ? $data['category'][$data['posts'][$row->POST_ID]['POST_CATEGORY']]['CODE'] : 'post';
        	$post_code = (isset($data['posts'][$row->POST_ID]["POST_CODE"]) && strlen($data['posts'][$row->POST_ID]["POST_CODE"]) > 0) ? $data['posts'][$row->POST_ID]["POST_CODE"] : $row->POST_ID;
		    $data['posts'][$row->POST_ID]["URL"] = "/" . $cat_code . "/" . $post_code ;
        }
            

		$this->load->view('header',$data);
		$this->load->view('main',$data);
		$this->load->view('footer');
	}
	public function post($category, $post)
	{
        $query = $this->db->get('category');
        foreach ($query->result() as $row)
        {
        	if($category != 'all')
        		if($category == $row->ID || $category == $row->CODE)
        			$categoryid = $row->ID;
        	$data['category'][$row->ID] = $this->categorytree->ObjectToMass($row);
        }
		$data['categorytree'] = $this->categorytree->getSectionOptions(array('first' => false, 'delimiter' => '&nbsp;&nbsp;'));
		$this->db->where('POST_CODE', $post);
		$query = $this->db->get('posts');
		if ($query->num_rows() > 0)
		{
			$data['post'] = $this->categorytree->ObjectToMass($query->row());
			$this->config->set_item('title', $data['post']["POST_NAME"]);

			$data['post']['POST_VIEW']++;
			$this->db->where('POST_ID',$data['post']['POST_ID']);
			$this->db->update('posts',array('POST_VIEW' => $data['post']['POST_VIEW']));

        	if(strstr($data['post']["POST_TAGS"],","))
        		foreach (explode(",", $data['post']["POST_TAGS"]) as $value)
        			$data['post']["POST_TAGS_ARRAY"][] = ltrim($value);
        	$data['post']["POST_TEXT"] = str_replace("<hr>", "", $data['post']["POST_TEXT"]);
		}
		$this->load->view('header',$data);
		$this->load->view('post',$data);
		$this->load->view('footer');
	}
}