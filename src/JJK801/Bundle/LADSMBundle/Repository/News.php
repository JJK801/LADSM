<?php
namespace JJK801\Bundle\LADSMBundle\Repository;

use JJK801\Bundle\LADSMBundle\Document;
use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository;

class News extends DocumentRepository
{
    public function getSlug(Document\News $news)
    {
        return $news->getTitle().'-'.$news->getSlugKey();
    }
}