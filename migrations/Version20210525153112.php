<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525153112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carnet_sante (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, UNIQUE INDEX UNIQ_A7801B4F8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccins_et_operation (id INT AUTO_INCREMENT NOT NULL, specialiste_id INT NOT NULL, carnet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_6F76A1C66F1A5C10 (specialiste_id), INDEX IDX_6F76A1C6FA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_medical (id INT AUTO_INCREMENT NOT NULL, specialiste_id INT NOT NULL, carnet_id INT NOT NULL, date_visite DATE NOT NULL, symptome LONGTEXT DEFAULT NULL, diagnostique LONGTEXT DEFAULT NULL, analyses LONGTEXT DEFAULT NULL, INDEX IDX_BDDA727C6F1A5C10 (specialiste_id), INDEX IDX_BDDA727CFA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carnet_sante ADD CONSTRAINT FK_A7801B4F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE vaccins_et_operation ADD CONSTRAINT FK_6F76A1C66F1A5C10 FOREIGN KEY (specialiste_id) REFERENCES specialiste (id)');
        $this->addSql('ALTER TABLE vaccins_et_operation ADD CONSTRAINT FK_6F76A1C6FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet_sante (id)');
        $this->addSql('ALTER TABLE visite_medical ADD CONSTRAINT FK_BDDA727C6F1A5C10 FOREIGN KEY (specialiste_id) REFERENCES specialiste (id)');
        $this->addSql('ALTER TABLE visite_medical ADD CONSTRAINT FK_BDDA727CFA207516 FOREIGN KEY (carnet_id) REFERENCES carnet_sante (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vaccins_et_operation DROP FOREIGN KEY FK_6F76A1C6FA207516');
        $this->addSql('ALTER TABLE visite_medical DROP FOREIGN KEY FK_BDDA727CFA207516');
        $this->addSql('DROP TABLE carnet_sante');
        $this->addSql('DROP TABLE vaccins_et_operation');
        $this->addSql('DROP TABLE visite_medical');
    }
}
