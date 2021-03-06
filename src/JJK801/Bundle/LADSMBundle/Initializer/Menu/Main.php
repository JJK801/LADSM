<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Menu;

use PHPCR\Util\NodeHelper;
use PHPCR\Util\PathHelper;

use Doctrine\Bundle\PHPCRBundle\Initializer\InitializerInterface;
use Doctrine\ODM\PHPCR\DocumentManager;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\Menu;

class Main implements InitializerInterface
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        /** @var $dm DocumentManager */
        $manager = $registry->getManagerForClass('JJK801\Bundle\LADSMBundle\Document\Page');

        $menuParent = $manager->find(null, '/cms/menu');

        $menu = new Menu();
        $menu->setName('main');
        $menu->setLabel('Main Menu');
        $menu->setParentDocument($menuParent);

        $manager->persist($menu);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'JJK801LADSMBundle Menu > Main';
    }
}