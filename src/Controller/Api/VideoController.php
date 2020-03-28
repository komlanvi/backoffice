<?php

namespace App\Controller\Api;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class VideoController extends AbstractController
{
    /**
     * @Route("/api/videos", name="api_show_videos")
     * @param SerializerInterface $serializer
     * @param VideoRepository $repository
     * @return string
     */
    public function index(SerializerInterface $serializer, VideoRepository $repository, Request $request)
    {
        $hostName = $request->server->get('SERVER_NAME');
        $videos = $repository->findAll();
        $updated_videos = [];
        foreach ($videos as $key => $video) {
            $pathToUploads = $this->getParameter('app.path.videos');
            $updated_video = $video->setFilePath($hostName, $pathToUploads);
            $updated_videos[$key] = $updated_video;
        }

        $data = $serializer->serialize($updated_videos, 'json', ['groups' => 'group1']);

        return new Response($data, Response::HTTP_OK, ['Content-type' => 'application/json']);
    }

    /**
     * @Route("/api/videos/{id}", name="api_show_video")
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param Video $video
     * @return Response
     */
    public function show(Request $request, SerializerInterface $serializer, Video $video)
    {
        $hostName = $request->server->get('SERVER_NAME');
        $pathToUploads = $this->getParameter('app.path.videos');
        $updated_video = $video->setFilePath($hostName, $pathToUploads);
        $data = $serializer->serialize($updated_video, 'json', ['groups' => 'group1']);

        return new Response($data, Response::HTTP_OK, ['Content-type' => 'application/json']);
    }
}
