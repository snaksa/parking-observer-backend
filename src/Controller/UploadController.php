<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload")
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request)
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('image');

        $date = $this->getCurrentDateTime()->format('Y-m-d H:i:s');
        $name = "{$date}.jpg";

        $path = $this->getParameter('imageDir');
        $file->move($path, $name);

        return new JsonResponse($name);
    }

    private function getCurrentDateTime()
    {
        return new \DateTime('now', new \DateTimeZone('UTC'));
    }
}
