<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609184738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists ADD id_style INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE TEXT');
        //$this->addSql('ALTER TABLE artists ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        //$this->addSql('ALTER TABLE artists ALTER updated_at SET NOT NULL');
        //$this->addSql('COMMENT ON COLUMN artists.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE artists DROP id_style');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE JSON');
        //$this->addSql('ALTER TABLE artists ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        //$this->addSql('ALTER TABLE artists ALTER updated_at DROP NOT NULL');
        //$this->addSql('COMMENT ON COLUMN artists.updated_at IS NULL');
    }
}
