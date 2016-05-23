<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Docente;
use AppBundle\Entity\Estudiante;
use AppBundle\Entity\Acudiente;
use AppBundle\Entity\TipoFalta;

class LoadData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 11; $i++) {
            $docente = new Docente();
            $docente->setPrimerNombre('Profe ' .$i);
            $docente->setSegundoNombre('Pepito '.$i);
            $docente->setPrimerApellido('Pérez '.$i);
            $docente->setSegundoApellido('admin '.$i);
            $docente->setFechaNacimiento(new \DateTime('now'));
            $manager->persist($docente);
        }  
        for ($i = 1; $i <= 11; $i++) {
            $estudiante = new Estudiante();
            $estudiante->setPrimerNombre('Juanito ' .$i);
            $estudiante->setSegundoNombre('Alimaña '.$i);
            $estudiante->setPrimerApellido('Suárez '.$i);
            $estudiante->setSegundoApellido('Hernández '.$i);
            $estudiante->setFechaNacimiento(new \DateTime('now'));
            $manager->persist($estudiante);
        }   
        
        for ($i = 1; $i <= 11; $i++) {
            $acudiente = new Acudiente();
            $acudiente->setPrimerNombre('Acudiente ' .$i);
            $acudiente->setSegundoNombre('... '.$i);
            $acudiente->setPrimerApellido('Torres '.$i);
            $acudiente->setSegundoApellido('Hernández '.$i);
            $acudiente->setFechaNacimiento(new \DateTime('now'));
            $manager->persist($acudiente);
        }  
        
        
            $tipoFaltaGrave = new TipoFalta();
            $tipoFaltaGrave->setDescripcion('Grave');
          
            $tipoFaltaMedia = new TipoFalta();
            $tipoFaltaMedia->setDescripcion('Media');
            
            $tipoFaltaLeve = new TipoFalta();
            $tipoFaltaLeve->setDescripcion('Leve');
            
            $manager->persist($tipoFaltaGrave);
            $manager->persist($tipoFaltaMedia);
            $manager->persist($tipoFaltaLeve);
                
              
        $manager->flush();
    }
}