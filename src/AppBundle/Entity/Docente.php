<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Models\Persona as BasePersona;

/**
 * Docente
 *
 * @ORM\Table(name="docente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocenteRepository")
 * @ORM\HasLifecycleCallbacks()
*/
class Docente extends BasePersona
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
        return array('ROLE_DOCENTE');
    }
}

