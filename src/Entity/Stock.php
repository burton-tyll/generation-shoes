<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'float')]
    private float $in_store;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $on_order = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $updated_at;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Product $product;

    #[ORM\ManyToOne(targetEntity: ProductVariant::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?ProductVariant $product_variant = null;

    #[ORM\ManyToOne(targetEntity: StockUnit::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private StockUnit $stock_unit;

    public function getId(): int
    {
        return $this->id;
    }

    public function getInStore(): float
    {
        return $this->in_store;
    }

    public function setInStore(float $in_store): void
    {
        $this->in_store = $in_store;
    }

    public function getOnOrder(): ?float
    {
        return $this->on_order;
    }

    public function setOnOrder(?float $on_order): void
    {
        $this->on_order = $on_order;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getProductVariant(): ?ProductVariant
    {
        return $this->product_variant;
    }

    public function setProductVariant(?ProductVariant $product_variant): void
    {
        $this->product_variant = $product_variant;
    }

    public function getStockUnit(): StockUnit
    {
        return $this->stock_unit;
    }

    public function setStockUnit(StockUnit $stock_unit): void
    {
        $this->stock_unit = $stock_unit;
    }

}
