<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Book;

class BookRestController extends Controller {
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Return all our books (get)",
     *  tags={
     *      "in-development"}
     * )
     * @return array
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
     *  description="Get a book with his id",
     *  tags={
     *      "in-development"}
     * )
     * 
     */
    public function getBookByIdAction($id){
        $book = $this->getDoctrine()->getRepository('AppBundle:Book')->findOneBy($id);
        return $book;
    }
    
    /**
     * @ApiDoc(
     *  resource= true,
     *  description="edit a book and persist in database",
     *  tags={
     *      "in-development"}
     * )
     * 
     * @ParamConverter("post", class="AppBundle:Book")
     */
    public function putBookAction(){
        //is a complete edit of a book and saving method
        
        
    }
    
    /**
     * @ApiDoc(
     *  resource= true,
     *  description="This method delete a book. All its fields, but only one resource.",
     *  tags={
     *      "in-development"}
     * )
     * 
     * @ParamConverter("post", class="AppBundle:Book")
     */
   public function deleteBookAction(Book $book){
       $em = $this->getDoctrine()->getManager();
       $em->remove($book);
   }
   
   /**
     * @ApiDoc(
     *  resource= true,
     *  description="You can use it to update the title, author, categories and all the informations of the book.",
     *  tags={
     *      "in-development"}
     * )
    * @ParamConverter("post", class="AppBundle:Book")
    */
   public function updateBookAction(Book $book){
       
   }
}

