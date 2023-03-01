<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227132326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_mail_contacts_app_mail_categories (app_mail_contacts_id INT NOT NULL, app_mail_categories_id INT NOT NULL, INDEX IDX_C1A23024517E28F2 (app_mail_contacts_id), INDEX IDX_C1A23024D821DDC3 (app_mail_categories_id), PRIMARY KEY(app_mail_contacts_id, app_mail_categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_mail_contacts_app_mail_categories ADD CONSTRAINT FK_C1A23024517E28F2 FOREIGN KEY (app_mail_contacts_id) REFERENCES app_mail_contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_mail_contacts_app_mail_categories ADD CONSTRAINT FK_C1A23024D821DDC3 FOREIGN KEY (app_mail_categories_id) REFERENCES app_mail_categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_mail_contacts_app_mail_categories DROP FOREIGN KEY FK_C1A23024517E28F2');
        $this->addSql('ALTER TABLE app_mail_contacts_app_mail_categories DROP FOREIGN KEY FK_C1A23024D821DDC3');
        $this->addSql('DROP TABLE app_mail_contacts_app_mail_categories');
    }
}
