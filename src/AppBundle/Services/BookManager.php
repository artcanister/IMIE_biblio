<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory ;
use Symfony\Component\HttpKernel\Exception\HttpException;
use AppBundle\Entity\Book;

class BookManager{
    private $factory;
    private $em;
    private $repo;
    public function __construct(EntityManager $entityManager, FormFactory $factory) {
        $this->em = $entityManager;
        $this->repo = $this->em->getRepository("AppBundle:Book");
        $this->factory = $factory;
        //ici on appelle l'entity manager car besoin tout le temps
        //le repo, pareil, pour utiliser toutes les méthodes sur le repo
    }
    
    //remove, add and update for api here
    
    public function addBook(Request $request){
        $book = new Book();
        $form = $this->factory->create('book', $book);
        $form->handleRequest($request);
        if(count($form->getErrors(true))>0){
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            
        }
        

        return $book;
      
    }
    
    public function removeBook(){
        
    }
    
    public function updateBook(Request $request, $id){
        //handleRequest : fait lui-même le set des datas
        
        $book = $this->repo->findOneById($id);
        $form = $this->factory->create('book', $book);
        $form->handleRequest($request);
        
            if(count($form->getErrors(true))>0){
            
            $this->persist($book);
            $this->flush();
        }
        
        
 
        return $book;
    }
    
    public function findById($id){
        
       $book = $this->repo->findOneById($id);
        return $book;
    }
}

