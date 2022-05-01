<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $student = new Student();
            $student->setName("Student $i");
            $student->setGender("Male");
            $student->setAge(rand(18, 25));
            $student->setPhone("0988888888");
            $student->setGrade(rand(1, 10));
            $student->setImage("https://vcdn-vnexpress.vnecdn.net/2021/10/20/quynh-anh-4819-1634706207.jpg");
            $manager->persist($student);
        }

        $manager->flush();
    }
}
