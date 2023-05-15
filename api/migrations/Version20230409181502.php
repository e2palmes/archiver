<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230409181502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_pathway (document_id INT NOT NULL, pathway_id INT NOT NULL, INDEX IDX_E082013EC33F7837 (document_id), INDEX IDX_E082013EF3DA7551 (pathway_id), PRIMARY KEY(document_id, pathway_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pathway (id INT AUTO_INCREMENT NOT NULL, degree_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_44EDA7E2B35C5756 (degree_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_pathway ADD CONSTRAINT FK_E082013EC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_pathway ADD CONSTRAINT FK_E082013EF3DA7551 FOREIGN KEY (pathway_id) REFERENCES pathway (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pathway ADD CONSTRAINT FK_44EDA7E2B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id)');
        $this->addSql('ALTER TABLE document_option DROP FOREIGN KEY FK_E4E4B1D6A7C41D6F');
        $this->addSql('ALTER TABLE document_option DROP FOREIGN KEY FK_E4E4B1D6C33F7837');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0B35C5756');
        $this->addSql('DROP TABLE document_option');
        $this->addSql('DROP TABLE `option`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_option (document_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_E4E4B1D6C33F7837 (document_id), INDEX IDX_E4E4B1D6A7C41D6F (option_id), PRIMARY KEY(document_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, degree_id INT DEFAULT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_5A8600B0B35C5756 (degree_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE document_option ADD CONSTRAINT FK_E4E4B1D6A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_option ADD CONSTRAINT FK_E4E4B1D6C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE document_pathway DROP FOREIGN KEY FK_E082013EC33F7837');
        $this->addSql('ALTER TABLE document_pathway DROP FOREIGN KEY FK_E082013EF3DA7551');
        $this->addSql('ALTER TABLE pathway DROP FOREIGN KEY FK_44EDA7E2B35C5756');
        $this->addSql('DROP TABLE document_pathway');
        $this->addSql('DROP TABLE pathway');
    }
}
