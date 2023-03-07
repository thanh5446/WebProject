<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_list")
     */
    public function listAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(user::class)
            ->findAll();
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }
    /**
     * @Route("/user/view/{id}", name="user_view")
     */
    public function detailsAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(user::class)
            ->find($id);

        return $this->render('user/view.html.twig', [
            'user' => $user
        ]);
    }
    /**
     * @Route("/user/delete/{id}", name="user_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(user::class)->find($id);
        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'error',
            'User delete success'
        );

        return $this->redirectToRoute('user_list');
    }
    /**
     * @Route("/user/create", name="user_create", methods={"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $user = new user();
        $form = $this->createForm(UserCreateType::class, $user);

        if ($this->saveChanges($form, $request, $user)) {
            $this->addFlash(
                'notice',
                'User Add success'
            );

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $user)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return true;
        }
        return false;
    }
    /**
     * @Route("/user/update/{id}", name="user_update")
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(user::class)->find($id);

        $form = $this->createForm(UserCreateType::class, $user);

        if ($this->saveChanges($form, $request, $user)) {
            $this->addFlash(
                'notice',
                'User update success'
            );
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
