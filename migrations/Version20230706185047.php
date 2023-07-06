<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706185047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, country VARCHAR(255) NOT NULL, shortname VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE artists ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE artists DROP id_style');
        $this->addSql('ALTER TABLE artists ALTER music_styles_id SET NOT NULL');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE TEXT');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68D3801EF92F3E70 ON artists (country_id)');
        $this->addSql('ALTER TABLE music_styles DROP CONSTRAINT music_styles_fk');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE artists DROP CONSTRAINT FK_68D3801EF92F3E70');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP INDEX IDX_68D3801EF92F3E70');
        $this->addSql('ALTER TABLE artists ADD id_style INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artists DROP country_id');
        $this->addSql('ALTER TABLE artists ALTER music_styles_id DROP NOT NULL');
        $this->addSql('ALTER TABLE artists ALTER id_music_styles TYPE INT');
        $this->addSql('ALTER TABLE music_styles ADD CONSTRAINT music_styles_fk FOREIGN KEY (id) REFERENCES music_styles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
