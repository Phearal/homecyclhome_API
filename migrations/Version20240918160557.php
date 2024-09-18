<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240918160557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE marque_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE marque (id INT NOT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, couleur VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE intervention ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD technicien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB19EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB13457256 FOREIGN KEY (technicien_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D11814AB19EB6921 ON intervention (client_id)');
        $this->addSql('CREATE INDEX IDX_D11814AB13457256 ON intervention (technicien_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE marque_id_seq CASCADE');
        $this->addSql('DROP TABLE marque');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT FK_D11814AB19EB6921');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT FK_D11814AB13457256');
        $this->addSql('DROP INDEX IDX_D11814AB19EB6921');
        $this->addSql('DROP INDEX IDX_D11814AB13457256');
        $this->addSql('ALTER TABLE intervention DROP client_id');
        $this->addSql('ALTER TABLE intervention DROP technicien_id');
    }
}
