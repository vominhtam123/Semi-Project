<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prodname = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productImage;

    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'Products')]
    private Collection $ordername;

    #[ORM\ManyToOne(inversedBy: 'Products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'prodname', targetEntity: Review::class)]
    private Collection $Reviews;

    public function __construct()
    {
        $this->ordername = new ArrayCollection();
        $this->Reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdname(): ?string
    {
        return $this->prodname;
    }

    public function setProdname(string $prodname): static
    {
        $this->prodname = $prodname;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getProductImage(): ?string
    {
        return $this->productImage;
    }

    public function setProductImage(string $productImage): static
    {
        $this->productImage = $productImage;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrdername(): Collection
    {
        return $this->ordername;
    }

    public function addOrdername(Order $ordername): static
    {
        if (!$this->ordername->contains($ordername)) {
            $this->ordername->add($ordername);
        }

        return $this;
    }

    public function removeOrdername(Order $ordername): static
    {
        $this->ordername->removeElement($ordername);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->Reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->Reviews->contains($review)) {
            $this->Reviews->add($review);
            $review->setProdname($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->Reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProdname() === $this) {
                $review->setProdname(null);
            }
        }

        return $this;
    }
}
