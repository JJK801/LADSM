<?php
namespace JJK801\Bundle\LADSMBundle\Document;

class Task extends AbstractPage
{
    /**
     * @var string
     */
    protected $slugKey;

    /**
     * @var \DateTime
     */
    protected $startAt;

    /**
     * @var \DateTime
     */
    protected $endAt;

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
        $this->startAt = new \DateTime();
        $this->startAt->setTime(0,0);

        $this->endAt   = new \DateTime();
        $this->endAt->setTime(23,59);

        $this->setDefault('_template', 'JJK801LADSMBundle:Calendar:task.html.twig');

        $this->slugKey = md5(time().rand(0, 10000));
    }

    public function getSlugKey()
    {
        return $this->slugKey;
    }

    public function getStartAt()
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt()
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTime $endAt)
    {
        $this->endAt = $endAt;

        return $this;
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
