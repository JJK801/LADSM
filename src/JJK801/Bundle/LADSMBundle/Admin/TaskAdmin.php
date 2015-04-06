<?php
namespace JJK801\Bundle\LADSMBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SimpleBlock;
use JJK801\Bundle\LADSMBundle\Document\Task;

use Gedmo\Sluggable\Util\Urlizer;

class TaskAdmin extends PageAdmin
{
    public $supportsPreviewMode  = true;
    protected $doctrine;

    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);

        $listMapper->remove('path');
        $listMapper->remove('label');
        $listMapper->remove('name');

        $listMapper
            ->add('startAt', 'datetime')
            ->add('endAt', 'datetime')
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

        $formMapper
            ->with('form.group_general')
                ->add('startAt', 'datetime')
                ->add('endAt', 'datetime')
            ->end()
        ;
    }

    public function getNewInstance()
    {
        $task = parent::getNewInstance();

        $manager    = $this->doctrine->getManager();
        $repository = $this->doctrine->getRepository('JJK801LADSMBundle:Task');

        $task->setParentDocument($manager->find(null, '/cms/simple/calendar'));
        $task->setName(' ');

        return $task;
    }

    public function prePersist($task)
    {
        $task->setLabel($task->getTitle());
        $task->setName(Urlizer::urlize($task->getTitle()).'-'.$task->getSlugKey());
        $task->setCreatedAt(new \DateTime());

        $manager = $this->doctrine->getManager();
        $nodes = $task->getParentDocument()->getChildren();
        $nodes[$task->getName()] = $task;

        $content = new SimpleBlock();
        $content->setName('editorial');
        $content->setBody("<i>Aucune description pour cette tâche</i>");
        $content->setParentDocument($task);
        $manager->persist($content);

        $this->sortItems($task);
    }

    public function preUpdate($task)
    {
        $task->setLabel($task->getTitle());
        $task->setName(Urlizer::urlize($task->getTitle()).'-'.$task->getSlugKey());
        $task->setCreatedAt(new \DateTime());

        $this->sortItems($task);
    }

    public function sortItems($task)
    {
        $items = $task->getParentDocument()->getChildren();

        $itemsByDate = array();
        $otherItems  = array();
        /** @var $item Page */
        foreach ($items as $item) {
            if (!($item instanceof Task)) {
                $otherItems[$item->getName()] = $item;

                continue;
            }

            $itemsByDate[$item->getStartAt()->format('U')][$item->getPublishStartDate() ? $item->getPublishStartDate()->format('U') : 0][] = $item;
        }

        ksort($itemsByDate);

        $sortedItems = array();

        foreach ($itemsByDate as $itemsForDate) {
            ksort($itemsForDate);
            foreach ($itemsForDate as $itemsForPublishDate) {
                foreach ($itemsForPublishDate as $item) {
                    $sortedItems[$item->getName()] = $item;
                }
            }
        }

        if ($sortedItems !== $items->getKeys()) {
            $sortedItems = array_merge($otherItems, $sortedItems);

            $items->clear();
            foreach ($sortedItems as $key => $item) {
                $items[$key] = $item;
            }
        }
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
                return 'JJK801LADSMBundle:Calendar:task.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
