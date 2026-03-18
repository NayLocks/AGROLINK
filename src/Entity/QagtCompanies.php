<?php

namespace App\Entity;

use App\Repository\QagtCompaniesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QagtCompaniesRepository::class)]
class QagtCompanies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $legal = null;

    #[ORM\Column(length: 255)]
    private ?string $address1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address2 = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $poBox = null;

    #[ORM\Column(length: 10)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?bool $isActived = null;

    /**
     * @var Collection<int, QagtUsers>
     */
    #[ORM\ManyToMany(targetEntity: QagtUsers::class, mappedBy: 'companies')]
    private Collection $qagtUsers;

    /**
     * @var Collection<int, QagtUsers>
     */
    #[ORM\OneToMany(targetEntity: QagtUsers::class, mappedBy: 'companyActive')]
    private Collection $qagtUsersActive;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $siren = null;

    #[ORM\Column(length: 13, nullable: true)]
    private ?string $vat = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $businessName = null;

    public function __construct()
    {
        $this->qagtUsers = new ArrayCollection();
        $this->qagtUsersActive = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLegal(): ?string
    {
        return $this->legal;
    }

    public function setLegal(?string $legal): static
    {
        $this->legal = $legal;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): static
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): static
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getPoBox(): ?string
    {
        return $this->poBox;
    }

    public function setPoBox(?string $poBox): static
    {
        $this->poBox = $poBox;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function isActived(): ?bool
    {
        return $this->isActived;
    }

    public function setIsActived(bool $isActived): static
    {
        $this->isActived = $isActived;

        return $this;
    }

    /**
     * @return Collection<int, QagtUsers>
     */
    public function getQagtUsers(): Collection
    {
        return $this->qagtUsers;
    }

    public function addQagtUser(QagtUsers $qagtUser): static
    {
        if (!$this->qagtUsers->contains($qagtUser)) {
            $this->qagtUsers->add($qagtUser);
            $qagtUser->addCompany($this);
        }

        return $this;
    }

    public function removeQagtUser(QagtUsers $qagtUser): static
    {
        if ($this->qagtUsers->removeElement($qagtUser)) {
            $qagtUser->removeCompany($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, QagtUsers>
     */
    public function getQagtUsersActive(): Collection
    {
        return $this->qagtUsersActive;
    }

    public function addQagtUsersActive(QagtUsers $qagtUsersActive): static
    {
        if (!$this->qagtUsersActive->contains($qagtUsersActive)) {
            $this->qagtUsersActive->add($qagtUsersActive);
            $qagtUsersActive->setCompanyActive($this);
        }

        return $this;
    }

    public function removeQagtUsersActive(QagtUsers $qagtUsersActive): static
    {
        if ($this->qagtUsersActive->removeElement($qagtUsersActive)) {
            // set the owning side to null (unless already changed)
            if ($qagtUsersActive->getCompanyActive() === $this) {
                $qagtUsersActive->setCompanyActive(null);
            }
        }

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): static
    {
        $this->siren = $siren;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(?string $vat): static
    {
        $this->vat = $vat;

        return $this;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function setBusinessName(?string $businessName): static
    {
        $this->businessName = $businessName;

        return $this;
    }
}
