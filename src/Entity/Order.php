<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ordername = null;

    #[ORM\Column]
    private ?int $ordernumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $orderdate = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentamount = null;



    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'ordername')]
    private Collection $Products;

    #[ORM\ManyToOne(inversedBy: 'Orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $username = null;

    public function __construct()
    {
        $this->Products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdername(): ?string
    {
        return $this->ordername;
    }

    public function setOrdername(string $ordername): static
    {
        $this->ordername = $ordername;

        return $this;
    }

    public function getOrdernumber(): ?int
    {
        return $this->ordernumber;
    }

    public function setOrdernumber(int $ordernumber): static
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }

    public function getOrderdate(): ?\DateTimeInterface
    {
        return $this->orderdate;
    }

    public function setOrderdate(\DateTimeInterface $orderdate): static
    {
        $this->orderdate = $orderdate;

        return $this;
    }

    public function getPaymentamount(): ?string
    {
        return $this->paymentamount;
    }

    public function setPaymentamount(string $paymentamount): static
    {
        $this->paymentamount = $paymentamount;

        return $this;
    }


    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->Products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->Products->contains($product)) {
            $this->Products->add($product);
            $product->addOrdername($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->Products->removeElement($product)) {
            $product->removeOrdername($this);
        }

        return $this;
    }

    public function getUsername(): ?User
    {
        return $this->username;
    }

    public function setUsername(?User $username): static
    {
        $this->username = $username;

        return $this;
    }
}
