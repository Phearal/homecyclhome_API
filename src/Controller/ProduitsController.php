<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitsController extends AbstractController
{
    /* Renvoie tous les produits */
    #[Route('/produits', name: 'produits', methods: ["GET"])]
    public function get_produits(ProduitsRepository $produitsRepository, SerializerInterface $serializer): JsonResponse
    {
        $produits = $produitsRepository->findAll();
        $produits_json = $serializer->serialize($produits, "json");
        return new JsonResponse($produits_json, Response::HTTP_OK, [], true);
    }

    /* Renvoie un produit via son id */
    #[Route('/produits/{id}', name: 'produit', methods: ["GET"])]
    public function get_produit(Produits $produit, ProduitsRepository $produitsRepository, SerializerInterface $serializer): JsonResponse
    {
        $produit_json = $serializer->serialize($produit, 'json');
        return new JsonResponse($produit_json, Response::HTTP_OK, [], true);
    }

    /* Met à jour un produit */
    #[Route('/produits/{id}/edit', name: 'produit_edit', methods: ["GET"])]
    public function edit_produit(Produits $produit, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $produit->setDesignation("aqzdeazeaze");
        $produit_json = $serializer->serialize($produit, 'json');
        try {
            $entityManager->persist($produit);
            $entityManager->flush();
            return new JsonResponse($produit_json, Response::HTTP_OK, [], true);
        } catch(Exception $e) {
            return new JsonResponse($produit, Response::HTTP_INTERNAL_SERVER_ERROR, [], true);
        }
    }

    /* Ajoute un produit */
    /* Supprime un produit */
    /* Écrase un produit */
}
