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
            ->add('firstName', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ))
            ->add('lastName', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 4)),
                ),
            ))
            ->add('gender', ChoiceType::class, array(
                'choices' => array('m' => 'Male', 'f' => 'Female'),
            ))
            ->add('newsletter', CheckboxType::class, array(
                'required' => false,
            ))
            ->getForm();
        $data = [
            'form' => $form->createView(),
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }
}