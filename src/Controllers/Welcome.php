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
    public function login()
    {
        $forms = $this->getForms();
        $form = $forms['login'];
        if(isset($form, $_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);

            if ($form->isValid()) {
                var_dump('VALID', $form->getData());
                die;
            }
        }
        $data = [
            'form_login' => $forms['login']->createView(),
            'form_signup' => $forms['signup']->createView(),
            'switch_content_selected_signup' => '',
            'switch_content_selected_login' => 'switch_content_selected',
            'class_hide_signup' => 'hide',
            'class_hide_login' => '',
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }

    public function show()
    {
        $forms = $this->getForms();
        $data = [
            'form_login' => $forms['login']->createView(),
            'form_signup' => $forms['signup']->createView(),
            'switch_content_selected_signup' => 'switch_content_selected',
            'switch_content_selected_login' => '',
            'class_hide_signup' => '',
            'class_hide_login' => 'hide',
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }

    private function getForms()
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
                    new Length(array('min' => 6)),
                ),
            ));
        $form_login = $formBuilderLogin->getForm();

        $formBuilderSignup = $formBuilderLogin
            ->add('passwordConfirmation', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 6)),
                ),
            ));
        $form_signup = $formBuilderSignup->getForm();

        return [
            'login' => $form_login,
            'signup' => $form_signup,
        ];
    }
}