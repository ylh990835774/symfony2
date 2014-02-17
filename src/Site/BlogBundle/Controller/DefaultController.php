<?php

namespace Site\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\BlogBundle\Entity\Category;
use Site\BlogBundle\Entity\Article;

/**
 * @Route("/blog")
 */
class DefaultController extends Controller
{
	/**
     * @Route("/")
     */
    public function indexAction()
    {
    	$data = array('articles'=>$this->getArticles());
        return $this->render('SiteBlogBundle:Default:index.html.twig', $data);
    }

    protected function getArticles()
    {
    	return $this->getDoctrine()->getRepository('SiteBlogBundle:Article')->findAll();
    }

    /**
     * @Route("/list")
     */
    public function listAction()
    {
    	$data = array('articles'=>$this->getArticles());

    	return $this->render('SiteBlogBundle:Default:list.html.twig', $data);
    }

    /**
 	 * @Route("/show{id}", name="site_blog_show",requirements={"id" = "\d+"}, defaults={"id" = 1})
 	 */
    public function showAction($id)
    {
    	$articles = $this->getArticles();
    	$data = array();
    	foreach ($articles as $key => $value) {
    		if ($value['id'] == $id) {
    			$data = $value;
    		}
    	}

    	return $this->render('SiteBlogBundle:Default:show.html.twig', array('article'=>$data));
    }

    /**
     * @Route("/create", name="site_blog_create")
     */
    public function createAction()
    {
    	$article_arr = array(
    		array('title'=>'文章1', 'content'=>'文章1中的内容'),
    		array('title'=>'文章2', 'content'=>'文章2中的内容'),
    		array('title'=>'文章3', 'content'=>'文章3中的内容'),
    		array('title'=>'文章4', 'content'=>'文章4中的内容'),
    	);
    	
        $cate_arr = array(
            array('name'=>'分类1', 'tname'=>'cate1'),
            array('name'=>'分类2', 'tname'=>'cate2'),
            array('name'=>'分类3', 'tname'=>'cate3'),
            array('name'=>'分类4', 'tname'=>'cate4'),
            array('name'=>'分类5', 'tname'=>'cate5'),
            array('name'=>'分类6', 'tname'=>'cate6'),
        );
        foreach ($cate_arr as $key => $value) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setTname($value['tname']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }
        
        $cate_id = $this->getDoctrine()->getRepository('SiteBlogBundle:Category')->findOneByTname('cate1');
        foreach ($article_arr as $k=>$v) {
        	$article = new Article();
        	$article->setTitle($v['title']);
        	$article->setContent($v['content']);
        	$article->setCategory($cate_id);
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($article);
        	$em->flush();
        }
        
        return new Response('Succ');
    }
}
