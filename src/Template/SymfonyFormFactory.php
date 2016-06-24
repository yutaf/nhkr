<?php

namespace Src\Template;

use Src\Constant\AppConst;
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
            ->setTranslationDomain(AppConst::TRANSLATOR_DOMAIN_VALIDATOR)
            ->getValidator();

        // extensions
        $validatorExtension = new ValidatorExtension($validator);
        $csrfExtension = new CsrfExtension($csrfTokenManager, $translator, AppConst::TRANSLATOR_DOMAIN_VALIDATOR);

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