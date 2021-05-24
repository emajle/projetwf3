<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523174656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carnet_sante ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE carnet_sante ADD CONSTRAINT FK_A7801B4F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7801B4F8E962C16 ON carnet_sante (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carnet_sante DROP FOREIGN KEY FK_A7801B4F8E962C16');
        $this->addSql('DROP INDEX UNIQ_A7801B4F8E962C16 ON carnet_sante');
        $this->addSql('ALTER TABLE carnet_sante DROP animal_id');
    }
}
