<?php
namespace JJK801\Bundle\LADSMBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SimpleBlock;
use JJK801\Bundle\LADSMBundle\Document\News;

use Gedmo\Sluggable\Util\Urlizer;

class NewsAdmin extends PageAdmin
{
    public $supportsPreviewMode  = true;
    protected $doctrine;

    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);

        $listMapper->remove('path');
        $listMapper->remove('label');
        $listMapper->remove('name');
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper->remove('parent');
        $formMapper->remove('name');
        $formMapper->remove('variablePattern');
        $formMapper->remove('defaults');
        //$formMapper->remove('routeOptions');
        $formMapper->remove('label');
        $formMapper->remove('body');

        if (!$this->id($this->getSubject())) {
            $this->supportsPreviewMode = false;
        } else {
            $this->supportsPreviewMode = true;
        }
    }

    public function getNewInstance()
    {
        $news = parent::getNewInstance();

        $manager    = $this->doctrine->getManager();
        $repository = $this->doctrine->getRepository('JJK801LADSMBundle:News');

        $news->setParentDocument($manager->find(null, '/cms/simple/news'));
        $news->setName(' ');

        return $news;
    }

    public function prePersist($news)
    {
        $news->setLabel($news->getTitle());
        $news->setName(Urlizer::urlize($news->getTitle()).'-'.$news->getSlugKey());
        $news->setCreatedAt(new \DateTime());

        $manager = $this->doctrine->getManager();
        $nodes = $news->getParentDocument()->getChildren();
        $nodes[$news->getName()] = $news;

        $content = new SimpleBlock();
        $content->setName('editorial');
        $content->setBody("<i>Aucune description pour cette tâche</i>");
        $content->setParentDocument($news);
        $manager->persist($content);
    }

    public function preUpdate($news)
    {
        $news->setLabel($news->getTitle());
        $news->setName(Urlizer::urlize($news->getTitle()).'-'.$news->getSlugKey());
        $news->setUpdatedAt(new \DateTime());
    }

    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;

        return $this;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'preview':
                return 'JJK801LADSMBundle:News:news.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
