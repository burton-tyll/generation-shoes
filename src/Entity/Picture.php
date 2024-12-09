<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer', length: 255)]
    private int $itemId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $original;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $small;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $big;

    #[ORM\ManyToOne(targetEntity: EntityName::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private EntityName $entity_name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function setOriginal(string $original): void
    {
        $this->original = $original;
    }

    public function getSmall(): ?string
    {
        return $this->small;
    }

    public function setSmall(?string $small): void
    {
        $this->small = $small;
    }

    public function getBig(): ?string
    {
        return $this->big;
    }

    public function setBig(?string $big): void
    {
        $this->big = $big;
    }

    public function getEntityName(): EntityName
    {
        return $this->entity_name;
    }

    public function setEntityName(EntityName $entity_name): void
    {
        $this->entity_name = $entity_name;
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

}
