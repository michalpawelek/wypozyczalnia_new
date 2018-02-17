<?php
/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 2017-12-04
 * Time: 17:07
 */


namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Boiska;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__.'/fixtures.yml',
            $manager,
            [
                'providers'=>[$this]
            ]
        );
        //$boisko = New Boiska();
        //$boisko->setTyp('footbal');
        //$boisko->setCenaGodzina(10);
        //$boisko->setMiejscowosc('Sando');
        //$boisko->setUlica('Raci');
        //$boisko->setNumer(1);
        //$boisko->setImg('zdjci.img');

        //$manager->persist($boisko);
        //$manager->flush();
    }
    public function boisko(){
        $genera=[
           'piłka nożna',
           'tenis',
            'siatkówka',
            'koszykówka',
            'piłka ręczna',
            'krykiet',
            'golf'
        ];
        $key = array_rand($genera);
        return $genera[$key];
    }

}