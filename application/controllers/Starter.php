<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Starter extends CI_Controller {
	public function _construct()
	{
		session_start();
	}

	public function login()
	{
		$cek = $this->session->userdata('username');
		if(empty($cek))
		{
			// $this->load->model('Beritamodel');
			// $data['berita'] = $this->Beritamodel->tampil();
			// $data['jumlah'] = $this->Beritamodel->tampil();
			$data = array(
				'title' => "Login"
			);
			$this->load->view('login/auth-login', $data);
		} 	
		else
		{
			$st= $this->session->userdata('role');
			if($st=='admin')
			{
				header('location:'.base_url().'home/admin');
			}
			else
			{
				header('location:'.base_url().'home/user');	
			}
		}
	}

	public function logout()
	{
		$cek = $this->session->userdata('username');
		if(empty($cek))
		{
			header("location:".base_url());
		}
		else
		{
			$this->session->sess_destroy();
			header("location:".base_url());
		}
	}
	
	public function features_activities() {
		$data = array(
			'title' => "Activities"
		);
		$this->load->view('features-activities', $data);
	}

	public function features_post_create() {
		$data = array(
			'title' => "Post Create"
		);
		$this->load->view('features-post-create', $data);
	}

	public function features_posts() {
		$data = array(
			'title' => "Posts"
		);
		$this->load->view('features-posts', $data);
	}

	public function features_profile() {
		$data = array(
			'title' => "Profile"
		);
		$this->load->view('features-profile', $data);
	}

	public function features_settings() {
		$data = array(
			'title' => "Settings"
		);
		$this->load->view('features-settings', $data);
	}

	public function features_setting_detail() {
		$data = array(
			'title' => "Setting Detail"
		);
		$this->load->view('features-setting-detail', $data);
	}

	public function features_tickets() {
		$data = array(
			'title' => "Tickets"
		);
		$this->load->view('features-tickets', $data);
	}
}
?>