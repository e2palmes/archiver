<?php

namespace App\Controller;

use App\Entity\Degree;
use App\Repository\DegreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/degree', name: 'degree.')]
class DegreeController extends AbstractController
{
    #[Route('/', name: 'all', methods: ['GET'])]
    public function getAllDegrees(DegreeRepository $degreeRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $degrees = $degreeRepository->findAll();
        $jsonDegrees = $serializerInterface->serialize($degrees, 'json', ['groups' => 'getDegree']);
        return new JsonResponse($jsonDegrees, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'id', methods: ['GET'])]
    public function getDegree(Degree $degree, SerializerInterface $serializerInterface): JsonResponse
    {
        $jsonDegree = $serializerInterface->serialize($degree, 'json', ['groups' => 'getDegree']);
        return new JsonResponse($jsonDegree, Response::HTTP_OK, json: true);
    }

    #[Route('/', name: 'post', methods: ['POST'])]
    public function postDegree(Request $request, SerializerInterface $serializerInterface, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $degree = $serializerInterface->deserialize($request->getContent(), Degree::class, 'json');
        $em->persist($degree);
        $em->flush();

        $jsonDegree = $serializerInterface->serialize($degree, 'json', ['groups' => 'getDegree']);
        $location = $urlGenerator->generate('degree.id', ['id' => $degree->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);
        return new JsonResponse($jsonDegree, Response::HTTP_CREATED, ['location' => $location], true);
    }

    #[Route('/{id}', name: 'put', methods: ['PUT'])]
    public function putDegree(Request $request, Degree $currentDegree, EntityManagerInterface $em, SerializerInterface $serializerInterface): JsonResponse
    {
        $updatedDegree = $serializerInterface->deserialize($request->getContent(), Degree::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentDegree]);

        $em->persist($updatedDegree);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteDegree(Request $request, Degree $degree, EntityManagerInterface $em, SerializerInterface $serializerInterface): JsonResponse
    {
        $em->remove($degree);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
