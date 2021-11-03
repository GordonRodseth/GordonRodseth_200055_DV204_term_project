<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211031082441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        //$this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D727ACA70');
        //$this->addSql('DROP INDEX IDX_5A8A6C8D727ACA70 ON post');
       // $this->addSql('ALTER TABLE post ADD poster_id INT NOT NULL');
        //$this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D5BB66C05 FOREIGN KEY (poster_id) REFERENCES user (id)');
        //$this->addSql('CREATE INDEX IDX_5A8A6C8D5BB66C05 ON post (poster_id)');
        $this->addSql('ALTER TABLE user ADD reputation INT DEFAULT NULL, ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
        //$this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D5BB66C05');
        //$this->addSql('DROP INDEX IDX_5A8A6C8D5BB66C05 ON post');
        $this->addSql('ALTER TABLE post ADD parent_id INT DEFAULT NULL');
       // $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D727ACA70 FOREIGN KEY (parent_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D727ACA70 ON post (parent_id)');
       // $this->addSql('ALTER TABLE user DROP reputation, DROP email');
    }
}
