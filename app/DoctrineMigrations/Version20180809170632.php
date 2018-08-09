<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180809170632 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bank DROP removed_at');
        $this->addSql('ALTER TABLE city DROP removed_at');
        $this->addSql('ALTER TABLE contact_message DROP removed_at');
        $this->addSql('ALTER TABLE customer DROP removed_at');
        $this->addSql('ALTER TABLE invoice DROP removed_at');
        $this->addSql('ALTER TABLE invoice_line DROP removed_at');
        $this->addSql('ALTER TABLE portafolio DROP removed_at');
        $this->addSql('ALTER TABLE portfolio_category DROP removed_at');
        $this->addSql('ALTER TABLE post DROP removed_at');
        $this->addSql('ALTER TABLE province DROP removed_at');
        $this->addSql('ALTER TABLE setting DROP removed_at, CHANGE identity_card identity_card VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tag DROP removed_at');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bank ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_message ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice_line ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE portafolio ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE portfolio_category ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE province ADD removed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE setting ADD removed_at DATETIME DEFAULT NULL, CHANGE identity_card identity_card VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE tag ADD removed_at DATETIME DEFAULT NULL');
    }
}
