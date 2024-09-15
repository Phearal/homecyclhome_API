<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240912175813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE intervention_produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE intervention_produit (id INT NOT NULL, produit_id INT NOT NULL, intervention_id INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_624B9842F347EFB ON intervention_produit (produit_id)');
        $this->addSql('CREATE INDEX IDX_624B98428EAE3863 ON intervention_produit (intervention_id)');
        $this->addSql('ALTER TABLE intervention_produit ADD CONSTRAINT FK_624B9842F347EFB FOREIGN KEY (produit_id) REFERENCES produits (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention_produit ADD CONSTRAINT FK_624B98428EAE3863 FOREIGN KEY (intervention_id) REFERENCES interventions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE interventions_produits DROP CONSTRAINT fk_8a6e189b334423ff');
        $this->addSql('ALTER TABLE interventions_produits DROP CONSTRAINT fk_8a6e189bcd11a2cf');
        $this->addSql('DROP TABLE interventions_produits');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE intervention_produit_id_seq CASCADE');
        $this->addSql('CREATE TABLE interventions_produits (interventions_id INT NOT NULL, produits_id INT NOT NULL, PRIMARY KEY(interventions_id, produits_id))');
        $this->addSql('CREATE INDEX idx_8a6e189bcd11a2cf ON interventions_produits (produits_id)');
        $this->addSql('CREATE INDEX idx_8a6e189b334423ff ON interventions_produits (interventions_id)');
        $this->addSql('ALTER TABLE interventions_produits ADD CONSTRAINT fk_8a6e189b334423ff FOREIGN KEY (interventions_id) REFERENCES interventions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE interventions_produits ADD CONSTRAINT fk_8a6e189bcd11a2cf FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention_produit DROP CONSTRAINT FK_624B9842F347EFB');
        $this->addSql('ALTER TABLE intervention_produit DROP CONSTRAINT FK_624B98428EAE3863');
        $this->addSql('DROP TABLE intervention_produit');
    }
}
