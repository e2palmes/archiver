<?php

namespace App\Controller;

use App\Entity\Document;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/document', name: 'document.')]
class DocumentController extends AbstractController
{
    #[Route('/', name: 'all', methods: ['GET'])]
    public function getAllDocuments(DocumentRepository $documentRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $documentsList = $documentRepository->findAll();
        if ($documentsList) {
            $jsonDocumentsList = $serializerInterface->serialize($documentsList, 'json', ['groups' => 'getDocument']);
            return new JsonResponse($jsonDocumentsList, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/{id}', name: 'id', methods: ['GET'])]
    public function getDocument(Document $document, SerializerInterface $serializerInterface): JsonResponse
    {
        $jsonDocument = $serializerInterface->serialize($document, 'json', ['groups' => 'getDocument']);
        return new JsonResponse($jsonDocument, Response::HTTP_OK, [], true);
    }

    #[Route('/', name: 'post', methods: ['POST'])]
    public function postDocument(Request $request, SerializerInterface $serializerInterface, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $document = $serializerInterface->deserialize($request->getContent(), Document::class, 'json');
        $em->persist($document);
        $em->flush();

        $jsonDocument = $serializerInterface->serialize($document, 'json', ['groups' => 'getDocument']);
        $location = $urlGenerator->generate('document.id', ['id' => $document->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);
        return new JsonResponse($jsonDocument, Response::HTTP_CREATED, ['location' => $location], true);
    }

    #[Route('/{id}', name: 'put', methods: ['PUT'])]
    public function putDocument(Request $request, Document $currentDocument, EntityManagerInterface $em, SerializerInterface $serializerInterface): JsonResponse
    {
        $updatedDocument = $serializerInterface->deserialize($request->getContent(), Degree::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentDocument]);

        $em->persist($updatedDocument);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteDocument(Document $document, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($document);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
