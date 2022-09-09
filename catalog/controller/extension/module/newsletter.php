<?php
class ControllerExtensionModuleNewsletter extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/newsletter');

		$this->load->model('tool/image');

		if (!$setting['title']) {
			$data['title'] = "Newsletter";
		}else{
			$data['title'] = $setting['title'];
		}

		if (!$setting['description']) {
			$data['description'] = "";
		}else{
			$data['description'] = $setting['description'];
		}

		if (!$setting['placeholder']) {
			$data['placeholder'] = "";
		}else{
			$data['placeholder'] = $setting['placeholder'];
		}

		if (!$setting['button']) {
			$data['button'] = "";
		}else{
			$data['button'] = $setting['button'];
		}

		return $this->load->view('extension/module/newsletter', $data);
		
	}

	public function cadastrar() {

		$email = $this->request->post['email'];
		$date = date('y/m/d');

		$this->load->model('extension/module/newsletter');

		$this->model_extension_module_newsletter->createTable();
		$this->model_extension_module_newsletter->insere($email, $date);

		$json = array();

		$json[] = array(
			'status' => "created",
			'email'       => $email
		);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}
}