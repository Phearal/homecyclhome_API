<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitsController extends AbstractController
{
    /* Renvoie tous les produits */
    #[Route('/api/produits', name: 'produits', methods: ["GET"])]
    public function get_produits(ProduitsRepository $produitsRepository, SerializerInterface $serializer): JsonResponse
    {
        $produits = $produitsRepository->findAll();
        $produits_json = $serializer->serialize($produits, "json", ["groups" => "get_produits"]);
        return new JsonResponse($produits_json, Response::HTTP_OK, [], true);
    }

    /* Renvoie un produit via son id */
    #[Route('/api/produits/{id}', name: 'produit', methods: ["GET"])]
    public function get_produit(Produits $produit, ProduitsRepository $produitsRepository, SerializerInterface $serializer): JsonResponse
    {
        $produit_json = $serializer->serialize($produit, 'json', ["groups" => "get_produit"]);
        return new JsonResponse($produit_json, Response::HTTP_OK, [], true);
    }

    /* Supprime un produit via son id */
    #[Route('/api/produits/{id}', name: 'delete_produit', methods: ["DELETE"])]
    public function delete_produit(Produits $produit, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($produit);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT, [], true);
    }

    /* Créé un nouveau produit */
    #[Route('/api/produits', name: 'create_produit', methods: ["POST"])]
    #[IsGranted("ROLE_ADMIN", message: "Droits insuffisants.")]
    public function create_produit(Request $request, EntityManagerInterface $em, SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator): JsonResponse
    {
        $produit = $serializer->deserialize($request->getContent(), Produits::class, "json");

        $errors = $validator->validate($produit);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, "json"), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $em->persist($produit);
        $em->flush();
        $json_produit = $serializer->serialize($produit, "json", ["groups" => "get_produits"]);
        $location = $urlGenerator->generate("produit", ["id" => $produit->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        return new JsonResponse($json_produit, Response::HTTP_CREATED, ["location" => $location], true);
    }

    /* Met à jour un produit via son id */
    #[Route('/api/produits/{id}', name: 'update_produit', methods: ["PUT"])]
    public function update_produit(Produits $produit, EntityManagerInterface $em, SerializerInterface $serializer, ProduitsRepository $produitsrepository, Request $request): JsonResponse
    {
        $produit_modifie = $serializer->deserialize($request->getContent(), Produits::class, "json", [AbstractNormalizer::OBJECT_TO_POPULATE => $produit]);
        $em->persist($produit_modifie);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /* Met à jour un produit */
    #[Route('/api/produits/{id}/edit', name: 'produit_edit', methods: ["GET"])]
    public function edit_produit(Produits $produit, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $produit->setDesignation("aqzdeazeaze");
        $produit_json = $serializer->serialize($produit, 'json');
        try {
            $em->persist($produit);
            $em->flush();
            return new JsonResponse($produit_json, Response::HTTP_OK, [], true);
        } catch(Exception $e) {
            return new JsonResponse($produit, Response::HTTP_INTERNAL_SERVER_ERROR, [], true);
        }
    }

    /* Ajoute un produit */
    /* Supprime un produit */
    /* Écrase un produit */
}
