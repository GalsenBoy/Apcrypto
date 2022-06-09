<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609202117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE analyse_fondamentale (id INT AUTO_INCREMENT NOT NULL, actif_name VARCHAR(255) NOT NULL, expliquation_fond LONGTEXT NOT NULL, createat DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE analyse_technique DROP user_id');
        $this->addSql('ALTER TABLE commentaire ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE analyse_fondamentale');
        $this->addSql('ALTER TABLE analyse_technique ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire DROP email');
    }
}
