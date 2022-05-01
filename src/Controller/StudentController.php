<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/', name: 'student_index')]
    public function studentIndex(ManagerRegistry $registry)
    {
        $students = $registry->getRepository(Student::class)->findAll();
        return $this->render(
            "student/index.html.twig",
            [
                'students' => $students
            ]
        );
    }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function studentDetail(ManagerRegistry $registry, $id)
    {
        $student = $registry->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error", "student not found !");
            return $this->redirectToRoute("student_index");
        }
        return $this->render(
            "student/detail.html.twig",
            [
                'student' => $student
            ]
        );
    }

    #[Route('/delete/{id}', name: 'student_delete')]
    public function studentDelete(ManagerRegistry $registry, $id)
    {
        $student = $registry->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error", "student not found !");
        } else {
            $manager = $registry->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash("Success", "student delete succeed !");
        }
        return $this->redirectToRoute(
            "student_index",
            [
                'students' => $student
            ]
        );
    }
    #[Route('/add', name: 'student_add')]
    public function studentAdd(Request $request, ManagerRegistry $registry)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $registry->getManager();
            $manager->persist($student);
            $manager->flush();
            $this->addFlash("Success", "Add student succeed !");
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm(
            'student/add.html.twig',
            [
                'studentForm' => $form,
            ]
        );
    }
    #[Route('/edit/{id}', name: 'student_edit')]
    public function bookAdd(Request $request, ManagerRegistry $registry, $id)
    {
        $student = $registry->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $registry->getManager();
            $manager->persist($student);
            $manager->flush();
            $this->addFlash("Success", "Edit student succeed !");
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm(
            'student/edit.html.twig',
            [
                'studentForm' => $form
            ]
        );
    }
    // #[Route('/asc', name: 'student_asc')]
    // public function sortAsc(StudentRepository $studentRepository, ManagerRegistry $registry)
    // {
    //     $course = $registry->getRepository(Course::class)->findAll();
    //     $students = $studentRepository->sortStudentAsc();
    //     return $this->render(
    //         "student/index.html.twig",
    //         [
    //             'students' => $students,
    //             'course' => $course
    //         ]
    //     );
    // }
    // #[Route('/desc', name: 'student_desc')]
    // public function sortDesc(StudentRepository $studentRepository, ManagerRegistry $registry)
    // {
    //     $course = $registry->getRepository(Course::class)->findAll();
    //     $students = $studentRepository->sortStudentDESC();
    //     return $this->render(
    //         "student/index.html.twig",
    //         [
    //             'students' => $students,
    //             'course' => $course
    //         ]
    //     );
    // }

    //AGE
    #[Route('/descAge', name: 'age_desc')]
    public function sortAgeD(StudentRepository $studentRepository, ManagerRegistry $registry)
    {
        $course = $registry->getRepository(Course::class)->findAll();
        $students = $studentRepository->sortAgeDesc();
        return $this->render(
            "student/index.html.twig",
            [
                'students' => $students,
                'course' => $course
            ]
        );
    }

    #[Route('/ascAge', name: 'age_asc')]
    public function sortAgeA(StudentRepository $studentRepository, ManagerRegistry $registry)
    {
        $course = $registry->getRepository(Course::class)->findAll();
        $students = $studentRepository->sortAgeAsc();
        return $this->render(
            "student/index.html.twig",
            [
                'students' => $students,
                'course' => $course
            ]
        );
    }

    // function sum grade
    #[Route('/sumGrade', name: 'sum_grade')]
    public function sumGrade(StudentRepository $studentRepository, ManagerRegistry $registry)
    {
        $course = $registry->getRepository(Course::class)->findAll();
        $students = $studentRepository->sumGrade();
        return $this->render(
            "student/index.html.twig",
            [
                'students' => $students,
                'course' => $course
            ]
        );
    }
}
