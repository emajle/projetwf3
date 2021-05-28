<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528122046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usernews_catenews (usernews_id INT NOT NULL, catenews_id INT NOT NULL, INDEX IDX_78D8733C29C5A51E (usernews_id), INDEX IDX_78D8733C81189443 (catenews_id), PRIMARY KEY(usernews_id, catenews_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usernews_catenews ADD CONSTRAINT FK_78D8733C29C5A51E FOREIGN KEY (usernews_id) REFERENCES usernews (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usernews_catenews ADD CONSTRAINT FK_78D8733C81189443 FOREIGN KEY (catenews_id) REFERENCES catenews (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE catenews_usernews');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catenews_usernews (catenews_id INT NOT NULL, usernews_id INT NOT NULL, INDEX IDX_703BB5829C5A51E (usernews_id), INDEX IDX_703BB5881189443 (catenews_id), PRIMARY KEY(catenews_id, usernews_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE catenews_usernews ADD CONSTRAINT FK_703BB5829C5A51E FOREIGN KEY (usernews_id) REFERENCES usernews (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catenews_usernews ADD CONSTRAINT FK_703BB5881189443 FOREIGN KEY (catenews_id) REFERENCES catenews (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE usernews_catenews');
    }
}
