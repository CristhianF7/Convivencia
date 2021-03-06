<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Docente;
use AppBundle\Entity\Estudiante;
use AppBundle\Entity\Acudiente;
use AppBundle\Entity\TipoFalta;
use AppBundle\Entity\Administrador;
use AppBundle\Entity\AcudienteEstudiante;
use AppBundle\Entity\EstadosFaltas;

class LoadData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $docente = new Docente();
            $docente->setPrimerNombre('Profe ' .$i);
            $docente->setSegundoNombre('Pepito '.$i);
            $docente->setPrimerApellido('Pérez '.$i);
            $docente->setSegundoApellido('admin '.$i);
            $docente->setFechaNacimiento(new \DateTime('now'));
            $docente->setUsername("profe_".$i);
            $docente->setEmail("profe_".$i);
            
            $plainPassword = '123456';
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($docente, $plainPassword);
            $docente->setPassword($encoded);
        
            $manager->persist($docente);
        }  
        for ($i = 1; $i <= 11; $i++) {
            $estudiante = new Estudiante();
            $estudiante->setPrimerNombre('Juanito ' .$i);
            $estudiante->setSegundoNombre('Alimaña '.$i);
            $estudiante->setPrimerApellido('Suárez '.$i);
            $estudiante->setSegundoApellido('Hernández '.$i);
            $estudiante->setFechaNacimiento(new \DateTime('now'));
            $estudiante->setUsername("estudiante_".$i);
            $estudiante->setEmail("estudiante_".$i);
            
            $plainPassword = '123456';
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($estudiante, $plainPassword);
            $estudiante->setPassword($encoded);
            
            $manager->persist($estudiante);
        }   
        
        for ($i = 1; $i <= 11; $i++) {
            $acudiente = new Acudiente();
            $acudiente->setPrimerNombre('Acudiente ' .$i);
            $acudiente->setSegundoNombre('... '.$i);
            $acudiente->setPrimerApellido('Torres '.$i);
            $acudiente->setSegundoApellido('Hernández '.$i);
            $acudiente->setFechaNacimiento(new \DateTime('now'));
            $acudiente->setUsername("acudiente_".$i);
            $acudiente->setEmail("acudiente_".$i);
            
            $plainPassword = '123456';
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($acudiente, $plainPassword);
            $acudiente->setPassword($encoded);
            
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
                
            $admin = new Administrador();
            $admin->setPrimerNombre("Admin");
            $admin->setSegundoNombre("...");
            $admin->setPrimerApellido("Admin");
            $admin->setSegundoApellido("...");
            $admin->setFechaNacimiento(new \DateTime());
            $admin->setEmail("admin");
            $admin->setUsername("admin");
            
            $plainPassword = '123456';
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($admin, $plainPassword);
            $admin->setPassword($encoded);

            $manager->persist($admin);   
        $manager->flush();



        for ($i = 1; $i <= 11; $i++) {
            $asociacion = new AcudienteEstudiante();
            $acudiente = $manager->getRepository('AppBundle:Acudiente')->findOneByUsername("acudiente_".$i);
            $estudiante = $manager->getRepository('AppBundle:Estudiante')->findOneByUsername("estudiante_".$i);
            $asociacion->setAcudiente($acudiente);
            $asociacion->setEstudiante($estudiante);
            $asociacion->setParentesco("PADRE-FAMILIA");
            $asociacion->setObservacion("...");
            $manager->persist($asociacion);

        }

        $estadosFaltas = new EstadosFaltas();
        $estadosFaltas->setDescripcion('Iniciado');
        $estadosFaltas->setEstado(true);
        $manager->persist($estadosFaltas);

        $estadosFaltas2 = new EstadosFaltas();
        $estadosFaltas2->setDescripcion('Por revisar');
        $estadosFaltas2->setEstado(true);
        $manager->persist($estadosFaltas2);

        $estadosFaltas3 = new EstadosFaltas();
        $estadosFaltas3->setDescripcion('Terminado');
        $estadosFaltas3->setEstado(true);
        $manager->persist($estadosFaltas3);

        $manager->flush();
    }
}