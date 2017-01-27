<?php

namespace PMM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PMMUserBundle extends Bundle{

	public function getParent(){
		
		return 'FOSUserBundle';
	}
}
