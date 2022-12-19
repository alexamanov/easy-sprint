<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219213042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, sprint_id INT DEFAULT NULL, chunk_ids JSON DEFAULT NULL, UNIQUE INDEX UNIQ_6EA9A1468C24077B (sprint_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chunk (id INT AUTO_INCREMENT NOT NULL, link_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date DATE NOT NULL, estimate INT DEFAULT NULL, INDEX IDX_9506712EADA40271 (link_id), INDEX IDX_9506712EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1468C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id)');
        $this->addSql('ALTER TABLE chunk ADD CONSTRAINT FK_9506712EADA40271 FOREIGN KEY (link_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE chunk ADD CONSTRAINT FK_9506712EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1468C24077B');
        $this->addSql('ALTER TABLE chunk DROP FOREIGN KEY FK_9506712EADA40271');
        $this->addSql('ALTER TABLE chunk DROP FOREIGN KEY FK_9506712EA76ED395');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE chunk');
    }
}
