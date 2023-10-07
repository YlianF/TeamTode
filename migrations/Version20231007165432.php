<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007165432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE annonces_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE jeux_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE annonces (id INT NOT NULL, jeu_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, content VARCHAR(1000) NOT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB988C6F8C9E392E ON annonces (jeu_id)');
        $this->addSql('CREATE TABLE jeux (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeux (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE annonces_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE jeux_id_seq CASCADE');
        $this->addSql('ALTER TABLE annonces DROP CONSTRAINT FK_CB988C6F8C9E392E');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE jeux');
    }
}
