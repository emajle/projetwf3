<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526103019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carnet_sante ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carnet_sante ADD CONSTRAINT FK_A7801B4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A7801B4FA76ED395 ON carnet_sante (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carnet_sante DROP FOREIGN KEY FK_A7801B4FA76ED395');
        $this->addSql('DROP INDEX IDX_A7801B4FA76ED395 ON carnet_sante');
        $this->addSql('ALTER TABLE carnet_sante DROP user_id');
    }
}
