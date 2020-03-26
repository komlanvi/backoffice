<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 * @Vich\Uploadable
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $insertedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $fileName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int | null
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string | null
     */
    private $originalName;

    /**
     * @Vich\UploadableField(mapping="videos", fileNameProperty="fileName", size="size", originalName="originalName")
     * @var File
     */
    private $file;

    public function setFile(File $file = null): self
    {
        $this->file = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if (null !== $file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->insertedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInsertedAt(): ?\DateTimeInterface
    {
        return $this->insertedAt;
    }
}
