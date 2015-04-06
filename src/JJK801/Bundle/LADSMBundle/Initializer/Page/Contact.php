<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class Contact extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $this->setPage(array(
            "basePath" => "/cms/simple/about",
            "nodeName" => "contact",
            "title"    => "Nous contacter",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:About:contact.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Nous contacter",
            ),
            "home" => array(
                "basePath"   => '/cms/menu/home',
                "name"       => "contact",
                "label"      => "Nous contacter",
                "attributes" => array(
                    "class" => "contact",
                ),
            ),
            "about" => array(
                "basePath"   => '/cms/menu/about',
                "name"       => "contact",
                "label"      => "Comment nous contacter?"
            )
        ));
        
        parent::init($registry);
    }
}