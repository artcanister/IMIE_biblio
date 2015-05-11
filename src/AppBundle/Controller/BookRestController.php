<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class BookRestController extends Controller {
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Return all our books",
     *  tags={
     *      "in-development"}
     * )
     */
    public function getBooksAction(){
        //-action : config externe
        $books = $this->getDoctrine()->getRepository('AppBundle:Book')->findAll();
        
        return $books;
    }
}

