<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Models\Persona as BasePersona;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdministradorRepository")
 */
class Administrador extends BasePersona
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }
}

