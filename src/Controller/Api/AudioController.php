<?php

namespace App\Controller\Api;

use App\Entity\Audio;
use App\Repository\AudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AudioController extends AbstractController
{
    /**
     * @Route("/api/audios", name="api_show_audios")
     * @param SerializerInterface $serializer
     * @param AudioRepository $repository
     * @return string
     */
    public function index(SerializerInterface $serializer, AudioRepository $repository, Request $request)
    {
        $hostName = $request->server->get('SERVER_NAME');
        $audios = $repository->findAll();
        $updated_audios = [];
        foreach ($audios as $key => $audio) {
            $pathToUploads = $this->getParameter('app.path.audios');
            $updated_audio = $audio->setFilePath($hostName, $pathToUploads);
            $updated_audios[$key] = $updated_audio;
        }

        $data = $serializer->serialize($updated_audios, 'json', ['groups' => 'group1']);

        return new Response($data, Response::HTTP_CREATED, ['Content-type' => 'application/json']);
    }

    /**
     * @Route("/api/audios/{id}", name="api_show_audio")
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param Audio $audio
     * @return Response
     */
    public function show(Request $request, SerializerInterface $serializer, Audio $audio)
    {
        $hostName = $request->server->get('SERVER_NAME');
        $pathToUploads = $this->getParameter('app.path.audios');
        $updated_audio = $audio->setFilePath($hostName, $pathToUploads);
        $data = $serializer->serialize($updated_audio, 'json', ['groups' => 'group1']);

        return new Response($data, Response::HTTP_OK, ['Content-type' => 'application/json']);
    }
}
