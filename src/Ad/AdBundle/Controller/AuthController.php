<?php

namespace Ad\AdBundle;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function authAction(Request $request)
    {
    $username = $request->get('username');
    $password = $request->get('password');

    $em = $this->getDoctrine()->getEntityManager();
    $repository = $em->getRepository('AdAdBundle:User');
    $user = $repository->findOneBy(array('username'=>$username, 'password'=>$password));

    if($user)
    {
        return $this->render('::base.html.twig', array('username' => $username));
    }

    else{

    return $this->render('');

    }

    return $this->render('@AdAd/Page/create.html.twig');
    }
}