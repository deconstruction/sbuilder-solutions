<?php

namespace Recaptcha;

class Recaptcha
{
	const URL = 'https://www.google.com/recaptcha/api/siteverify';

	private $privateKey;

	public $response = array();
	
	public function __construct($privateKey)
	{
		$this->privateKey = $privateKey;
	}

	public function request($token)
	{
		$params = array(
			'secret'   => $this->privateKey,
			'response' => $token,
			'remoteip' => $this->getIp(),
        );

		$ch = curl_init(self::URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$this->response = curl_exec($ch);

		return json_decode($this->response, true);
	}

	public function check($score, $token)
	{
		$recaptcha = $this->request($token);

        return $recaptcha['score'] <= $score;
    }

    public function checkFromPost($score)
    {
        if(!empty($_POST['recaptcha_token'])) {
            $recaptcha = $this->request($_POST['recaptcha_token']);

            return $recaptcha['score'] <= $score;
        }

        return false;
    }

	private function getIp()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}
}

?>
