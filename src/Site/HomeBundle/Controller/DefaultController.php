<?php

namespace Site\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	date_default_timezone_set('Asia/Chongqing');
    	$data = array(
    		'time'=>'name is:',
    	);
    	var_dump(func_get_args());
        return $this->render('SiteHomeBundle:Default:index.html.twig', $data);
    }
}
