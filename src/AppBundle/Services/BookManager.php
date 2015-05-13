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
        $form->bind($request);
        if($form->isValid()){
            $this->em->persist($book);
            $this->em->flush();
            
        }
        

        return $book;
      
    }
    
    public function removeBook($id){
        $book = $this->repo->findOneById($id);
        $this->em->remove($book);
        $this->em->flush();
        
    }
    
    public function updateBook(Request $request, $id){
        //bind : fait lui-même le set des datas
        
        $book = $this->repo->findOneById($id);
        $form = $this->factory->create('book', $book);
        $form->bind($request);
        
        if($form->isValid()){
            
            $this->em->persist($book);
            $this->em->flush();
        }
        
        
 
        return $book;
    }
    
    public function findById($id){
        
       $book = $this->repo->findOneById($id);
        return $book;
    }
}

