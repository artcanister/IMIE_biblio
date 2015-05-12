<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BookRestController extends Controller {
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Return all our books (get)",
     *  tags={
     *      "in-development"}
     * )
     * 
     * 
     */
    public function getBooksAction(){
        //-action : config externe
        $books = $this->getDoctrine()->getRepository('AppBundle:Book')->findAll();
        
        return $books;
    }
    
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Return a book by its id",
     *  tags={
     *      "in-development"}
     * )
     * 
     */
    public function getBookByIdAction($id){
        $book = $this->get("book_manager")->findById($id);
        return $book;
    }
    
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Delete a book with the BookManager",
     *  tags={
     *      "in-development"}
     * )
     * 
     */
    public function deleteBookAction($id){
      $this->get("book_manager")->removeBook($id);
   }
    
}

