<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240918154821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE type_intervention_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE type_intervention (id INT NOT NULL, nom VARCHAR(255) NOT NULL, duree TIME(0) WITHOUT TIME ZONE NOT NULL, prix_depart NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE intervention ADD type_intervention_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB799AAC17 FOREIGN KEY (type_intervention_id) REFERENCES type_intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D11814AB799AAC17 ON intervention (type_intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT FK_D11814AB799AAC17');
        $this->addSql('DROP SEQUENCE type_intervention_id_seq CASCADE');
        $this->addSql('DROP TABLE type_intervention');
        $this->addSql('DROP INDEX IDX_D11814AB799AAC17');
        $this->addSql('ALTER TABLE intervention DROP type_intervention_id');
    }
}
