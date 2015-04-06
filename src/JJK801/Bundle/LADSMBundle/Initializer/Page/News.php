<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class News extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $this->setPage(array(
            "nodeName" => "news",
            "title"    => "Actualités",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:News:index.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Actualités",
            ),
            "main" => array(
                "basePath"   => '/cms/menu/main',
                "name"       => "news",
                "label"      => "Actualités",
                "attributes" => array(
                    "class" => "news",
                ),
            ),
        ));
        
        parent::init($registry);
    }
}