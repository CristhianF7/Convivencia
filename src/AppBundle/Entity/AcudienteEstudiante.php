<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcudienteEstudiante
 *
 * @ORM\Table(name="acudiente_estudiante")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AcudienteEstudianteRepository")
 */
class AcudienteEstudiante
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Acudiente")
     */
    private $acudiente;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Estudiante")
     */
    private $estudiante;

    /**
     * @var string
     *
     * @ORM\Column(name="parentesco", type="string", length=255)
     */
    private $parentesco;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text")
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEdicion", type="datetime")
     */
    private $fechaEdicion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set acudiente
     *
     * @param string $acudiente
     *
     * @return AcudienteEstudiante
     */
    public function setAcudiente($acudiente)
    {
        $this->acudiente = $acudiente;

        return $this;
    }

    /**
     * Get acudiente
     *
     * @return string
     */
    public function getAcudiente()
    {
        return $this->acudiente;
    }

    /**
     * Set estudiante
     *
     * @param string $estudiante
     *
     * @return AcudienteEstudiante
     */
    public function setEstudiante($estudiante)
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * Get estudiante
     *
     * @return string
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set parentesco
     *
     * @param string $parentesco
     *
     * @return AcudienteEstudiante
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return AcudienteEstudiante
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return AcudienteEstudiante
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaEdicion
     *
     * @param \DateTime $fechaEdicion
     *
     * @return AcudienteEstudiante
     */
    public function setFechaEdicion($fechaEdicion)
    {
        $this->fechaEdicion = $fechaEdicion;

        return $this;
    }

    /**
     * Get fechaEdicion
     *
     * @return \DateTime
     */
    public function getFechaEdicion()
    {
        return $this->fechaEdicion;
    }
}

