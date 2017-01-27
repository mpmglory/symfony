<?php

namespace PMM\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class Antiflood extends Constraint{

	public $message = "Vous avez poste un message il y'a moins de 15 secondes, 
				merci d'attendre un peu.";
}