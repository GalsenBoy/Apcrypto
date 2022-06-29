<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628084713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_controller (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE analyse_fondamentale (id INT AUTO_INCREMENT NOT NULL, actif_name VARCHAR(255) NOT NULL, expliquation_fond LONGTEXT NOT NULL, createat DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE analyse_technique (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, actif VARCHAR(255) NOT NULL, analyse VARCHAR(255) NOT NULL, explication LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_4F99D8EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, analysetechnique_id INT NOT NULL, user_id INT DEFAULT NULL, commentaire_parent_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, active TINYINT(1) NOT NULL, email VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_67F068BC6303F489 (analysetechnique_id), INDEX IDX_67F068BCA76ED395 (user_id), INDEX IDX_67F068BCFDED4547 (commentaire_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_fonda (id INT AUTO_INCREMENT NOT NULL, analyse_fondamentale_id INT NOT NULL, actif_fonda VARCHAR(255) DEFAULT NULL, contenu_fonda LONGTEXT NOT NULL, nickname VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_4FF443FE326A6375 (analyse_fondamentale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, pseudo VARCHAR(100) NOT NULL, est_actif TINYINT(1) NOT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE analyse_technique ADD CONSTRAINT FK_4F99D8EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC6303F489 FOREIGN KEY (analysetechnique_id) REFERENCES analyse_technique (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFDED4547 FOREIGN KEY (commentaire_parent_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE commentaire_fonda ADD CONSTRAINT FK_4FF443FE326A6375 FOREIGN KEY (analyse_fondamentale_id) REFERENCES analyse_fondamentale (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_fonda DROP FOREIGN KEY FK_4FF443FE326A6375');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC6303F489');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFDED4547');
        $this->addSql('ALTER TABLE analyse_technique DROP FOREIGN KEY FK_4F99D8EBA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE admin_controller');
        $this->addSql('DROP TABLE analyse_fondamentale');
        $this->addSql('DROP TABLE analyse_technique');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE commentaire_fonda');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
