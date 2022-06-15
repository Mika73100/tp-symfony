<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\UserService;


class ServiceController extends AbstractController
{
        /*** @Route("/service", name="app_service")*/
        public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ServiceController.php',
        ]);
    }

        //je crée la route :
        /*** @Route("/service/create", name="app_service_create")*/
        public function creatAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $product = new UserService();
        $product->setNom('Mika');
        $product->setAge(13);
        // informe Doctrine que l’on veut ajouter
        // Cet objet dans la base de donnees 
        $entityManager->persist($product);
        // Executer la requête et d’envoyer tout ce qui à été persisté avant a la BD
        $entityManager->flush();
        return new Response('Personnel ajouté ');
    }

        //je crée la route :
        /*** @Route("/service/search", name="app_service_search")*/
        //Je crée une nouvelle méthode
        public function searchAction(){
        $repository = $this->getDoctrine()->getRepository(UserService::class);
        // Récupèrer l'objet en fonction de l'Id 
        $product = $repository->find($id);
        // Rechercher un seul produit par son nom
        $produit = $repository->findOneBy(['nom' => 'Mika']);
        // Rechercher un seul produit par son nom et son prix
        $produit = $repository->findOneBy(['nom' => 'Mika','age' => '15',]);
        //ici inscrire le nom de la table visé
        $repository = new UserService('nom','age');
        // Rechercher des produits en fonction de multiples conditions
        $product = $repository->findBy(
        ['nom' => 'Mika'],
        ['age' => '15'], // le deuxième paramètre permet de définir l'ordre 
        10, // le troisième la limite
        ('Limite en Mysql'),
        0 // et à partir duquel on récupère (OFFSET en MySQL)
        );
        // Retrouver tous les produits
        $users = $repository->findAll();
    }
}
?>