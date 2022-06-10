<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610130713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_fonda (id INT AUTO_INCREMENT NOT NULL, analyse_fondamentale_id INT NOT NULL, actif_fonda VARCHAR(255) DEFAULT NULL, contenu_fonda LONGTEXT NOT NULL, nickname VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_4FF443FE326A6375 (analyse_fondamentale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_fonda ADD CONSTRAINT FK_4FF443FE326A6375 FOREIGN KEY (analyse_fondamentale_id) REFERENCES analyse_fondamentale (id)');
        $this->addSql('ALTER TABLE commentaire CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commentaire_fonda');
        $this->addSql('ALTER TABLE commentaire CHANGE email email VARCHAR(255) NOT NULL');
    }
}
