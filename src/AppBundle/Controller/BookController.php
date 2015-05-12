<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use AppBundle\Entity\Book;
use Symfony\Component\HttpFoundation\Request;

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
        $books = $this->getDoctrine()->getRepository('AppBundle:Book')->findAll();
        
        return array('books' => $books);
    }
    /**
     *@Route("/add", name="books_add")
     *@Template
     */
    public function addAction(Request $request){

        $book = new Book();
        $form = $this->createForm('appbundle_book', $book);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
        }

        
        return array('form' => $form->createView());
    }
}

