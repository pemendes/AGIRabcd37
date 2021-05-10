<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510115938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, proprietaire_id INT NOT NULL, reference VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, date_arrivee DATETIME DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, etat INT NOT NULL, UNIQUE INDEX UNIQ_BFDD3168AEA34913 (reference), INDEX IDX_BFDD3168BCF5E72D (categorie_id), INDEX IDX_BFDD316876C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prets (id INT AUTO_INCREMENT NOT NULL, stagiaire_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, is_returned TINYINT(1) DEFAULT \'0\' NOT NULL, commentaire_debut LONGTEXT NOT NULL, commentaire_fin LONGTEXT DEFAULT NULL, validation TINYINT(1) NOT NULL, INDEX IDX_3285EA7ABBA93DD6 (stagiaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prets_articles (prets_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_751C6719664444D (prets_id), INDEX IDX_751C67191EBAF6CC (articles_id), PRIMARY KEY(prets_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaires (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, organisme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stagiaires (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) NOT NULL, formation VARCHAR(255) NOT NULL, campus VARCHAR(255) DEFAULT NULL, promotion VARCHAR(255) DEFAULT NULL, is_actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_4A9FADC6E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316876C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaires (id)');
        $this->addSql('ALTER TABLE prets ADD CONSTRAINT FK_3285EA7ABBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaires (id)');
        $this->addSql('ALTER TABLE prets_articles ADD CONSTRAINT FK_751C6719664444D FOREIGN KEY (prets_id) REFERENCES prets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prets_articles ADD CONSTRAINT FK_751C67191EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prets_articles DROP FOREIGN KEY FK_751C67191EBAF6CC');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168BCF5E72D');
        $this->addSql('ALTER TABLE prets_articles DROP FOREIGN KEY FK_751C6719664444D');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316876C50E4A');
        $this->addSql('ALTER TABLE prets DROP FOREIGN KEY FK_3285EA7ABBA93DD6');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE prets');
        $this->addSql('DROP TABLE prets_articles');
        $this->addSql('DROP TABLE proprietaires');
        $this->addSql('DROP TABLE stagiaires');
        $this->addSql('DROP TABLE utilisateur');
    }
}
