<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706190459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE style_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE style (id INT NOT NULL, style VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE artists ADD style_id INT NOT NULL');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801EBACD6074 FOREIGN KEY (style_id) REFERENCES style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68D3801EBACD6074 ON artists (style_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE artists DROP CONSTRAINT FK_68D3801EBACD6074');
        $this->addSql('DROP SEQUENCE style_id_seq CASCADE');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP INDEX IDX_68D3801EBACD6074');
        $this->addSql('ALTER TABLE artists DROP style_id');
    }
}
