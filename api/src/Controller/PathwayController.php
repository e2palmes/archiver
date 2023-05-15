<?php

namespace App\Controller;

use App\Entity\Pathway;
use App\Repository\PathwayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/pathway', name: 'pathway.')]
class PathwayController extends AbstractController
{
    #[Route('/', name: 'all', methods: ['GET'])]
    public function getAllPathways(PathwayRepository $pathwayRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $pathwaysList = $pathwayRepository->findAll();
        if ($pathwaysList) {
            $jsonPathwaysList = $serializerInterface->serialize($pathwaysList, 'json', ['groups' => 'getPathway']);
            return new JsonResponse($jsonPathwaysList, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'id', methods: ['GET'])]
    public function getPathway(Pathway $pathway, SerializerInterface $serializerInterface): JsonResponse
    {
        $jsonPathway = $serializerInterface->serialize($pathway, 'json', ['groups' => 'getPathway']);
        return new JsonResponse($jsonPathway, Response::HTTP_OK);
    }

    #[Route('/', name: 'post', methods: ['POST'])]
    public function postPathway(Request $request, EntityManagerInterface $em, SerializerInterface $serializerInterface, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $pathway = $serializerInterface->deserialize($request->getContent(), Pathway::class, 'json');
        $em->persist($pathway);
        $em->flush();

        $jsonPathway = $serializerInterface->serialize($pathway, 'json', ['groups' => 'getPathway']);
        $location = $urlGenerator->generate('pathway.id', ['id' => $pathway->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);
        return new JsonResponse($jsonPathway, Response::HTTP_OK, ['location' => $location], true);
    }

    #[Route('/{id}', name: 'put', methods: ['PUT'])]
    public function putPathway(Request $request, Pathway $currentPathway, EntityManagerInterface $em, SerializerInterface $serializerInterface): JsonResponse
    {
        $updatePathway = $serializerInterface->deserialize($request->getContent(), Pathway::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentPathway]);

        $em->persist($updatePathway);
        $em->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function getAllPathway(Pathway $pathway, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($pathway);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
