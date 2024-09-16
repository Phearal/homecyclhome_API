<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916152732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE intervention_produit_id_seq CASCADE');
        $this->addSql('ALTER TABLE intervention_produit DROP CONSTRAINT intervention_produit_pkey');
        $this->addSql('ALTER TABLE intervention_produit DROP id');
        $this->addSql('ALTER TABLE intervention_produit ADD PRIMARY KEY (produit_id, intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE intervention_produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX intervention_produit_pkey');
        $this->addSql('ALTER TABLE intervention_produit ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE intervention_produit ADD PRIMARY KEY (id)');
    }
}
