<?php

namespace App\Entity\Core;

use App\Entity\Core\Schedule\Chunk;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Task::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $code = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $status = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'tasks')]
    private Collection $owner;

    #[ORM\Column(nullable: true)]
    private ?int $estimate = null;

    #[ORM\Column(nullable: true)]
    private ?int $spent = null;

    #[ORM\OneToMany(mappedBy: 'link', targetEntity: Chunk::class)]
    private Collection $scheduleChunks;

    public function __construct()
    {
        $this->owner = new ArrayCollection();
        $this->scheduleChunks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOwner(): Collection
    {
        return $this->owner;
    }

    public function addOwner(User $owner): self
    {
        if (!$this->owner->contains($owner)) {
            $this->owner->add($owner);
        }

        return $this;
    }

    public function removeOwner(User $owner): self
    {
        $this->owner->removeElement($owner);

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

    public function getSpent(): ?int
    {
        return $this->spent;
    }

    public function setSpent(?int $spent): self
    {
        $this->spent = $spent;

        return $this;
    }

    /**
     * @return Collection<int, Chunk>
     */
    public function getScheduleChunks(): Collection
    {
        return $this->scheduleChunks;
    }

    public function addScheduleChunk(Chunk $scheduleChunk): self
    {
        if (!$this->scheduleChunks->contains($scheduleChunk)) {
            $this->scheduleChunks->add($scheduleChunk);
            $scheduleChunk->setLink($this);
        }

        return $this;
    }

    public function removeScheduleChunk(Chunk $scheduleChunk): self
    {
        if ($this->scheduleChunks->removeElement($scheduleChunk)) {
            // set the owning side to null (unless already changed)
            if ($scheduleChunk->getLink() === $this) {
                $scheduleChunk->setLink(null);
            }
        }

        return $this;
    }
}
