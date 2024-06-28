<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $technos = [
            ['PHP', 'devicon:php'],
            ['TypeScript', 'devicon:typescript'],
            ['React', 'devicon:react'],
            ['Next', 'devicon:nextjs'],
            ['Symfony', 'devicon:symfony'],
            ['MySQL', 'devicon:mysql-wordmark'],
            ['Doctrine', 'devicon:doctrine'],
            ['Prisma', 'devicon:prisma'],
            ['PostgreSQL', 'devicon:postgresql'],
            ['TailwindCSS', 'devicon:tailwindcss'],
            ['SASS', 'devicon:sass'],
            ['Bootstrap', 'devicon:bootstrap'],
            ['HTML', 'devicon:html5'],
            ['CSS', 'devicon:css3'],
            ['NodeJs', 'devicon:nodejs'],
            ['Express', 'devicon:express'],
            ['ViteJs', 'devicon:vitejs'],
        ];

        foreach ($technos as list($name, $icon)) {
            $techno = new Technology();
            $techno->setName($name)
                ->setSymfonyUxIconName($icon);
            $manager->persist($techno);
        }

        $manager->flush();
    }
}
