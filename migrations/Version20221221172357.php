<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221172357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sprint ADD bundle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint ADD CONSTRAINT FK_EF8055B7F1FAD9D3 FOREIGN KEY (bundle_id) REFERENCES bundle (id)');
        $this->addSql('CREATE INDEX IDX_EF8055B7F1FAD9D3 ON sprint (bundle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sprint DROP FOREIGN KEY FK_EF8055B7F1FAD9D3');
        $this->addSql('DROP INDEX IDX_EF8055B7F1FAD9D3 ON sprint');
        $this->addSql('ALTER TABLE sprint DROP bundle_id');
    }
}
