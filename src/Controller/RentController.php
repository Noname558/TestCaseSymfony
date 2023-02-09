<?php

namespace App\Controller;
use App\Repository\MessageRepository;
use App\Entity\Message;
use App\Entity\PeopleRent;
use App\Form\Type\RentType;
use App\Form\Type\TenantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    #[Route('/')]
    public function index(Request $request, MessageRepository $messageRepository): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/create-flat')]
    public function createFlat(Request $request, MessageRepository $messageRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $form1 = $this->createForm(RentType::class);
        $form1->handleRequest($request);
        if($form1->isSubmitted() && $form1->isValid()){
            $data = $form1->getData();
            $rent = new Message();
            $rent->setPeople($data['people']);
            $rent->setAddress($data['address']);
            $rent->setFloor($data['floor']);
            $rent->setPrice($data['price']);
            $rent->setNumber($data['number']);
            $rent->setSquare($data['square']);
            $em->persist($rent);
            $em->flush();
        }

        return $this->render('create-flat.html.twig',[
            'form1' => $form1->createView(),
        ]);
    }

    #[Route('/create-people')]
    public function createPeople(Request $request, MessageRepository $messageRepository): Response
    {
        $em = $this->getDoctrine()->getManager();

        $form2 = $this->createForm(TenantType::class);
        $form2->handleRequest($request);
        if($form2->isSubmitted() && $form2->isValid()){
            $data1 = $form2->getData();
            $people = new PeopleRent();
            $people->setUsername($data1['username']);
            $people->setSurname($data1['surname']);
            $people->setIdarenda($data1['idarenda']);

            $em->persist($people);
            $em->flush();
        }

        return $this->render('create-people.html.twig',[
            'form2' => $form2->createView(),
        ]);
    }
}
