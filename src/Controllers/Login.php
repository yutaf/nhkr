<?php

namespace Src\Controllers;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class Login extends Application
{
    public function login()
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
        $html = $this->renderer->render('Login', $data);
        $this->response->setContent($html);
    }

    public function show()
    {
        $form = $this->getForm();
        $data = [
            'form' => $form->createView(),
        ];
        $html = $this->renderer->render('Login', $data);
        $this->response->setContent($html);
    }

    private function getForm()
    {
        $form = $this->formFactory->get()->createBuilder()
            ->add('email', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ))
            ->add('password', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 6)),
                ),
            ))
            ->add('passwordConfirmation', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 6)),
                ),
            ))
            ->getForm();
        ;

        return $form;
    }
}