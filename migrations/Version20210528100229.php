<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528100229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qr_code DROP FOREIGN KEY FK_7D8B1FB58E962C16');
        $this->addSql('DROP INDEX UNIQ_7D8B1FB58E962C16 ON qr_code');
        $this->addSql('ALTER TABLE qr_code DROP animal_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qr_code ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE qr_code ADD CONSTRAINT FK_7D8B1FB58E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D8B1FB58E962C16 ON qr_code (animal_id)');
    }
}
