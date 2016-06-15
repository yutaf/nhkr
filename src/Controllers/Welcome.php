<?php

namespace Src\Controllers;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class Welcome extends Application
{
    public function show()
    {
        $formBuilderLogin = $this->formFactory->get()->createBuilder()
            ->add('email', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ))
            ->add('password', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ));
        $form_login = $formBuilderLogin->getForm()->createView();

        $formBuilderSignup = $formBuilderLogin
            ->add('passwordConfirmation', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ));
        $form_signup = $formBuilderSignup->getForm()->createView();

        $data = [
            'form_login' => $form_login,
            'form_signup' => $form_signup,
            'switch_content_selected_signup' => 'switch_content_selected',
            'switch_content_selected_login' => '',
            'class_hide_signup' => '',
            'class_hide_login' => 'hide',
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }
}