<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Pagination configuration
| -------------------------------------------------------------------
| This file will contain the settings for pagination library
| total_rows		: total halaman
| per_page			: jumlah record yang ditampilkan dalam 1 halaman
| num_links			: jumlah nomor halaman yang ditampilkan
| documentation     : https://ellislab.com/codeigniter/user-guide/libraries/pagination.html
*/

$config['per_page'] = C_PAGE_JUMLAH;
$config['num_links'] = C_PAGE_JUMLAH_LINK;
$config['page_query_string'] = TRUE;
$config['use_page_numbers'] = TRUE;

$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
$config['full_tag_close'] = '</ul>';
$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '<i class="fa fa-angle-right"></i>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="disabled"><a style="background: #eee;">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';