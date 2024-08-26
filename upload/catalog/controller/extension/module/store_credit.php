<?php
class ControllerExtensionModuleStoreCredit extends Controller {
    public function index() {
        $this->load->language('extension/module/store_credit');

        $data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->session->data['customer_id'])) {
            $this->load->model('extension/module/store_credit');

            $data['credits'] = $this->model_extension_module_store_credit->getCredits($this->session->data['customer_id']);
        } else {
            $data['credits'] = array();
        }

        return $this->load->view('extension/module/store_credit', $data);
    }

    public function add() {
        $this->load->language('extension/module/store_credit');

        $json = array();

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if (!isset($this->session->data['customer_id'])) {
                $json['error'] = $this->language->get('error_login');
            } elseif (empty($this->request->post['amount']) || $this->request->post['amount'] <= 0) {
                $json['error'] = $this->language->get('error_amount');
            } else {
                $this->load->model('extension/module/store_credit');

                $data = array(
                    'customer_id' => $this->session->data['customer_id'],
                    'amount'      => $this->request->post['amount']
                );

                $this->model_extension_module_store_credit->addCredit($data);

                $json['success'] = $this->language->get('text_success');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
