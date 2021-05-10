<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210405191251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pret_article');
        $this->addSql('ALTER TABLE article ADD pret_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661B61704B FOREIGN KEY (pret_id) REFERENCES pret (id)');
        $this->addSql('CREATE INDEX IDX_23A0E661B61704B ON article (pret_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pret_article (pret_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_7000C1361B61704B (pret_id), INDEX IDX_7000C1367294869C (article_id), PRIMARY KEY(pret_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pret_article ADD CONSTRAINT FK_7000C1361B61704B FOREIGN KEY (pret_id) REFERENCES pret (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pret_article ADD CONSTRAINT FK_7000C1367294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661B61704B');
        $this->addSql('DROP INDEX IDX_23A0E661B61704B ON article');
        $this->addSql('ALTER TABLE article DROP pret_id');
    }
}
