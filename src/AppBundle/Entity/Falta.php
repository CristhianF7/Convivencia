<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Falta
 *
 * @ORM\Table(name="falta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FaltaRepository")
 */
class Falta
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
     * @ORM\ManyToOne(targetEntity="TipoFalta")
     */
    private $tipoFalta;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Estudiante")
     */
    private $estudiante;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     *
     * @var type string
     * @ORM\Column(name="respuesta", type="text", nullable=true)
     */
    private $respuesta;

    public function getRespuesta() {
        return $this->respuesta;
    }

    public function setRespuesta(type $respuesta) {
        $this->respuesta = $respuesta;
    }

        /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Docente")
     */
    private $docente;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="EstadosFaltas")
     */
    private $estado;


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
     * Set tipoFalta
     *
     * @param string $tipoFalta
     *
     * @return Falta
     */
    public function setTipoFalta($tipoFalta)
    {
        $this->tipoFalta = $tipoFalta;

        return $this;
    }

    /**
     * Get tipoFalta
     *
     * @return string
     */
    public function getTipoFalta()
    {
        return $this->tipoFalta;
    }

    /**
     * Set estudiante
     *
     * @param string $estudiante
     *
     * @return Falta
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Falta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Falta
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
     * Set docente
     *
     * @param string $docente
     *
     * @return Falta
     */
    public function setDocente($docente)
    {
        $this->docente = $docente;

        return $this;
    }

    /**
     * Get docente
     *
     * @return string
     */
    public function getDocente()
    {
        return $this->docente;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Falta
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

