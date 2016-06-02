<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Models\Persona as BasePersona;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Estudiante
 *
 * @ORM\Table(name="estudiante")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstudianteRepository")
 */
class Estudiante extends BasePersona
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getRoles()
    {
        return array('ROLE_ESTUDIANTE');
    }

    /**
     * @ORM\OneToMany(targetEntity="AcudienteEstudiante", mappedBy="estudiante", cascade={"persist"})
     * @Assert\Valid()    
     */
    private $acudientes;

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Estudiante
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add acudiente
     *
     * @param \AppBundle\Entity\AcudienteEstudiante $acudiente
     *
     * @return Estudiante
     */
    public function addAcudiente(\AppBundle\Entity\AcudienteEstudiante $acudiente)
    {
        $this->acudientes[] = $acudiente;

        return $this;
    }

    /**
     * Remove acudiente
     *
     * @param \AppBundle\Entity\AcudienteEstudiante $acudiente
     */
    public function removeAcudiente(\AppBundle\Entity\AcudienteEstudiante $acudiente)
    {
        $this->acudientes->removeElement($acudiente);
    }

    /**
     * Get acudientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcudientes()
    {
        return $this->acudientes;
    }
}
