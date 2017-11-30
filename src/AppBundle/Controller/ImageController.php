<?php

// src/AppBundle/Controller/ImageController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Image;
use AppBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ImageController extends Controller
{
    /**
     * @Route("/image/resize", name="app_image_resize")
     */
    public function resizeAction(Request $request)
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded Image file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $image->getFile();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where files are stored
            $file->move(
                $this->getParameter('files_directory'),
                $fileName
            );

            // Update the 'file' property to store the Image file name
            // instead of its contents
            $image->setFile($fileName);

            //... persist the $image variable or any other work
            return $this->render('image/uploaded.html.twig', array(
                'image' => $image
            ));
        }

        return $this->render('image/resize.html.twig', array(
            'form' => $form  
                ->createView(),
        ));
    }

}