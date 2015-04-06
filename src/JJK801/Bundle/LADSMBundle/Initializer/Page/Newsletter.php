<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class Newsletter extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $this->setPage(array(
            "basePath" => "/cms/simple/about",
            "nodeName" => "newsletter",
            "title"    => "Recevoir nos actualités",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:News:subscribe.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Recevoir nos actualités",
            ),
            "home" => array(
                "basePath"   => '/cms/menu/home',
                "name"       => "newsletter",
                "label"      => "Recevoir nos actualités",
                "attributes" => array(
                    "class" => "newsletter",
                ),
            ),
            "about" => array(
                "basePath"   => '/cms/menu/about',
                "name"       => "newsletter",
                "label"      => "Comment suivre notre actualité?"
            )
        ));
        
        parent::init($registry);
    }
}