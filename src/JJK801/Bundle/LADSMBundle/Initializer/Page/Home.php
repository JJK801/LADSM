<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use Doctrine\ODM\PHPCR\DocumentManager;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use JJK801\Bundle\LADSMBundle\Document\Page;

use Symfony\Cmf\Bundle\MediaBundle\Doctrine\Phpcr\Image;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\ImagineBlock;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SimpleBlock;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SlideshowBlock;

class Home extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $manager = $registry->getManagerForClass('JJK801\Bundle\LADSMBundle\Document\Page');

        $this->setPage(array(
            "title"    => "Accueil",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle::index.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Accueil",
            ),
            "main" => array(
                "basePath"   => '/cms/menu/main',
                "name"       => "home",
                "label"      => "Accueil",
                "attributes" => array(
                    "class" => "home",
                ),
            ),
        ));

        $page = parent::init($registry);

        $this->loadContent($manager, $page);
        $this->loadSlideshow($manager, $page);

        $manager->flush();
    }

    protected function loadContent(DocumentManager $manager, Page $page)
    {
        $content = new SimpleBlock();
        $content->setId('/cms/content/home');
        $content->setTitle('Les Amis de soeur Myriam');
        $content->setBody("<p>Créée en 1998 par des médecins du Nord de la France, l’Association apporte une aide financière aux oeuvres de Soeur Myriam, fondatrice de la Communauté des Béatitudes au Vietnam. Native du pays, Soeur Myriam  oeuvre depuis 1992 pour aider les plus démunis.</p>
        <p>En 2011, Soeur Myriam passe le relais au père Paul-Dominique, actuellement supérieur de la Communauté au Vietnam.</p>
        <p>Agée de 75 ans, Soeur Myriam est aujourd’hui en retraite en France, à Pont Saint-Esprit.</p>
        <p>Aujourd'hui, grâce à son action, environ 200 personnes sont accueillies dans les cinq centres de la Communauté : des orphelins, des familles en difficultés, des handicapés mentaux ou physiques, des sourds et muets, des jeunes issus de familles aux revenus modestes qui peuvent accéder ainsi à l'école ou à l'université.</p>
        <p>L’association a l’objectif de collecter des fonds qui permettront la réalisation d’actions concrètes. Son dynamisme lui permet de verser environ 30.000€ par an à la Communauté des Béatitudes au Vietnam.</p>
        <p>Depuis 2009, l’association a développé un accompagnement des enfants sourds à travers des missions de formation du personnel soignant et la mise en réseau d’audioprothésistes en France, qui remettent à neuf bénévolement du matériel : 10 appareils auditifs ont ainsi été envoyés à Tan Thong en 2012.</p>");
        $content->setParentDocument($page);
        $manager->persist($content);
    }

    protected function loadSlideshow(DocumentManager $manager, Page $page)
    {
        $slideshow = new SlideshowBlock();
        $slideshow->setId('/cms/media/home_slideshow');
        $slideshow->setParentDocument($page);
        $manager->persist($slideshow);

        $this->loadSlide($manager, $slideshow, array(
            "name" => "1",
            "path" => "web/images/slideshow/1.jpg"
        ));

        $this->loadSlide($manager, $slideshow, array(
            "name" => "2",
            "path" => "web/images/slideshow/2.jpg"
        ));

        $this->loadSlide($manager, $slideshow, array(
            "name" => "3",
            "path" => "web/images/slideshow/3.jpg"
        ));

        $this->loadSlide($manager, $slideshow, array(
            "name" => "4",
            "path" => "web/images/slideshow/4.jpg"
        ));

        $this->loadSlide($manager, $slideshow, array(
            "name" => "5",
            "path" => "web/images/slideshow/5.jpg"
        ));

        $this->loadSlide($manager, $slideshow, array(
            "name" => "6",
            "path" => "web/images/slideshow/6.jpg"
        ));

        $this->loadSlide($manager, $slideshow, array(
            "name" => "7",
            "path" => "web/images/slideshow/7.jpg"
        ));

        return $slideshow;
    }

    protected function loadSlide(DocumentManager $manager, SlideshowBlock $slideshow, array $params)
    {
        $slide = new ImagineBlock();
        $slide->setName($params['name']);
        if (isset($params['label'])) {
            $slide->setLabel($params['label']);
        }
        $slide->setParentDocument($slideshow);
        $slide->setFilter('home_slideshow');
        $manager->persist($slide);
        
        $image = new Image();
        $image->setFileContentFromFilesystem($params['path']);
        $slide->setImage($image);

        return $slide;
    }
}