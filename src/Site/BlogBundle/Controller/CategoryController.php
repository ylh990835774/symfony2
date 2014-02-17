<?php

namespace Site\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/blog/category")
 */
class CategoryController extends Controller
{
	/**
	 * @Route("/{tname}")
	 */
	public function showAction($tname)
	{
		$category = $this->getDoctrine()->getRepository('SiteBlogBundle:Category')->findOneByTname($tname);
		var_dump($category);exit;
		return new Response($category->tname .'-'. $category->name);
	}
}