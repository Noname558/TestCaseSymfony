<?php
 namespace App\Controller;

 use App\Entity\Arend;
 use App\Entity\Message;
 use App\Entity\PeopleRent;
 use App\Form\Type\ArendaSubmitType;
 use App\Form\Type\RentType;
 use App\Form\Type\ArendaType;
 use DateTime;
 use Doctrine\ORM\QueryBuilder;
 use Doctrine\Persistence\ManagerRegistry;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;

 class ArendaController extends AbstractController
 {
     #[Route('/flats')]
     public function showFlat(ManagerRegistry $doctrine): Response
     {
         $ALL = $doctrine->getRepository(Message::class)->findAll();

         return $this->render('flats.html.twig',[
             'product'=> $ALL
         ]);
     }

     #[Route('/flat/{id}')]
     public function editFlat(Request $request,ManagerRegistry $doctrine, int $id): Response
     {
         $message = $doctrine->getRepository(Message::class)->find($id);

         $em = $this->getDoctrine()->getManager();
         $form1 = $this->createForm(RentType::class,$message);
         $form1->handleRequest($request);
         if($form1->isSubmitted() && $form1->isValid()){
             $em->flush();
         }
         return $this->render('edit-flat.html.twig',[
             'people'=>$message,
             'form1' => $form1->createView(),
         ]);
     }

     #[Route('/sold/')]
     public function sold(Request $request,ManagerRegistry $doctrine): Response
     {
         $soldFlats = $doctrine->getRepository(Arend::class)->findAll();

         return $this->render('sold.html.twig', [
             'sold_flats' => $soldFlats
         ]);
     }

     #[Route('/arenda/')]
     public function arenda(Request $request,ManagerRegistry $doctrine): Response
     {
         //$message = $doctrine->getRepository(Message::class)->findAll();

         $availableFlats = [];
         $submit_data = [
             'start' => null,
             'finish' => null,
             'people_id' => null,
         ];

         $em = $this->getDoctrine()->getManager();
         $form = $this->createForm(ArendaType::class);
         $formArendaSubmit = $this->createForm(ArendaSubmitType::class);

         $form->handleRequest($request);
         $formArendaSubmit->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()) {
             $data = $form->getData();

             $submit_data['start'] = $data['start']->format('Y-m-d H:i:s');
             $submit_data['finish'] = $data['finish']->format('Y-m-d H:i:s');
             $submit_data['people_id'] = $data['people']->getId();

             $em = $this->getDoctrine()->getManager();
             $qb = $em->createQueryBuilder();

             /** @var QueryBuilder $qb */
             $qb->select(['m', 'a'])
                 ->from(Message::class, 'm')
                 ->leftJoin('m.arenda', 'a')
                 ->where('a.id IS NULL')
                 ->orWhere('a.start < :start AND a.finish < :finish OR a.start > :start AND a.start > :finish')
                 ->setParameter('start', $data['start'])
                 ->setParameter('finish', $data['finish']);

             $availableFlats = $qb->getQuery()->getResult();
         }

         return $this->render('arend.html.twig',[
             'form_search_flat' => $form->createView(),
             'form_summit_arenda' => $formArendaSubmit->createView(),
             'available_flats' => $availableFlats,
             'submit_data' => $submit_data
         ]);
     }

     #[Route('/create-arenda/')]
     public function createArenda(Request $request,ManagerRegistry $doctrine): Response
     {
         $start = new DateTime($request->get('start'));
         $finish = new DateTime($request->get('finish'));

         $startm = $doctrine->getRepository(Message::class)->find($request->get('flat_id'));
         $finishm = $doctrine->getRepository(PeopleRent::class)->find($request->get('people_id'));
         $em = $this->getDoctrine()->getManager();
         $arend = new Arend();
         $arend->setStart($start);
         $arend->setFinish($finish);
         $arend->setMessage($startm);
         $arend->setPeople($finishm);
         $em->persist($arend);
         $em->flush();

         /*dump($request->get('flat_id'));
         dump($request->get('people_id'));
         dump($startm);
         dd($finishm);*/

         return $this->render('finish.html.twig');
     }


 }
