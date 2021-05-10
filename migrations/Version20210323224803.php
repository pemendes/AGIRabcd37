<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323224803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, pret_id INT DEFAULT NULL, proprietaire_id INT NOT NULL, name VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, date_arrivee DATETIME DEFAULT NULL, etat INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_23A0E66BCF5E72D (categorie_id), INDEX IDX_23A0E661B61704B (pret_id), INDEX IDX_23A0E6676C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pret (id INT AUTO_INCREMENT NOT NULL, stagiaire_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, is_returned TINYINT(1) NOT NULL, commentaire_debut LONGTEXT NOT NULL, commentaire_fin LONGTEXT NOT NULL, validation TINYINT(1) NOT NULL, INDEX IDX_52ECE979BBA93DD6 (stagiaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, organisme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stagiaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) NOT NULL, formation VARCHAR(255) NOT NULL, campus VARCHAR(255) DEFAULT NULL, promotion VARCHAR(255) DEFAULT NULL, is_actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661B61704B FOREIGN KEY (pret_id) REFERENCES pret (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6676C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE979BBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661B61704B');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6676C50E4A');
        $this->addSql('ALTER TABLE pret DROP FOREIGN KEY FK_52ECE979BBA93DD6');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE pret');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE stagiaire');
        $this->addSql('DROP TABLE utilisateur');
    }
}
