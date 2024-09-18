<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240918161101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_intervention (technicien_id INT NOT NULL, intervention_id INT NOT NULL, contenu TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(technicien_id, intervention_id))');
        $this->addSql('CREATE INDEX IDX_224C655213457256 ON commentaire_intervention (technicien_id)');
        $this->addSql('CREATE INDEX IDX_224C65528EAE3863 ON commentaire_intervention (intervention_id)');
        $this->addSql('COMMENT ON COLUMN commentaire_intervention.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE commentaire_intervention ADD CONSTRAINT FK_224C655213457256 FOREIGN KEY (technicien_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire_intervention ADD CONSTRAINT FK_224C65528EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commentaire_intervention DROP CONSTRAINT FK_224C655213457256');
        $this->addSql('ALTER TABLE commentaire_intervention DROP CONSTRAINT FK_224C65528EAE3863');
        $this->addSql('DROP TABLE commentaire_intervention');
    }
}
