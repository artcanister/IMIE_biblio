<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
    public function newBookAction(Request $request){
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
    /**
     * WSSE Token generation
     *
     * @return FOSView
     * @throws AccessDeniedException
     * @ApiDoc(
     *  resource=true,
     *  description="Return a token",
     *  requirements={
     *      {
     *          "name"="username",
     *          "dataType"="string",
     *          "description"="Your Username"
     *      },
     *      {
     *          "name"="password",
     *          "dataType"="string",
     *          "description"="Your Password"
     *      },
     *  },
     *  statusCodes={
     *         200="Returned when successful",
     *         401={
     *           "Returned for any error encountered",
     *         }
     *     }
     * )
     */
    public function postTokenCreateAction()
    {
        $view    = FOSView::create();
        $request = $this->getRequest();
        $realm = $this->getRequest()->getHost();
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        if((null === $username) || (null === $password)) {
            throw new UnauthorizedHttpException($realm,'Bad payload.');
        }
        $em   = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneByUsername($username);
        $encoder_service = $this->get('security.encoder_factory');
        $encoder      = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword($password, $user->getSalt());
        if (!$user) {
            throw new UnauthorizedHttpException($realm,'Bad payload');
        }
        $created   = date('c');
        $nonce     = substr(md5(uniqid('nonce_', true)), 0, 16);
        $nonceHigh = base64_encode($nonce);
        //generate Nonce
        $passwordDigest = base64_encode(sha1($nonce.$created.$encoded_pass, true));
        //generate passwordDigest
        $header = "UsernameToken Username=\"{$username}\", PasswordDigest=\"{$passwordDigest}\", Nonce=\"{$nonceHigh}\", Created=\"{$created}\"";
        //generate header
        $view->setHeader('Authorization', 'WSSE profile="UsernameToken"');
        $view->setHeader('x-wsse', "UsernameToken Username=\"{$username}\", PasswordDigest=\"{$passwordDigest}\", Nonce=\"{$nonceHigh}\", Created=\"{$created}\"");
        $data = array('x-wsse' => $header);
        $view->setStatusCode(200)->setData($data);
        return $view;
    }
    
}

