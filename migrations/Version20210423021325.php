<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423021325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prets_articles (prets_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_751C6719664444D (prets_id), INDEX IDX_751C67191EBAF6CC (articles_id), PRIMARY KEY(prets_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prets_articles ADD CONSTRAINT FK_751C6719664444D FOREIGN KEY (prets_id) REFERENCES prets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prets_articles ADD CONSTRAINT FK_751C67191EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prets_articles');
    }
}
