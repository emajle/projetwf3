<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Animal;
use App\Entity\Produit;
use App\Entity\Association;
use App\Entity\QrCode;
use App\Entity\Specialiste;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    // -----------------------------------------------------------
    /**
     *              TEST USER ENTITY
     */
    // -----------------------------------------------------------
    public function testIsTrueUser(): void
    {

        $user = new User();

        $user->setEmail('true@test.com')
            ->setPrenom('prenom')
            ->setNom('nom')
            ->setPassword('password');

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPrenom() === 'prenom');
        $this->assertTrue($user->getNom() === 'nom');
        $this->assertTrue($user->getPassword() === 'password');
    }

    public function testIsFalseUser(): void
    {

        $user = new User();

        $user->setEmail('true@test.com')
            ->setPrenom('prenom')
            ->setNom('nom')
            ->setPassword('password');

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPrenom() === 'false');
        $this->assertFalse($user->getNom() === 'false');
        $this->assertFalse($user->getPassword() === 'false');
    }

    public function testIsEmptyUser(): void
    {

        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getNom());
    }
    // -----------------------------------------------------------
    /**
     *              TEST ANIMAL ENTITY
     */
    // -----------------------------------------------------------
    public function testIsTrueAnimal(): void
    {

        $animal = new Animal();


        $animal->setPrenom('prenom')
            ->setEspece('espece')
            ->setCouleur('couleur')
            ->setAge(1)
            ->setSexe('sexe')
            ->setPhoto('photo')
            ->setDescription('description');


        $this->assertTrue($animal->getPrenom() === 'prenom');
        $this->assertTrue($animal->getEspece() === 'espece');
        $this->assertTrue($animal->getAge() === 1);
        $this->assertTrue($animal->getSexe() === 'sexe');
        $this->assertTrue($animal->getPhoto() === 'photo');
        $this->assertTrue($animal->getDescription() === 'description');
    }

    public function testIsFalseAnimal(): void
    {

        $animal = new Animal();


        $animal->setPrenom('prenom')
            ->setEspece('espece')
            ->setCouleur('couleur')
            ->setAge(1)
            ->setSexe('sexe')
            ->setPhoto('photo')
            ->setDescription('description');


        $this->assertFalse($animal->getPrenom() === 'false');
        $this->assertFalse($animal->getEspece() === 'false');
        $this->assertFalse($animal->getAge() === 2);
        $this->assertFalse($animal->getSexe() === 'false');
        $this->assertFalse($animal->getPhoto() === 'false');
        $this->assertFalse($animal->getDescription() === 'false');
    }

    public function testIsEmptyAnimal(): void
    {

        $animal = new Animal();

        $this->assertEmpty($animal->getPrenom());
        $this->assertEmpty($animal->getEspece());
        $this->assertEmpty($animal->getAge());
        $this->assertEmpty($animal->getSexe());
        $this->assertEmpty($animal->getPhoto());
        $this->assertEmpty($animal->getDescription());
    }
    // -----------------------------------------------------------
    /**
     *              TEST ASSOCIATION ENTITY
     */
    // -----------------------------------------------------------
    public function testIsTrueAssociation(): void
    {

        $association = new Association();

        $association->setNom('nom')
            ->setAnimalConcerne('animal_concerne')
            ->setTelephone('telephone')
            ->setEmail('email')
            ->setAdresse('adresse')
            ->setVille('ville')
            ->setCp('1')
            ->setService('service')
            ->setDescription('description');

        $this->assertTrue($association->getNom() === 'nom');
        $this->assertTrue($association->getAnimalConcerne() === 'animal_concerne');
        $this->assertTrue($association->getTelephone() === 'telephone');
        $this->assertTrue($association->getAdresse() === 'adresse');
        $this->assertTrue($association->getVille() === 'ville');
        $this->assertTrue($association->getCp() === 1);
        $this->assertTrue($association->getService() === 'service');
        $this->assertTrue($association->getDescription() === 'description');
    }

    public function testIsFalseAssociation(): void
    {

        $association = new Association();

        $association->setNom('nom')
            ->setAnimalConcerne('animal_concerne')
            ->setTelephone('telephone')
            ->setEmail('email')
            ->setAdresse('adresse')
            ->setVille('ville')
            ->setCp(1)
            ->setService('service')
            ->setDescription('descitpion');

        $this->assertFalse($association->getNom() === 'false');
        $this->assertFalse($association->getAnimalConcerne() === 'false');
        $this->assertFalse($association->getTelephone() === 'false');
        $this->assertFalse($association->getAdresse() === 'false');
        $this->assertFalse($association->getVille() === 'false');
        $this->assertFalse($association->getCp() === 2);
        $this->assertFalse($association->getService() === 'false');
        $this->assertFalse($association->getDescription() === 'false');
    }

    public function testIsEmptyAssociation(): void
    {

        $association = new Association();

        $this->assertEmpty($association->getNom());
        $this->assertEmpty($association->getAnimalConcerne());
        $this->assertEmpty($association->getTelephone());
        $this->assertEmpty($association->getAdresse());
        $this->assertEmpty($association->getVille());
        $this->assertEmpty($association->getCp());
        $this->assertEmpty($association->getService());
        $this->assertEmpty($association->getDescription());
    }
    // -----------------------------------------------------------
    /**
     *              TEST IMAGE ENTITY
     */
    // -----------------------------------------------------------
    public function testIsTrueImage(): void
    {

        $image = new Image;

        $image->setName('name');

        $this->assertTrue($image->getName() === 'name');
    }

    public function testIsFalseImage(): void
    {

        $image = new Image;

        $image->setName('name');

        $this->assertFalse($image->getName() === 'false');
    }

    public function testIsEmptyImage(): void
    {

        $image = new Image;

        $this->assertEmpty($image->getName());
    }
    //  ----------------------------------------------------------
    /**
     *              TEST PRODUIT ENTITY
     */
    // -----------------------------------------------------------
    public function testIsTrueProduit(): void
    {

        $produit = new Produit();

        $produit->setReference(1)
            ->setTitre('titre')
            ->setCategorie('categorie')
            ->setDescription('description')
            ->setPhoto('photo')
            ->setPrix(10.10)
            ->setOrigineSite('origine_site');

        $this->assertTrue($produit->getReference() === 1);
        $this->assertTrue($produit->getTitre() === 'titre');
        $this->assertTrue($produit->getCategorie() === 'categorie');
        $this->assertTrue($produit->getDescription() === 'description');
        $this->assertTrue($produit->getPhoto() === 'photo');
        $this->assertTrue($produit->getPrix() === 10.10);
        $this->assertTrue($produit->getOrigineSite() === 'origine_site');
    }

    public function testIsFalseProduit(): void
    {

        $produit = new Produit();

        $produit->setReference(1)
            ->setTitre('titre')
            ->setCategorie('categorie')
            ->setDescription('descritpion')
            ->setPhoto('photo')
            ->setPrix(10.10)
            ->setOrigineSite('origine_site');

        $this->assertFalse($produit->getReference() === 2);
        $this->assertFalse($produit->getTitre() === 'false');
        $this->assertFalse($produit->getCategorie() === 'false');
        $this->assertFalse($produit->getDescription() === 'false');
        $this->assertFalse($produit->getPhoto() === 'false');
        $this->assertFalse($produit->getPrix() === 11.10);
        $this->assertFalse($produit->getOrigineSite() === 'false');
    }

    public function testIsEmptyProduit(): void
    {

        $produit = new Produit();

        $this->assertEmpty($produit->getReference());
        $this->assertEmpty($produit->getTitre());
        $this->assertEmpty($produit->getCategorie());
        $this->assertEmpty($produit->getDescription());
        $this->assertEmpty($produit->getPhoto());
        $this->assertEmpty($produit->getPrix());
        $this->assertEmpty($produit->getOrigineSite());
    }

    // -----------------------------------------------------------
    /**
     *              TEST QRCode ENTITY
     */
    // -----------------------------------------------------------
    public function testIsTrueQrCode(): void
    {

        $qr_code = new QrCode;

        $qr_code->setImageQrc('image_qrc');

        $this->assertTrue($qr_code->getImageQrc() === 'image_qrc');
    }

    public function testIsFalseQrCode(): void
    {

        $qr_code = new QrCode;

        $qr_code->setImageQrc('image_qrc');

        $this->assertFalse($qr_code->getImageQrc() === 'false');
    }

    public function testIsEmptyQrCode(): void
    {

        $qr_code = new QrCode;

        $this->assertEmpty($qr_code->getImageQrc());
    }

    // -----------------------------------------------------------
    /**
     *      OK/Validé =====>  TEST SPECIALISTE ENTITY => Déjà fait avec TU Asso
     */
    // -----------------------------------------------------------

}
