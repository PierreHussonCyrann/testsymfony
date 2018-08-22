<?php
namespace App\DataFixtures;
use App\Entity\Films;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;

class FilmsFixtures extends Fixture implements  DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $films = array(
            array(
                'id' => '1',
                'titre'=>'mon nom est personne',
                'description'=>'Lorem  sdiugviusdhvisiosvosdijmvbsdmvsodvnsobnsdfbms',
                'photo' => 'http://fr.web.img5.acsta.net/medias/nmedia/18/62/84/46/19254780.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_western)
            ),
            array(
                'id' => '2',
                'titre'=>'The Thing',
                'description'=>'12 hommes ont découvert quelque chose sous la glace...',
                'photo' => 'https://static.films-horreur.com/2015/05/xxHzG08m6bxhQCgKB15lfu0nx70.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_horreur )
            ),
            array(
                'id' => '3',
                'titre'=>'Le labyrinthe de pan',
                'description'=>'Une petite fille s\'évade de l\'Espagne Franquiste...dans ses rêves',
                'photo' => 'http://img.filmsactu.net/datas/films/l/e/le-labyrinthe-de-pan/xl/46f8f815aca12.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_fantastique )
            ),
            array(
                'id' => '4',
                'titre'=>'Stepbrothers',
                'description'=>'dulybsduisdjfosdjvosdnviùosdnvùqzibvoùqsdvùqsd',
                'photo' => 'https://upload.wikimedia.org/wikipedia/en/d/d9/StepbrothersMP08.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_comedie)
            ),
            array(
                'id' => '5',
                'titre'=>'Farewell to Arms',
                'description'=>'Lorem  sdiugviusdhvisiosvosdijmvbsdmvsodvnsobnsdfbms',
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Poster_-_A_Farewell_to_Arms_
                %281932%29_01.jpg/220px-Poster_-_A_Farewell_to_Arms_%281932%29_01.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_drame )
            ),
            array(
                'id' => '6',
                'titre'=>'Le jour et la nuit',
                'description'=>'le seul film de Bernard - Henry Levy, HEUREUSEMENT',
                'photo' => 'http://fr.web.img5.acsta.net/c_215_290/pictures/210/505/21050555_20131017170230699.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_navet )
            ),
            array(
                'id' => '7',
                'titre'=>'DIE HARD',
                'description'=>'Le chef d\'oeuvre des années 1980',
                'photo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/7/7e/Die_hard.jpg/220px-Die_hard.jpg',
                'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_action )
            ),
                array(
                    'id' => '8',
                    'titre'=>'Shaft',
                    'description'=>'Le fondateur du genre, véritable concentré de n\'importe quoi, Shaft est
                    l\'inspecteur Harry mais pour la communauté New Yorkaise !',
                    'photo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/d/d0/Shaftposter.jpg/220px-Shaftposter.jpg',
                    'categorie_id'=>$this->getReference('categorie-'.CategoriesFixtures::Code_blacksploitation)
                ),
        );

        foreach ($films as $row) {
            $exempledefilm= new Films();
            $exempledefilm->setTitre($row["titre"]);
            $exempledefilm->setId($row['id']);
            $exempledefilm->setDescription($row['description']);
            $exempledefilm->setPhoto($row['photo']);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($row['categorie_id']);


            $manager->persist($exempledefilm);
        }
        for ($i=9;$i<=25; $i++){
            $istring = strval($i);
            $exempledefilm= new Films();

            $exempledefilm->setTitre('DummyTitle numéro '.$istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' .$istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_western));
            $manager->persist($exempledefilm);
            }
        for ($i=26;$i<=50; $i++){
            $istring = strval($i);
            $exempledefilm= new Films();

            $exempledefilm->setTitre('DummyTitle numéro '.$istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' .$istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_horreur));
            $manager->persist($exempledefilm);
        }
        for ($i=51;$i<=75; $i++){
            $istring = strval($i);
            $exempledefilm= new Films();

            $exempledefilm->setTitre('DummyTitle numéro '.$istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' .$istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_fantastique));
            $manager->persist($exempledefilm);
        }
        for ($i=76;$i<=90; $i++){
            $istring = strval($i);
            $exempledefilm= new Films();

            $exempledefilm->setTitre('DummyTitle numéro '.$istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' .$istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_drame));
            $manager->persist($exempledefilm);
        }
        for ($i=91;$i<=115; $i++){
            $istring = strval($i);
            $exempledefilm= new Films();

            $exempledefilm->setTitre('DummyTitle numéro '.$istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' .$istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_action));
            $manager->persist($exempledefilm);
        }
        for ($i=116;$i<=150; $i++){
            $istring = strval($i);
            $exempledefilm= new Films();

            $exempledefilm->setTitre('DummyTitle numéro '.$istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' .$istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_navet));
            $manager->persist($exempledefilm);
        }
        for ($i=151;$i<=170; $i++) {
            $istring = strval($i);
            $exempledefilm = new Films();

            $exempledefilm->setTitre('DummyTitle numéro ' . $istring);
            $exempledefilm->setId($istring);
            $exempledefilm->setDescription('DummyDescrition');
            $exempledefilm->setPhoto('Dummy Link ' . $istring);
            $exempledefilm->setDateajout(new \DateTime());
            $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_blacksploitation));
            $manager->persist($exempledefilm);
        }
            for ($i=171;$i<=190; $i++){
                $istring = strval($i);
                $exempledefilm= new Films();

                $exempledefilm->setTitre('DummyTitle numéro '.$istring);
                $exempledefilm->setId($istring);
                $exempledefilm->setDescription('DummyDescrition');
                $exempledefilm->setPhoto('Dummy Link ' .$istring);
                $exempledefilm->setDateajout(new \DateTime());
                $exempledefilm->setCategorie($this->getReference('categorie-'.CategoriesFixtures::Code_comedie));
                $manager->persist($exempledefilm);
        }


        // pour que les id de notre array soient pris en compte lors de l'insertion dans la table !
        $metadata = $manager->getClassMetaData(Films::class);
        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());

        $manager->flush();

    }
    public function getDependencies()
    {
        return array(
            CategoriesFixtures::class
        );
    }
}