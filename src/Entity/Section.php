<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(
        options: [
            'unsigned' => true,
        ]
    )]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $sectionTitle = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $sectionDescription = null;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'sections')]
    private Collection $sectionPost;

    public function __construct()
    {
        $this->sectionPost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSectionTitle(): ?string
    {
        return $this->sectionTitle;
    }

    public function setSectionTitle(string $sectionTitle): static
    {
        $this->sectionTitle = $sectionTitle;

        return $this;
    }

    public function getSectionDescription(): ?string
    {
        return $this->sectionDescription;
    }

    public function setSectionDescription(?string $sectionDescription): static
    {
        $this->sectionDescription = $sectionDescription;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getSectionPost(): Collection
    {
        return $this->sectionPost;
    }

    public function addSectionPost(Post $sectionPost): static
    {
        if (!$this->sectionPost->contains($sectionPost)) {
            $this->sectionPost->add($sectionPost);
        }

        return $this;
    }

    public function removeSectionPost(Post $sectionPost): static
    {
        $this->sectionPost->removeElement($sectionPost);

        return $this;
    }
}
