<?php

namespace App\Controller;

use App\Entity\Level;
use App\Repository\LevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/level', name: 'level.')]
class LevelController extends AbstractController
{
    #[Route('/', name: 'all', methods: ['GET'])]
    public function getAllLevels(LevelRepository $levelRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $levelsList = $levelRepository->findAll();
        $jsonLevelsList = $serializerInterface->serialize($levelsList, 'json', ['groups' => 'getLevel']);
        return new JsonResponse($jsonLevelsList, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'id', methods: ['GET'])]
    public function getLevel(Level $level, SerializerInterface $serializerInterface): JsonResponse
    {
        $jsonLevel = $serializerInterface->serialize($level, 'json', ['groups' => 'getLevel']);
        return new JsonResponse($jsonLevel, Response::HTTP_OK, [], true);
    }

    #[Route('/', name: 'post', methods: ['POST'])]
    public function postLevel(Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializerInterface, EntityManagerInterface $em): JsonResponse
    {
        $level = $serializerInterface->deserialize($request->getContent(), Level::class, 'json');
        $em->persist($level);
        $em->flush();

        $jsonLevel = $serializerInterface->serialize($level, 'json', ['groups' => 'getLevel']);
        $location = $urlGenerator->generate('level.id', ['id' => $level->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);
        return new JsonResponse($jsonLevel, Response::HTTP_OK, ['location' => $location], true);
    }

    #[Route('/', name: 'put', methods: ['PUT'])]
    public function putLevel(Request $request, Level $currentLevel, LevelRepository $levelRepository, EntityManagerInterface $em, SerializerInterface $serializerInterface, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $updatedLevel = $serializerInterface->deserialize($request->getContent(), Level::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentLevel]);

        $em->persist($updatedLevel);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteLevel(Level $level, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($level);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
