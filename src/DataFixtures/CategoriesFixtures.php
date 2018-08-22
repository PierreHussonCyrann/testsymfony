<?php
namespace App\DataFixtures;
use App\Entity\Films;
use App\Entity\Categories;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;

class CategoriesFixtures extends Fixture
{
    const Code_western   = '1';
    const Code_horreur  = '2';
    const Code_fantastique   = '3';
    const Code_comedie   = '4';
    const Code_drame   = '5';
    const Code_navet  = '6';
    const Code_action  = '7';
    const Code_blacksploitation  = '8';

    public function load(ObjectManager $manager)
    {
        $categ = array(
            array(
                'id' => '1',
                'categorie'=>'Western',
            ),
            array(
                'id' => '2',
                'categorie'=>'Horreur',
            ),
            array(
                'id' => '3',
                'categorie'=>'Fantastique',
            ),
            array(
                'id' => '4',
                'categorie'=>'Comedie',
            ),
            array(
                'id' => '5',
                'categorie'=>'Drame',
            ),
            array(
                'id' => '6',
                'categorie'=>'Navet',
            ),
             array(
                 'id' => '7',
                 'categorie'=>'Action',
             ),
            array(
                'id' => '8',
                'categorie'=>'Blaxsploitation',
                  )
        );

        foreach ($categ as $row) {
            $exempledecateg= new Categories();
            $exempledecateg->setCategorie($row['categorie']);
            $exempledecateg->setId($row['id']);

            $this->addReference('categorie-'.$row['id'], $exempledecateg);

            $manager->persist($exempledecateg);
        }


        // pour que les id de notre array soient pris en compte lors de l'insertion dans la table !
        $metadata = $manager->getClassMetaData(Categories::class);
        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());

        $manager->flush();


    }
}