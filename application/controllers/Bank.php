<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
{
	private $depositOrWithdraw;
	private $withdraw_id;
	private $deposit_id;
	private $response;
	private $amount;
	private $cards;
	private $post;
	private $card;
	private $id;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('bank_model');
		$this->load->model('log_model');
		if (!logged_in()) redirect('auth/login');
	}


	public function index()
	{
		$this->load->view('_partials/header');
		$this->load->view('welcome_message');
		$this->load->view('_partials/footer');
	}

	public function showCard()
	{


		$data['cards'] = $this->getAllCards(TRUE);

		$this->load->view('_partials/header');
		$this->load->view('card/show_card', $data);
		$this->load->view('_partials/footer');
	}

	public function getCardNumber($id)
	{

		if (!$id && !$this->bank_model->getCardNumber($id)) {
			$response['status'] = 0;
			$response['message'] = 'Failed to get card number';
		} else {

			$card = $this->bank_model->getNumberMonthYear($id);
			$response['status'] = 1;
			$response['id'] = $id;
			$response['message'] = 'Successfully obtained card number';
			$response['card_number'] =  whiteSpaces($card['card_number'], 4);
			$response['expiration_month'] =  $card['expiration_month'];
			$response['expiration_year'] =  $card['expiration_year'];
			$response['cvv'] =  $card['cvv'];
		}
		echo json_encode($response);
	}

	public function createCard()
	{

		if ($post = $this->input->post()) {

			// DEFAULT FOR TEST 
			$post['account_balance'] = 2000;

			$response = $this->saveCard($post);
			echo json_encode($response);
		} else {
			$this->load->view('_partials/header');
			$this->load->view('card/create_card');
			$this->load->view('_partials/footer');
		}
	}

	private function saveCard($post)
	{
		$cards_numbers = $this->bank_model->getCardNumbers();

		$response = [];

		$post['card_number'] = intval(preg_replace('/\s+/', '', $post['card_number']));


		foreach ($cards_numbers as $number) {

			if ($number['card_number'] == $post['card_number']) {
				$response['status'] = 0;
				$response['message'] = 'This card already exists ';

				$params = [
					'log_type' => 'card',
					'action' => 'Trying to create card ' . $post['card_number'] . ' but, this card already exists.',
					'created_at' => date("Y-m-d H:i:s"),
				];

				$this->log_model->add_log($params);

				return $response;
			};
		}

		$this->load->library('form_validation');


		$this->form_validation->set_rules('card_number', 'Card number', 'trim|required');
		$this->form_validation->set_rules('card_holder', 'Card holder', 'trim|required');
		$this->form_validation->set_rules('expiration_month', 'Expiration month', 'trim|required|min_length[2]|max_length[2]|numeric|integer');
		$this->form_validation->set_rules('expiration_year', 'Expiration year', 'trim|required|min_length[4]|max_length[4]|numeric|integer');

		if ($this->form_validation->run()) {

			$response['id'] = $this->bank_model->saveCard($post);
			$response['status'] = 1;
			$response['message'] = 'Card successfully added';

			$params = [
				'log_type' => 'card',
				'action' => 'Succesfuly created card ' . $post['card_number'],
				'created_at' => date("Y-m-d H:i:s"),
			];

			$this->log_model->add_log($params);
		} else {
			$response['status'] = 0;
			$response['message'] = $this->form_validation->error_array();
		}

		return $response;
	}

	public function cardPay($id)
	{

		if ($post = $this->input->post()) {
			$response = [];

			$withdraw_id = $this->depositOrWithdraw($post['id'], $post['amount'], 'withdraw');

			if (isset($withdraw_id) && !empty($withdraw_id)) {
				$deposit_id = $this->depositOrWithdraw($id, $post['amount'], 'deposit');

				if (isset($deposit_id) && !empty($deposit_id)) {
					$response['status'] = 1;
					$response['message'] = 'Success';

					$this->bank_model->getCardNumber($post['id']);

					$params = [
						'log_type' => 'transaction',
						'action' => 'Sended ' . $post['amount']  . ' € from '  . $this->bank_model->getCardNumber($post['id'])  . ' to ' . $this->bank_model->getCardNumber($id),
						'created_at' => date("Y-m-d H:i:s"),
					];

					$this->log_model->add_log($params);
				}
			} else {
				$response['status'] = 0;
				$response['message'] = 'Transef failed, I do not have enought money';

				$params = [
					'log_type' => 'transaction',
					'action' => 'Unsuccessful transaction, this card ' . $this->bank_model->getCardNumber($post['id']) . ' does not have enough money',
					'created_at' => date("Y-m-d H:i:s"),
				];

				$this->log_model->add_log($params);
			}

			echo json_encode($response);
		} else {

			$cards = $this->getAllCards();
			$card = $this->bank_model->getCard($id);

			$card['card_number'] = whiteSpaces(ccMasking($card['card_number'], 4, 4), 4);

			$data['card_details'] = $card;
			$data['cards'] = $cards;
			$data['encoded_cards'] = json_encode($cards);

			$this->load->view('_partials/header');
			$this->load->view('card/card_pay', $data);
			$this->load->view('_partials/footer');
		}
	}

	private function depositOrWithdraw($id, $amount, $depositOrWithdraw)
	{
		return $this->bank_model->depositOrWithdrawFromAccount($id, $amount, $depositOrWithdraw);
	}

	public function activityLog()
	{
		$all_logs = $this->log_model->get_all_log();

		foreach ($all_logs as $key => $log) {
			$all_logs[$key]['created_at'] = cuteDateTime($log['created_at']);
		}

		$data['count_logs'] = $this->log_model->get_count_log();
		$data['all_logs'] = $all_logs;
		$data['encoded_all_logs'] = json_encode($all_logs);

		$this->load->view('_partials/header');
		$this->load->view('activity_log', $data);
		$this->load->view('_partials/footer');
	}

	private function getAllCards($mask = NULL)
	{


		$cards = $this->bank_model->getCards();
		foreach ($cards as $key => $card) {
			$cards[$key]['card_number'] = whiteSpaces(ccMasking($card['card_number'], 4, 4), 4);
			$cards[$key]['expiration_year'] = ccMasking($card['expiration_year'], 0, -4);
			$cards[$key]['expiration_month'] = ccMasking($card['expiration_month'], 0, -2);
			$cards[$key]['cvv'] = ccMasking($card['cvv'], 0, -3);
		}

		return $cards;
	}
}
