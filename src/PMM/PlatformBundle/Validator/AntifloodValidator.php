<?php

namespace PMM\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AntifloodValidator extends ConstraintValidator{

	private $requestStack;
	private $em;

	public function __construct(RequestStack $requestStack, EntityManagerInterface $em){

		$this->requestStack = $requestStack;
		$this->em = $em;
	}

	public function validate($value, Constraint $constraint){

		$request = $this->requestStack->getCurrentRequest();

		$ip = $request->getClientIp();

		$isFlood = $this->em
						->getRepository('PMMPlatformBundle:Application')
						->isFlood($ip, 15);

		if($isFlood){

			$this->context->addViolation($constraint->message);
		}
	}
}