<?php

namespace Src\Controllers;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class Welcome extends Application
{
    public function signup()
    {
        $form = $this->getForm();
        if(isset($form, $_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);

            if ($form->isValid()) {
                var_dump('VALID', $form->getData());
                die;
            }
        }
        $data = [
            'form' => $form->createView(),
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }

    public function show()
    {
        $form = $this->getForm();
        $data = [
            'form' => $form->createView(),
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }

    private function getForm()
    {
        $areas = include(__DIR__.'/../../config/areas.php');
        $form = $this->formFactory->get()->createBuilder()
            ->add('email', EmailType::class, array(
                'label' => 'label.email',
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                    new Email(),
                ),
            ))
            ->add('area', ChoiceType::class, array(
                'label' => 'label.area',
                'choices'  => $areas,
                'required' => true,
                'constraints' => [
                    new Choice(['choices' => $areas]),
                ]
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 6)),
                ),
                'first_options'  => array('label' => 'label.password'),
                'second_options' => array('label' => 'label.passwordConfirmation'),
            ))
            ->getForm()
        ;

        return $form;
    }
}