<?php
namespace JJK801\Bundle\LADSMBundle\Document;

class News extends AbstractPage
{
    /**
     * @var string
     */
    protected $slugKey;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->setDefault('_template', 'JJK801LADSMBundle:News:news.html.twig');

        $this->slugKey = md5(time().rand(0, 10000));
    }

    public function getSlugKey()
    {
        return $this->slugKey;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
