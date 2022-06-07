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

        /*** @Route("/service/search", name="app_service_search")*/

        //Je crée une nouvelle méthode
        public function searchAction(){
        $UserServiceRepository = $this->getDoctrine()->getRepository();
        // Récupèrer l'objet
        $UserServiceRepository = $UserServiceRepository->findby;
        // Rechercher un seul produit par son nom
        $UserServiceRepository = $UserServiceRepository->findOneBy(['name' => 'Souris']);
        //ici inscrire le nom de la table visé
        $UserServiceRepository = new UserService();
        // Rechercher des produits en fonction de multiples conditions
        $UserServiceRepository->findBy(
            ['setNom' => 'nom'],
            ['setAge' => 'age'], 
        );
        return new Response('Personnel rechercher');

    }
}
?>