<?php
namespace Mikewazovzky\Simple;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class Mailer 
{
	protected $config;
	/**
	 * Read mail configuration data from a file
	 */
	public function __construct($fileneme = null)
	{
		$this->config = (new Config($filename))->data['mail'];
	}
	/**
	 * Send message
	 * @param string $to
	 * @param string $subject	
	 * @param string $body	  
	 */
	public function send($to, $subj, $body) 
	{
		$transport = Swift_SmtpTransport::newInstance(
			$this->config['host'], 
			$this->config['port'],  
			$this->config['encryption']
		);	
		$transport->setUsername($this->config['login']);
		$transport->setPassword($this->config['password']);

		$mailer = Swift_Mailer::newInstance($transport);
				
		$message = Swift_Message::newInstance()
			->setSubject($subj)
			->setFrom([$this->config['address'] => $this->config['name']])
			->setTo($to)
			->setBody($body);
	
		return $mailer->send($message);
	}	
}