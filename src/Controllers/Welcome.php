<?php

namespace Src\Controllers;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class Welcome extends Application
{
    public function show()
    {
        $form = $this->formFactory->get()->createBuilder()
            ->add('email', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ))
            ->add('password', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ))
            ->getForm();
        $data = [
            'form' => $form->createView(),
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }
}