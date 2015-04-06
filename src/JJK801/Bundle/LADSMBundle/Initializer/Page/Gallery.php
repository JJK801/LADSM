<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class Gallery extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $this->setPage(array(
            "nodeName" => "gallery",
            "title"    => "Galerie",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:Gallery:index.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Galerie",
            ),
            "main" => array(
                "basePath"   => '/cms/menu/main',
                "name"       => "gallery",
                "label"      => "Galerie",
                "attributes" => array(
                    "class" => "gallery",
                ),
            ),
        ));
        
        parent::init($registry);
    }
}