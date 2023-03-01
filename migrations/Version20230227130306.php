<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227130306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_mail_contacts ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_mail_contacts ADD CONSTRAINT FK_74EAE997A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_74EAE997A76ED395 ON app_mail_contacts (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_mail_contacts DROP FOREIGN KEY FK_74EAE997A76ED395');
        $this->addSql('DROP INDEX IDX_74EAE997A76ED395 ON app_mail_contacts');
        $this->addSql('ALTER TABLE app_mail_contacts DROP user_id');
    }
}
