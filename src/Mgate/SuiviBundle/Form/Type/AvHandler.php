<?php

/*
 * This file is part of the Incipio package.
 *
 * (c) Florian Lefevre
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// src/Sdz/BlogBundle/Form/ArticleHandler.php

namespace Mgate\SuiviBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Mgate\SuiviBundle\Entity\Av;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class AvHandler
{
    protected $form;

    protected $request;

    protected $em;

    public function __construct(Form $form, Request $request, EntityManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    public function process()
    {
        if ('POST' == $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(Av $av)
    {
        $this->em->persist($av);

        $this->em->flush();
    }
}
