<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class BookRestController extends Controller {
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Return all our books (get)",
     *  tags={
     *      "stable"}
     * )
     * 
     * 
     */
    public function getBooksAction(){
        //-action : config externe
        return $this->getDoctrine()->getRepository('AppBundle:Book')->findAll();
    }
    
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Return a book by its id",
     *  parameters={
     * {"name"="bookId", "dataType"="Integer", "required"=true, "description"="book id"}
     * },
     *  tags={
     *      "stable"}
     * )
     * 
     */
    public function getBookAction($id){
        return $this->get("book_manager")->findById($id);
    }
    
    /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="add a book.",
     *  tags={"in-development"},
     *  input="book",
     *  output="AppBundle\Entity\Book"
     * )
     */
    public function addBookAction(Request $request){
       return $this->get("book_manager")->addBook($request);
        
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
      return $this->get("book_manager")->removeBook($id);
   }
   
   /**
     * 
     * @ApiDoc(
     *  resource = true,
     *  description="Update an existing book",
     *  tags={
     *      "in-development"},
    * input="book",
     *  output="AppBundle\Entity\Book",
    * parameters={
    * {"name"="bookId", "dataType"="Integer", "required"=true}
    * }
     * )
     * 
     */
   public function putBookAction(Request $request, $id){
       return $this->get("book_manager")->updateBook($request, $id);
   }
    
}

