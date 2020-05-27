<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521155513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours DROP INDEX IDX_FDCA8C9C5200282E, ADD UNIQUE INDEX UNIQ_FDCA8C9C5200282E (formation_id)');
        $this->addSql('ALTER TABLE formation ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_404021BF7ECF78B0 ON formation (cours_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours DROP INDEX UNIQ_FDCA8C9C5200282E, ADD INDEX IDX_FDCA8C9C5200282E (formation_id)');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF7ECF78B0');
        $this->addSql('DROP INDEX UNIQ_404021BF7ECF78B0 ON formation');
        $this->addSql('ALTER TABLE formation DROP cours_id');
    }
}
