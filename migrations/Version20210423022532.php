<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423022532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31681B61704B');
        $this->addSql('DROP INDEX IDX_BFDD31681B61704B ON articles');
        $this->addSql('ALTER TABLE articles DROP pret_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD pret_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31681B61704B FOREIGN KEY (pret_id) REFERENCES prets (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31681B61704B ON articles (pret_id)');
    }
}
