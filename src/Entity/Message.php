<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
/**
 * TODO: Review Message class
 */
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Code-Review: add "nullable: true" OR make it non nullable and initialize $uuid in the constructor
    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    // Code-Review: add "nullable: true" OR make it non nullable
    #[ORM\Column(length: 255)]
    private ?string $text = null;

    // Code-Review: string can accept any string status. Please define choices and add validation here
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;
    
    // Code-Review: $createdAt is typed as DateTime, which cannot be null, Initialize $createdAt in the constructor
    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
}
