<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916141925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention_produit ADD prix NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE produits ALTER prix TYPE NUMERIC(10, 2)');
        $this->addSql('ALTER TABLE produits ALTER prix DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE produits ALTER prix TYPE INT');
        $this->addSql('ALTER TABLE produits ALTER prix SET NOT NULL');
        $this->addSql('ALTER TABLE intervention_produit DROP prix');
    }
}
