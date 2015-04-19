<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class Projects extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        /*
        $this->setPage(array(
            "nodeName" => "projects",
            "title"    => "Projets",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:Projects:index.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Projets",
            ),
            "main" => array(
                "basePath"   => '/cms/menu/main',
                "name"       => "projects",
                "label"      => "Projets",
                "attributes" => array(
                    "class" => "projects",
                ),
            ),
        ));

        parent::init($registry);
        */
    }
}