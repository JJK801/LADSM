<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Doctrine\ODM\PHPCR\DocumentManager;
use JJK801\Bundle\LADSMBundle\Document\Page;

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\StringBlock;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SimpleBlock;

class About extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $manager = $registry->getManagerForClass('JJK801\Bundle\LADSMBundle\Document\Page');

        $this->setPage(array(
            "nodeName" => "about",
            "title"    => "Qui sommes nous?",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:About:index.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Qui sommes nous?",
            )
        ));
        
        $page = parent::init($registry);

        $this->loadContent($manager, $page);

        $manager->flush();
    }

    protected function loadContent(DocumentManager $manager, Page $page)
    {
        $title = new SimpleBlock();
        $title->setId('/cms/content/about');
        $title->setTitle("Qui sommes nous ?");
        $title->setBody("Short description");
        $title->setParentDocument($page);
        $manager->persist($title);
    }
}