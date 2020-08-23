<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200822203016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (categorie_id INT AUTO_INCREMENT NOT NULL, cat_name VARCHAR(50) NOT NULL, cat_description VARCHAR(1000) NOT NULL, PRIMARY KEY(categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (mess_id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, contenu TEXT NOT NULL, date DATE NOT NULL, INDEX user_id (user_id), PRIMARY KEY(mess_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (post_id INT AUTO_INCREMENT NOT NULL, mess_id INT DEFAULT NULL, user_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, INDEX IDX_5A8A6C8DBCF5E72D (categorie_id), INDEX mess_id (mess_id), INDEX user_id_post (user_id), PRIMARY KEY(post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(52) DEFAULT NULL, num INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, mdp VARCHAR(30) NOT NULL, INDEX user_id (user_id), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D71CCE5FD FOREIGN KEY (mess_id) REFERENCES message (mess_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBCF5E72D');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D71CCE5FD');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE user');
    }
}
