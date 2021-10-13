<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006080453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, poster_id INT NOT NULL, parentpost_id INT NOT NULL, parentcomment_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, status TINYINT(1) DEFAULT NULL, INDEX IDX_9474526C5BB66C05 (poster_id), INDEX IDX_9474526CFDA92769 (parentpost_id), INDEX IDX_9474526C44BEF3E0 (parentcomment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5BB66C05 FOREIGN KEY (poster_id) REFERENCES user_profile (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CFDA92769 FOREIGN KEY (parentpost_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C44BEF3E0 FOREIGN KEY (parentcomment_id) REFERENCES comment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C44BEF3E0');
        $this->addSql('DROP TABLE comment');
    }
}
