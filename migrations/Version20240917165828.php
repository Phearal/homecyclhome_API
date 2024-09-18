<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240917165828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE intervention_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE intervention (id INT NOT NULL, velo_categorie VARCHAR(255) DEFAULT NULL, velo_electrique BOOLEAN DEFAULT NULL, velo_marque VARCHAR(255) DEFAULT NULL, velo_modele VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, commentaire_client TEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE intervention_produit (produit_id INT NOT NULL, intervention_id INT NOT NULL, quantite INT NOT NULL, prix NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(produit_id, intervention_id))');
        $this->addSql('CREATE INDEX IDX_624B9842F347EFB ON intervention_produit (produit_id)');
        $this->addSql('CREATE INDEX IDX_624B98428EAE3863 ON intervention_produit (intervention_id)');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, designation VARCHAR(255) NOT NULL, prix NUMERIC(10, 2) DEFAULT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN produit.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('ALTER TABLE intervention_produit ADD CONSTRAINT FK_624B9842F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention_produit ADD CONSTRAINT FK_624B98428EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE intervention_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE intervention_produit DROP CONSTRAINT FK_624B9842F347EFB');
        $this->addSql('ALTER TABLE intervention_produit DROP CONSTRAINT FK_624B98428EAE3863');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE intervention_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE "user"');
    }
}
