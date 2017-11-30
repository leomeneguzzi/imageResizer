<?php

// src/AppBundle/Entity/Image.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Image
{
    // ...

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Por favor, faça o upload de uma imagem.")
     * @Assert\Image(mimeTypesMessage="Este arquivo não é um tipo de imagem válido.")
     */
    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}