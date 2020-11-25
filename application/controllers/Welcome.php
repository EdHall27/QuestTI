<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{   $this->load->view('/template/layout-base.html');
		$this->load->view('welcome.php');
		$this->load->view('/template/roda-pe-base.html');
	}

	public function tec()
	{   $this->load->view('/template/layout-base.html');
		$this->load->view('welcome_tec.php');
		$this->load->view('/template/roda-pe-base.html');
	}


    

}
