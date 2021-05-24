<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524013834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite_medical DROP INDEX UNIQ_BDDA727C6F1A5C10, ADD INDEX IDX_BDDA727C6F1A5C10 (specialiste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite_medical DROP INDEX IDX_BDDA727C6F1A5C10, ADD UNIQUE INDEX UNIQ_BDDA727C6F1A5C10 (specialiste_id)');
    }
}
