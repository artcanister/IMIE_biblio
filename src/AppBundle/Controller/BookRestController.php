<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BookRestController extends Controller {
    public function getBooksAction(){
        //-action : config externe
        $books = $this->getDoctrine()->getRepository('AppBundle:Book')->findAll();
        
        return $books;
    }
}

