<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class Calendar extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $this->setPage(array(
            "nodeName" => "calendar",
            "title"    => "Agenda",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:Calendar:index.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Agenda",
            ),
            "main" => array(
                "basePath"   => '/cms/menu/main',
                "name"       => "calendar",
                "label"      => "Agenda",
                "attributes" => array(
                    "class" => "calendar",
                ),
            ),
        ));
        
        parent::init($registry);
    }
}