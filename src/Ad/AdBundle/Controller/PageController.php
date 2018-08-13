<?php
namespace Ad\AdBundle\Controller;

use Ad\AdBundle\Entity\Ad;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Ad\AdBundle\Entity\User;
use Ad\AdBundle\Form\EnquiryType;
use Symfony\Component\Validator\Constraints\DateTime;


class PageController extends Controller
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
        ));
    }
    public function indexAction(Request $request)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username',TextType::class)
            ->add('password',PasswordType::class)
            ->add('save',SubmitType::class,array('label'=>'LogIn'))
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData() ;
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('ad_create');
        }

        return $this->render('AdAdBundle:Page:index.html.twig',array(
            'form' => $form->createView(),
            ));
    }
    public function createAction(Request $request)
    {
        $ad = new Ad();

        $formAd = $this->createFormBuilder($ad)
            ->add('title',TextType::class)
            ->add('description',TextareaType::class)
            ->add('authorName', TextType::class)
            ->add('save',SubmitType::class,array('label'=>'Create Ad'))
            ->getForm();

        $ad->setUser($this->getUser());

        $formAd->handleRequest($request);

        if ($formAd->isSubmitted() && $formAd->isValid()) {
            $formAd->getData() ;
            $ad = $formAd->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($ad);
            $em->flush();

            return $this->redirectToRoute('ad_create');
        }
        return$this->render('AdAdBundle:Page:create.html.twig', array(
            'formAd' => $formAd->createView(),
        ));
    }
}
