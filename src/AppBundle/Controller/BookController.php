<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
/**
 * @Route("/books")
 *
 */
class BookController extends Controller {
    /**
     *@Route("/", name="books_list")
     *@Template
     */
    public function listAction(){
        //-action : config externe
        $books = $this->getDoctrine()->getRepository('AppBundle:Book')->findAll();
        
        return array('books' => $books);
    }
}

