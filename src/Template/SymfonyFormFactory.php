<?php

namespace Src\Template;

use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validation;

class SymfonyFormFactory
{
    private $formFactory;

    /**
     * @param CsrfTokenManager $csrfTokenManager
     * @param Translator $translator
     */
    public function __construct(CsrfTokenManager $csrfTokenManager, Translator $translator)
    {
        $validator = Validation::createValidatorBuilder()
            ->setTranslator($translator)
            ->setTranslationDomain('validators')
            ->getValidator();

        // extensions
        $validatorExtension = new ValidatorExtension($validator);
        $csrfExtension = new CsrfExtension($csrfTokenManager, $translator, 'validators');

        $this->formFactory = Forms::createFormFactoryBuilder()
            ->addExtensions([$csrfExtension, $validatorExtension])
            ->getFormFactory();
    }

    /**
     * @return \Symfony\Component\Form\FormFactoryInterface
     */
    public function get()
    {
        return $this->formFactory;
    }
}