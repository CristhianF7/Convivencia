<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Models;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping\Column;

/**
 * 
 */
abstract class Persona implements UserInterface, \Serializable
{
    /**
     * @var string
     * @Column(type="string")
     */
    protected $primerNombre;
    
    /**
     * @var string
     * @Column(type="string")
     */
    protected $segundoNombre;
    
    /**
     * @var string
     * @Column(type="string")
     */
    protected $primerApellido;
    
    /**
     * @var string
     * @Column(type="string")
     */
    protected $segundoApellido;

    /**
     * @var \DateTime
     * @Column(type="datetime")
     */
    protected $fechaNacimiento;
    
    /**
     * @var string
     * @Column(type="string", length=25, unique=true)
     */
    protected $username;

    /**
     * @var string
     * @Column(type="string", length=64)
     */
    protected $password;

    /**
     * @var string
     * @Column(type="string", length=60, unique=true)
     */
    protected $email;
    
    /**
     * @var boolean
     * @Column(name="is_active", type="boolean")
     */
    protected $isActive;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }
    
    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;
    }

    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;
    }

    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;
    }

    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;
    }

    public function setFechaNacimiento(\DateTime $fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    
    public function eraseCredentials()
    {
        
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($email) {
        $this->email = $email;
    }
 
    function setPassword($password) {
        $this->password = $password;
    }



    
}
