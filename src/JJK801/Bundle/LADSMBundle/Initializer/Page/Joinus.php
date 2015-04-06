<?php
namespace JJK801\Bundle\LADSMBundle\Initializer\Page;

use JJK801\Bundle\LADSMBundle\Initializer\AbstractPageInitializer;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Doctrine\ODM\PHPCR\DocumentManager;
use JJK801\Bundle\LADSMBundle\Document\Page;

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\StringBlock;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SimpleBlock;

class Joinus extends AbstractPageInitializer
{
    /**
     * {@inheritDoc}
     */
    public function init(ManagerRegistry $registry)
    {
        $manager = $registry->getManagerForClass('JJK801\Bundle\LADSMBundle\Document\Page');

        $this->setPage(array(
            "basePath" => "/cms/simple/about",
            "nodeName" => "joinus",
            "title"    => "Nous soutenir",
            "defaults" => array(
                "_template" => "JJK801LADSMBundle:About:joinus.html.twig",
            ),
        ));

        $this->setMenu(array(
            "simple" => array(
                "label"      => "Nous soutenir",
            ),
            "main" => array(
                "basePath"   => '/cms/menu/main',
                "name"       => "joinus",
                "label"      => "Nous soutenir",
                "attributes" => array(
                    "class" => "joinus",
                ),
            ),
            "home" => array(
                "basePath"   => '/cms/menu/home',
                "name"       => "joinus",
                "label"      => "Agir pour eux",
                "attributes" => array(
                    "class" => "joinus",
                ),
            ),
            "about" => array(
                "basePath"   => '/cms/menu/about',
                "name"       => "joinus",
                "label"      => "Comment nous soutenir?"
            )
        ));
        
        $page = parent::init($registry);

        $this->loadContent($manager, $page);

        $manager->flush();
    }

    protected function loadContent(DocumentManager $manager, Page $page)
    {
        $title = new StringBlock();
        $title->setId('/cms/content/about/joinus');
        $title->setBody("Comment nous soutenir ?");
        $title->setParentDocument($page);
        $manager->persist($title);

        $donate = new SimpleBlock();
        $donate->setId('/cms/content/about/joinus/donate');
        $donate->setTitle("Faire un don");
        $donate->setBody("<p>Les dons sont à adresser par chèque à l'ordre de l'<b>Association Les Amis de Soeur Myriam</b> à l'adresse suivante:</p>
        <p><strong>Les Amis de Soeur Myriam</strong></p>
        <p><strong>118 rue Dhavernas, 80 000 AMIENS</strong></p>
        <p>Le montant des dons versés fait l’objet d’un reçu fiscal.</p>
        <p>Notre association n'a pas de frais de fonctionnement.L'intégralité du don part au Vietnam.</p>");
        $donate->setParentDocument($page);
        $manager->persist($donate);

        $buy = new SimpleBlock();
        $buy->setId('/cms/content/about/joinus/buy');
        $buy->setTitle("Acheter nos produits locaux et photographies");
        $buy->setBody("<p>Nous vous offrons la possibilité d’acheter des produits locaux:</p>
        <ul>
                <li>Poivre</li>
                <li>Thé</li>
                <li>Curry</li>
                <li>...</li>
        </ul>
        <p>Ainsi que les photographies (visibles dans la rubrique «Galerie photos»).</p>
        <p>Ces achats ne font pas l'objet d'un reçu fiscal mais donnent lieu à une facture.</p>
        <p>Les bénéfices seront intégralement reversés à l’association.</p>");
        $buy->setParentDocument($page);
        $manager->persist($buy);

        $join = new SimpleBlock();
        $join->setId('/cms/content/about/joinus/join');
        $join->setTitle("Participer aux actions de l'association");
        $join->setBody("<p>Nous organisons régulièrement divers évenements : <em>(Visitez la rubrique «Nos Actualités» pour en savoir plus sur nos événements)</em></p>
        <ul>
                <li>Expositions photo</li>
                <li>Kermesses</li>
                <li>Repas vietnamiens</li>
                <li>...</li>
        </ul>
        <p>En plus d’offrir une visibilité à l’association, à ses projets et actions, ces événements permettent la rencontre et le partage entre nos membres, bienfaiteurs et à tous ceux qui souhaiteraient connaître davantage l’association.</p>");
        $join->setParentDocument($page);
        $manager->persist($join);
    }
}