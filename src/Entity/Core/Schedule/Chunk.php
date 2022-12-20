<?php

namespace App\Entity\Core\Schedule;

use App\Entity\Core\Task;
use App\Entity\Core\User;
use App\Repository\Core\Schedule\ChunkRepository as ScheduleChunkRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleChunkRepository::class)]
class Chunk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'scheduleChunks')]
    private ?Task $link = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'scheduleChunks')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?int $estimate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?Task
    {
        return $this->link;
    }

    public function setLink(?Task $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEstimate(): ?int
    {
        return $this->estimate;
    }

    public function setEstimate(?int $estimate): self
    {
        $this->estimate = $estimate;

        return $this;
    }
}
