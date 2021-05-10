<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502150053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD reference VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168AEA34913 ON articles (reference)');
        $this->addSql('ALTER TABLE prets CHANGE is_returned is_returned TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE prets_articles CHANGE prets_id prets_id INT NOT NULL, CHANGE articles_id articles_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A9FADC6E7927C74 ON stagiaires (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_BFDD3168AEA34913 ON articles');
        $this->addSql('ALTER TABLE articles DROP reference');
        $this->addSql('ALTER TABLE prets CHANGE is_returned is_returned TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE prets_articles CHANGE prets_id prets_id INT DEFAULT 0 NOT NULL, CHANGE articles_id articles_id INT DEFAULT 0 NOT NULL');
        $this->addSql('DROP INDEX UNIQ_4A9FADC6E7927C74 ON stagiaires');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur');
    }
}
