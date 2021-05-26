<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525083816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, prenom VARCHAR(20) NOT NULL, espece VARCHAR(10) NOT NULL, couleur VARCHAR(20) NOT NULL, age INT NOT NULL, sexe VARCHAR(5) NOT NULL, photo VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_6AAB231F6A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, animal_concerne VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, adresse LONGTEXT NOT NULL, ville VARCHAR(50) NOT NULL, cp INT NOT NULL, service VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carnet_sante (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, UNIQUE INDEX UNIQ_A7801B4F8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, reference INT NOT NULL, titre VARCHAR(50) NOT NULL, categorie VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, origine_site VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qr_code (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, image_qrc VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7D8B1FB58E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialiste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, profession VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(50) DEFAULT NULL, adresse LONGTEXT NOT NULL, ville VARCHAR(50) NOT NULL, cp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(15) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, ville VARCHAR(20) NOT NULL, cp INT NOT NULL, adresse LONGTEXT NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccins_et_operation (id INT AUTO_INCREMENT NOT NULL, specialiste_id INT NOT NULL, carnet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_6F76A1C66F1A5C10 (specialiste_id), INDEX IDX_6F76A1C6FA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_medical (id INT AUTO_INCREMENT NOT NULL, specialiste_id INT NOT NULL, carnet_id INT NOT NULL, date_visite DATE NOT NULL, symptome LONGTEXT DEFAULT NULL, diagnostique LONGTEXT DEFAULT NULL, analyses LONGTEXT DEFAULT NULL, INDEX IDX_BDDA727C6F1A5C10 (specialiste_id), INDEX IDX_BDDA727CFA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6A99F74A FOREIGN KEY (membre_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE carnet_sante ADD CONSTRAINT FK_A7801B4F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE qr_code ADD CONSTRAINT FK_7D8B1FB58E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vaccins_et_operation ADD CONSTRAINT FK_6F76A1C66F1A5C10 FOREIGN KEY (specialiste_id) REFERENCES specialiste (id)');
        $this->addSql('ALTER TABLE vaccins_et_operation ADD CONSTRAINT FK_6F76A1C6FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet_sante (id)');
        $this->addSql('ALTER TABLE visite_medical ADD CONSTRAINT FK_BDDA727C6F1A5C10 FOREIGN KEY (specialiste_id) REFERENCES specialiste (id)');
        $this->addSql('ALTER TABLE visite_medical ADD CONSTRAINT FK_BDDA727CFA207516 FOREIGN KEY (carnet_id) REFERENCES carnet_sante (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carnet_sante DROP FOREIGN KEY FK_A7801B4F8E962C16');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8E962C16');
        $this->addSql('ALTER TABLE qr_code DROP FOREIGN KEY FK_7D8B1FB58E962C16');
        $this->addSql('ALTER TABLE vaccins_et_operation DROP FOREIGN KEY FK_6F76A1C6FA207516');
        $this->addSql('ALTER TABLE visite_medical DROP FOREIGN KEY FK_BDDA727CFA207516');
        $this->addSql('ALTER TABLE vaccins_et_operation DROP FOREIGN KEY FK_6F76A1C66F1A5C10');
        $this->addSql('ALTER TABLE visite_medical DROP FOREIGN KEY FK_BDDA727C6F1A5C10');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6A99F74A');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE carnet_sante');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE qr_code');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE specialiste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vaccins_et_operation');
        $this->addSql('DROP TABLE visite_medical');
    }
}
