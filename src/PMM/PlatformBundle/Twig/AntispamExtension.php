<?php
// src/PMM/PlatformBundle/Twig/AntispamExtension.php

namespace PMM\PlatformBundle\Twig;

use PMM\PlatformBundle\PMMAntispam\PMMAntispam;

class AntispamExtension extends \Twig_Extension{
	
	private $pmmAntispam;
	
	public function __construct(PMMAntispam $pmmAntispam){
		
		$this->pmmAntispam = $pmmAntispam;
	}
	
	public function checkIfArgumentIsSpam($text){
		
		return $this->pmmAntispam->isSpam($text);
	}

	public function getFunctions(){
		
		return array(
			new \Twig_SimpleFunction('checkIfSpam', array($this, 'checkIfArgumentIsSpam'))
			);
	}

	public function getName(){
		
		return 'PMMAntispam';
	}

}