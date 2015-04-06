<?php
namespace JJK801\Bundle\LADSMBundle\Repository;

use JJK801\Bundle\LADSMBundle\Document;
use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository;

class Task extends DocumentRepository
{
    public function getSlug(Document\Task $task)
    {
        return $task->getTitle().'-'.$task->getSlugKey();
    }
}