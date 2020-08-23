<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200822202552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(52) DEFAULT NULL, num INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD categorie_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE mess_id mess_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (categorie_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DBCF5E72D ON post (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE message CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBCF5E72D');
        $this->addSql('DROP INDEX IDX_5A8A6C8DBCF5E72D ON post');
        $this->addSql('ALTER TABLE post DROP categorie_id, CHANGE mess_id mess_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
    }
}
