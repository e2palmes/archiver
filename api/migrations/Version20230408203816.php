<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230408203816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_level (document_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_F34BBA61C33F7837 (document_id), INDEX IDX_F34BBA615FB14BA7 (level_id), PRIMARY KEY(document_id, level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_degree (document_id INT NOT NULL, degree_id INT NOT NULL, INDEX IDX_19C1DC05C33F7837 (document_id), INDEX IDX_19C1DC05B35C5756 (degree_id), PRIMARY KEY(document_id, degree_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_option (document_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_E4E4B1D6C33F7837 (document_id), INDEX IDX_E4E4B1D6A7C41D6F (option_id), PRIMARY KEY(document_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_level ADD CONSTRAINT FK_F34BBA61C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_level ADD CONSTRAINT FK_F34BBA615FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_degree ADD CONSTRAINT FK_19C1DC05C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_degree ADD CONSTRAINT FK_19C1DC05B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_option ADD CONSTRAINT FK_E4E4B1D6C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_option ADD CONSTRAINT FK_E4E4B1D6A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_level DROP FOREIGN KEY FK_F34BBA61C33F7837');
        $this->addSql('ALTER TABLE document_level DROP FOREIGN KEY FK_F34BBA615FB14BA7');
        $this->addSql('ALTER TABLE document_degree DROP FOREIGN KEY FK_19C1DC05C33F7837');
        $this->addSql('ALTER TABLE document_degree DROP FOREIGN KEY FK_19C1DC05B35C5756');
        $this->addSql('ALTER TABLE document_option DROP FOREIGN KEY FK_E4E4B1D6C33F7837');
        $this->addSql('ALTER TABLE document_option DROP FOREIGN KEY FK_E4E4B1D6A7C41D6F');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_level');
        $this->addSql('DROP TABLE document_degree');
        $this->addSql('DROP TABLE document_option');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE `option`');
    }
}
