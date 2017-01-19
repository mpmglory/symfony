<?php
// src/PMM/PlatformBundle/Email/ApplicationMailer.php

namespace PMM\PlatformBundle\Email;

use PMM\PlatformBundle\Entity\Application;

class ApplicationMailer{
	
	/**
	* @var \Swift_Mailer
	*/
	private $mailer;
	
	public function __construct(\Swift_Mailer $mailer){
		
		$this->mailer = $mailer;
	}
	
	public function sendNewNotification(Application $application){
		
		$message = new \Swift_Message(
			'Nouvelle candidature',
			'Vous avez recu une nouvelle candidature.'
		);
		
		$message
			->addTo($application->getAdvert()->getAuthor())
			->addFrom('joyplatini@yahoo.fr');
		
		$this->mailer->send($message);
	}
}