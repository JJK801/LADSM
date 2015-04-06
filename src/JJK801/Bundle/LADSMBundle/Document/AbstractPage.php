<?php
namespace JJK801\Bundle\LADSMBundle\Document;

use Symfony\Cmf\Bundle\SimpleCmsBundle\Doctrine\Phpcr\Page as BasePage;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface;

class AbstractPage extends BasePage implements SeoAwareInterface
{
    protected $seoMetadata;

    public function getSeoMetadata()
    {
        return $this->seoMetadata;
    }

    public function setSeoMetadata($metadata)
    {
        $this->seoMetadata = $metadata;
    }
}