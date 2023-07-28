<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reviewname = null;

    #[ORM\Column(length: 255)]
    private ?string $quality = null;

    #[ORM\ManyToOne(inversedBy: 'Reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $prodname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviewname(): ?string
    {
        return $this->reviewname;
    }

    public function setReviewname(string $reviewname): static
    {
        $this->reviewname = $reviewname;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(string $quality): static
    {
        $this->quality = $quality;

        return $this;
    }

    public function getProdname(): ?Product
    {
        return $this->prodname;
    }

    public function setProdname(?Product $prodname): static
    {
        $this->prodname = $prodname;

        return $this;
    }
}
