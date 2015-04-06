<?php
namespace JJK801\Bundle\LADSMBundle\Initializer;

use Doctrine\ODM\PHPCR\DocumentManager;
use Doctrine\Bundle\PHPCRBundle\Initializer\InitializerInterface;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

use Symfony\Cmf\Bundle\SeoBundle\Doctrine\Phpcr\SeoMetadata;
use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\Menu;
use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\MenuNode;

use JJK801\Bundle\LADSMBundle\Document\Page;

abstract class AbstractPageInitializer implements InitializerInterface
{
    private $page = array(
        "basePath" => '/cms/simple',
        "nodeName" => null,
        "title"    => null,
        "defaults" => array()
    );

    private $menu = array(
        "simple" => array(
            "attributes" => array(),
            "label"      => null,
        ),
    );

    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        /** @var $dm DocumentManager */
        $manager = $registry->getManagerForClass('JJK801\Bundle\LADSMBundle\Document\Page');

        $root = $manager->find(null, $this->page['basePath']);

        if ($this->page["nodeName"]) {
            $page = new Page();
            $page->setPosition($root, $this->page['nodeName']);
        } else {
            $page = $root;
        }

        $page->setTitle($this->page['title']);

        foreach ($this->page['defaults'] as $defName => $defValue) {
            $page->setDefault($defName, $defValue);
        }

        $manager->persist($page);

        $this->loadMenuNodes($manager, $page);
        $this->loadMetadata($manager, $page);

        // save the changes
        $manager->flush();

        return $page;
    }

    protected function loadMenuNodes(DocumentManager $manager, Page $page)
    {
        foreach($this->menu as $menuName => $menuInfos) {
            if ($menuName !== "simple") {
                $menu = $manager->find(null, $menuInfos['basePath']);
                $node = new MenuNode();
                $node->setName($menuInfos['name']);
                $node->setContent($page);
                $node->setParentDocument($menu);
            } else {
                $node = $page;
            }

            $node->setLabel($menuInfos['label']);

            if (isset($menuInfos['attributes'])) {
                foreach ($menuInfos['attributes'] as $attrName => $attrValue) {
                    $node->setAttribute($attrName, $attrValue);
                }
            }
    
            $manager->persist($node);
        }
    }

    protected function loadMetadata(DocumentManager $manager, Page $page)
    {
        $seo = new SeoMetadata();
        $seo->setTitle($this->page['title']);

        $page->setSeoMetadata($seo);

        $manager->persist($page);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        $classname = $path = explode('\\', get_class($this));

        return 'JJK801LADSMBundle Page > ' . array_pop($path);
    }

    public function setPage(array $infos)
    {
        $this->page = array_merge($this->page, $infos);

        return $this;
    }

    public function setMenu(array $infos)
    {
        foreach ($infos as $name => $infos) {
            $this->menu[$name] = ( isset($this->menu[$name]) ? array_merge($this->menu[$name], $infos) : $infos);
        }

        return $this;
    }
}
