<?php
class ControllerExtensionModuleNewsletter extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/newsletter');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/extension/module/newsletter.css');

		$data['name'] = !empty($setting['name']) ? $setting['name'] : 'Newsletter';
		$data['title'] = !empty($setting['title']) ? $setting['title'] : 'INSCREVA-SE E FIQUE POR DENTRO DE NOSSAS <em>NOVIDADES, OFERTAS ESPECIAIS</em> E MUITO MAIS!';
		$data['description'] = !empty($setting['description']) ? $setting['description'] : '';
		$data['placeholder'] = !empty($setting['placeholder']) ? $setting['placeholder'] : '';
		$data['button'] = !empty($setting['button']) ? $setting['button'] : '';

		return $this->load->view('extension/module/newsletter', $data);
	}

	public function register() {
		$this->load->language('extension/module/newsletter');
		$json = array();

		if (isset($this->request->post['email']) && !empty(trim($this->request->post['email']))) {
			$email = trim($this->request->post['email']);
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$json[] = array(
					'status' => 'error',
					'message' => $this->language->get('error_email_invalid')
				);
			} else {
				$this->load->model('extension/module/newsletter');
				
				try {
					$result = $this->model_extension_module_newsletter->register($email, date('Y-m-d'));

					if ($result) {
						$json[] = array(
							'status' => 'created',
							'email' => $email
						);
					} else {
						$json[] = array(
							'status' => 'error',
							'message' => $this->language->get('error_email_exists')
						);
					}
				} catch (Exception $e) {
					$json[] = array(
						'status' => 'error',
						'message' => $this->language->get('error_general')
					);
				}
			}
		} else {
			$json[] = array(
				'status' => 'error',
				'message' => $this->language->get('error_email_required')
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
