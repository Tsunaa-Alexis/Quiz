<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905102653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY mess_id');
        $this->addSql('DROP INDEX mess_id ON post');
        $this->addSql('ALTER TABLE post ADD content TEXT NOT NULL, ADD date DATETIME NOT NULL, DROP mess_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD mess_id INT DEFAULT NULL, DROP content, DROP date');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT mess_id FOREIGN KEY (mess_id) REFERENCES message (mess_id)');
        $this->addSql('CREATE INDEX mess_id ON post (mess_id)');
    }
}
