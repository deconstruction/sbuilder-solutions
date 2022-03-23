<?php

class sZenDesk
{
	const KEY = '***';

	const ID_FIELD_RESTOURANT = 000;

	const ID_USER_REQUESTER = 111;

	private $headers = array(
		'Content-Type: application/json',
		'Accept: application/json',
	);

	private $dump = false;

	private $data = array();

	private $action = 'tickets.json';

	private $phone = '79999999999';

	private $name = 'Не указано';

	private $mail = 'email';

	private $comment = '';

	private $date = '';

	private $time = '';

	private $restourant = '';

	private $brand = '';

	private $imageLink = '';

	private $fromEmail;

	private $fromName;

	private $toEmailAddress;

	private $ch;

	private $ticketId = '';

	function __construct($fromEmail, $fromName, $toEmailAddress)
	{
		$this->fromEmail = $fromEmail;
		$this->fromName = $fromName;
		$this->toEmailAddress = $toEmailAddress;
		$this->initialCurl();
		$this->data['ticket']['subject'] = 'Отзыв';
		$this->who()->subject()->source()->brand()->ip()->via();
	}

	public function via()
	{
		$this->data['ticket']['via']['channel']                   = 'email';
		$this->data['ticket']['via']['source']['from']['address'] = $this->fromEmail;
		$this->data['ticket']['via']['source']['from']['name'] 	  = $this->fromName;
		$this->data['ticket']['via']['source']['to']['address']   = $this->toEmailAddress;
		$this->data['ticket']['via']['source']['to']['name']      = 'Служба клиентской поддержки';

		return $this;
	}

	public function initialCurl()
	{
		$ch = curl_init('https://skp.zendesk.com/api/v2/' . $this->action);
		curl_setopt($ch, CURLOPT_USERPWD, self::KEY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$this->ch = $ch;
	}

	public function action($value) 
	{
		$this->action = $value;
		$this->initialCurl();

		return $this;
	}

	public function who($value = null)
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360007987520,
			'value' => $value ?: 'гость',
		);

		return $this;
	}

	public function subject($value = null)
	{
		$this->data['ticket']['subject'] = $value ?: 'Отзыв';

		return $this;
	}

	public function comment($value)
	{
		$value = strip_tags($value);
		$this->comment = $value;
		$this->data['ticket']['comment']['body'] = $value;
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360020278199,
			'value' => $value,
		);

		return $this;
	}

	public function source($value = null)
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360007987680,
			'value' => $value ?: 'сайт',
		);

		return $this;
	}

	public function restourant($value)
	{
		$this->restourant = $value;

		$this->data['ticket']['custom_fields'][] = array(
			'id' => self::ID_FIELD_RESTOURANT,
			'value' => $value,
		);

		if (strpos($this->restourant, 'доставк')) {
			$this->data['ticket']['custom_fields'][] = array(
				'id' => 360020436659,
				'value' => 'доставка',
			);
		} else {
			$this->data['ticket']['custom_fields'][] = array(
				'id' => 360020436659,
				'value' => 'ресторан',
			);
		}

		return $this;
	}

	public function date($value)
	{
		$value = date_format(date_create($value), 'Y-m-d');
		$this->date = $value;
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360008505780,
			'value' => $this->date,
		);

		return $this;
	}

	public function dateMobile($value)
	{
		$value = date_format(date_create($value), 'Y-m-d');
		$this->date = $value;
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360008585160,
			'value' => $this->date,
		);

		return $this;
	}

	public function time($value)
	{
		$value = str_replace(':', '-', $value);
		$this->time = $value;
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360019967119,
			'value' => $value,
		);

		return $this;
	}

	public function timeMobile($value)
	{
		$value = str_replace(':', '-', $value);
		$this->time = $value;
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360020149540,
			'value' => $value,
		);

		return $this;
	}

	public function name($value)
	{
		if (!empty($value)) {
			$this->name = $value;
		}

		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360008585640,
			'value' => $this->name,
		);

		return $this;
	}

	public function phone($value)
	{
		if (!empty($value)) {
			$value = preg_replace('/\D/', '', $value);
			$this->phone = $value;
		}

		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360020255639,
			'value' => $this->phone,
		);

		$this->mail = 'noemail' . $this->phone . '@bahroma1.ru';

		return $this;
	}

	public function mail($value)
	{
		if (!empty($value)) {
			$this->mail = $value;
		}

		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360009657140,
			'value' => $this->mail,
		);

		return $this;
	}

	public function brand($value = null)
	{
		$this->brand = $value;
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360014263119,
			'value' => $value ?: 'Bahroma',
		);

		return $this;
	}

	public function platform($value)
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360014265860,
			'value' => $value,
		);

		return $this;
	}

	public function device_id($value)
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360014265880,
			'value' => $value,
		);

		return $this;
	}

	public function build($value)
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360014230879,
			'value' => $value,
		);

		return $this;
	}

	public function user_agent($value)
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360014266040,
			'value' => $value,
		);

		return $this;
	}

	public function ip()
	{
		$this->data['ticket']['custom_fields'][] = array(
			'id' => 360014385500,
			'value' => $_SERVER["HTTP_X_FORWARDED_FOR"],
		);

		return $this;
	}

	public function fields()
	{
		$this->action('ticket_fields.json');

		return curl_exec($this->ch);
	}

	public function send()
	{
		$this->user();
		$this->setComment();

		if ($this->dump) {
			var_dump($this->data);
			die();
		}
		$this->log(array($this->phone, $this->name, $this->mail));
		$this->log($this->data);

		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->data));
		$result = curl_exec($this->ch);
		$data = json_decode($result, true);
		$this->ticketId = $data['ticket']['id'];
		$this->log($this->ticketId);
		$this->log($result);
		
		return $result;
	}

	private function addTag($tag)
	{
		$this->action('tickets/' . $this->ticketId . '/tags');
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode(array(
			'tags' => $tag
		)));
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
		$this->initialCurl();
		$result = json_decode(curl_exec($this->ch), true);
		$this->log($result);
	}

	private function user($search = null)
	{
		$query = 'phone:' . $this->phone . '+name:' . urlencode($this->name) . '+email:' . $this->mail;

		$old_action = 'tickets.json';
		$this->action('users/search.json?query=' . $query);
		$this->initialCurl();
		$result = json_decode(curl_exec($this->ch), true);
		$this->log($result);
		if (intval($result['count']) === 0) {
			$old_data = $this->data;
			$this->action('users.json');
			$this->initialCurl();
			$this->data = [];
			$this->data['user']['name'] = $this->name;
			$this->data['user']['phone'] = $this->phone;
			$this->data['user']['email'] = $this->mail;
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->data));
			$user_response = json_decode(curl_exec($this->ch), true);

			$this->log($user_response);
			$this->data = $old_data;
			$this->data['ticket']['requester_id'] = isset($user_response['user']['id']) ? $user_response['user']['id'] : self::ID_USER_REQUESTER;
		} else {
			$this->data['ticket']['requester_id'] = $result['users'][0]['id'];
		}

		$this->action($old_action);
		$this->initialCurl();
	}

	public function showUser($id)
	{
		$this->action('users/' . $id . '.json');

		return curl_exec($this->ch);
	}

	public function showTicket($id)
	{
		$this->action('tickets/' . $id . '.json');

		return curl_exec($this->ch);
	}

	public function imageLink($link)
	{
		$this->imageLink = $link;

		return $this;
	}

	public function attachFile($file = null)
	{
		if ((float) phpversion() <= (float) 5.5) {
			return $this;
		}

		if(empty($file)) {
			return $this;
		}

		$old_action = $this->action;
		$this->action('uploads.json');
		$this->initialCurl();

		if (!file_exists($file)) {
			return $this;
		}

		$extension = pathinfo($uploadFilePath, PATHINFO_EXTENSION);

		$uploadFileMimeType = mime_content_type($uploadFilePath);
		$uploadFilePostKey = 'file';

		$uploadFile = new CURLFile(
			$uploadFilePath,
			$uploadFileMimeType,
			$uploadFilePostKey
		);

		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode(array(
			$uploadFilePostKey => $uploadFile,
			'filename' => 'file.' . $extension
		)));

		$results = json_decode(curl_exec($this->ch), true);
		$token = $results['upload']['token'];
		$this->data['ticket']['comment']['uploads'][] = $token;

		$this->action($old_action);
		$this->initialCurl();

		return $this;

	}

	private function setComment()
	{
		$comment = 'Текст отзыва:' . PHP_EOL;
		$comment .= $this->comment . PHP_EOL . PHP_EOL;
		$comment .= 'Дата визита: ' . date_format(date_create($this->date), 'd.m.Y') . ' в ' . str_replace('-', ':', $this->time) . PHP_EOL;
		$comment .= 'Ваше имя: ' . $this->name . PHP_EOL;
		$comment .= 'Адрес: ' . $this->restourant . PHP_EOL;
		$comment .= 'Телефон: ' . $this->phone . PHP_EOL;
		$comment .= 'Почта: ' . $this->mail . PHP_EOL;
		$comment .= 'Ссылка на изображение: ' . $this->imageLink . PHP_EOL;

		$this->comment($comment);
	}

	public function log($data)
	{
		if (is_array($data)) {
			$data = json_encode($data, JSON_UNESCAPED_UNICODE);
		}

		$fileName = $this->fromName . "_" . date('d.m.Y') . ".log";

		$myfile = fopen("/home/domains/tokyo-city.ru/www/cms/plugins/own/pl_zendesk/logs/" . $fileName, "a+");
		fwrite($myfile, PHP_EOL  . PHP_EOL . date('d.m.Y H:i') . PHP_EOL  . PHP_EOL);
		fwrite($myfile, $data);
		fclose($myfile);

		if (function_exists('sb_add_system_message')) {
			sb_add_system_message('<b>Zendesk:</b> информация об отзыве отправлена в ZenDesk и произведена запись в лог файл: <a target="_blank" href="/cms/plugins/own/pl_zendesk/logs/' . $fileName . '">' . $fileName . '</a>');
		}
	}
}