<?php

namespace App\Entity;

use App\Repository\MetaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetaRepository::class)
 */
class Meta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $page_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metakey;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $metavalue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metatype;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    public function setPageId(int $page_id): self
    {
        $this->page_id = $page_id;

        return $this;
    }

    public function getMetakey(): ?string
    {
        return $this->metakey;
    }

    public function setMetakey(string $metakey): self
    {
        $this->metakey = $metakey;

        return $this;
    }

    public function getMetavalue(): ?string
    {
        return $this->metavalue;
    }

    public function setMetavalue(?string $metavalue): self
    {
        $this->metavalue = $metavalue;

        return $this;
    }

    public function getMetatype(): ?string
    {
        return $this->metatype;
    }

    public function setMetatype(string $metatype): self
    {
        $this->metatype = $metatype;

        return $this;
    }
}
