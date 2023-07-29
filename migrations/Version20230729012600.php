<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230729012600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD username_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398ED766068 ON `order` (username_id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398ED766068');
        $this->addSql('DROP INDEX IDX_F5299398ED766068 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP username_id');
        $this->addSql('ALTER TABLE user DROP username');
    }
}
