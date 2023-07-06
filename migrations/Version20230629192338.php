<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629192338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE music_styles_id_music_styles_seq CASCADE');
        $this->addSql('CREATE SEQUENCE music_styles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE artists DROP CONSTRAINT fk_68d3801e434c7e');
        $this->addSql('DROP INDEX idx_68d3801e434c7e');
        $this->addSql('ALTER TABLE artists ADD music_styles_id INT NULL');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE TEXT');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles DROP NOT NULL');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801E626953C1 FOREIGN KEY (music_styles_id) REFERENCES music_styles (id_music_styles) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68D3801E626953C1 ON artists (music_styles_id)');
       // $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE music_styles RENAME COLUMN id_music_styles TO id');
        //$this->addSql('ALTER TABLE music_styles ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE music_styles_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE music_styles_id_music_styles_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE artists DROP CONSTRAINT FK_68D3801E626953C1');
        $this->addSql('DROP INDEX IDX_68D3801E626953C1');
        $this->addSql('ALTER TABLE artists DROP music_styles_id');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE JSON');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles SET NOT NULL');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT fk_68d3801e434c7e FOREIGN KEY (id_music_styles) REFERENCES music_styles (id_music_styles) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_68d3801e434c7e ON artists (id_music_styles)');
        $this->addSql('DROP INDEX music_styles_pkey');
        $this->addSql('ALTER TABLE music_styles RENAME COLUMN id TO id_music_styles');
        $this->addSql('ALTER TABLE music_styles ADD PRIMARY KEY (id_music_styles)');
    }
}
