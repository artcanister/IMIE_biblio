<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class BookManager{
    
    private $em;
    private $repo;
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
        $this->repo = $this->em->getRepository("AppBundle:Book");
        //ici on appelle l'entity manager car besoin tout le temps
        //le repo, pareil, pour utiliser toutes les méthodes sur le repo
    }
    
    //remove, add and update for api here
    
    public function addBook(){
        
    }
    
    public function removeBook(){
        
    }
    
    public function updateBook(){
        
    }
    
    public function findById($id){
        
       $book = $this->repo->findOneById($id);
        return $book;
    }
}

