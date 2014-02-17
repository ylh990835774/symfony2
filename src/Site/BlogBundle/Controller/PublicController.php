<?php
namespace Site\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
	public function sideBarAction()
	{
		$data = array('categories'=>$this->getDoctrine()->getRepository('SiteBlogBundle:Category')->findAll());
		return $this->render('SiteBlogBundle:Public:sidebar.html.twig', $data);
	}
}