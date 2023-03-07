<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\OrdersCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/orders", name="orders_list")
     */
    public function listAction()
    {
        $orders = $this->getDoctrine()
            ->getRepository(orders::class)
            ->findAll();
        return $this->render('orders/index.html.twig', [
            'orders' => $orders
        ]);
    }
    /**
     * @Route("/orders/view/{id}", name="orders_view")
     */
    public
    function viewAction($id)
    {
        $orders = $this->getDoctrine()
            ->getRepository(orders::class)
            ->find($id);

        return $this->render('orders/view.html.twig', [
            'orders' => $orders
        ]);
    }/**
 * @Route("/orders/delete/{id}", name="orders_delete")
 */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository(orders::class)->find($id);
        $em->remove($orders);
        $em->flush();

        $this->addFlash(
            'error',
            'Orders delete success'
        );

        return $this->redirectToRoute("orders_list");
    }
    /**
     * @Route("/orders/create", name="orders_create", methods={"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $orders = new orders();
        $form = $this->createForm(OrdersCreateType::class, $orders);

        if ($this->saveChanges($form, $request, $orders)) {
            $this->addFlash(
                'notice',
                'orders add success'
            );

            return $this->redirectToRoute("orders_list");
        }

        return $this->render('orders/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $orders )
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($orders);
            $em->flush();

            return true;
        }
        return false;
    }
/**
 * @Route("/orders/update/{id}", name="orders_update")
*/
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository(orders::class)->find($id);

        $form = $this->createForm(ordersCreateType::class, $orders);

        if ($this->saveChanges($form, $request, $orders)) {
            $this->addFlash(
                'notice',
                'Orders update success'
            );
            return $this->redirectToRoute('orders_list');
        }

        return $this->render('orders/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
