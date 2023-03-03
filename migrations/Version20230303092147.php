<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303092147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_mail_categories ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_mail_categories ADD CONSTRAINT FK_B4EA891DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B4EA891DA76ED395 ON app_mail_categories (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_mail_categories DROP FOREIGN KEY FK_B4EA891DA76ED395');
        $this->addSql('DROP INDEX IDX_B4EA891DA76ED395 ON app_mail_categories');
        $this->addSql('ALTER TABLE app_mail_categories DROP user_id');
    }
}
