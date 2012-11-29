<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту');

class MY_Pagination extends CI_Pagination {
	var $first_link			= '&lt;&lt;';
	var $next_link			= '&gt;';
	var $prev_link			= '&lt;';
	var $last_link			= '&gt;&gt;';
	var $full_tag_open		= '<div class="pagination"><ul>';
	var $full_tag_close		= '</ul></div>';
	var $first_tag_open		= '<li>';
	var $first_tag_close	= '</li>';
	var $last_tag_open		= '<li>';
	var $last_tag_close		= '</li>';
	var $first_url			= ''; // Alternative URL for the First Page.
	var $cur_tag_open		= '<li class="active"><span>';
	var $cur_tag_close		= '</span></li>';
	var $next_tag_open		= '<li>';
	var $next_tag_close		= '</li>';
	var $prev_tag_open		= '<li>';
	var $prev_tag_close		= '</li>';
	var $num_tag_open		= '<li>';
	var $num_tag_close		= '</li>';
}
