<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628192436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE INT');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles SET NOT NULL');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801E434C7E FOREIGN KEY (id_music_styles) REFERENCES music_styles (id_music_styles) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68D3801E434C7E ON artists (id_music_styles)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE artists DROP CONSTRAINT FK_68D3801E434C7E');
        $this->addSql('DROP INDEX IDX_68D3801E434C7E');
        $this->addSql('ALTER TABLE artists ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE JSON');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles DROP NOT NULL');
    }
}
