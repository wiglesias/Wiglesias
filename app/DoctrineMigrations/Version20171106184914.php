<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171106184914 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer ADD city_id INT DEFAULT NULL, DROP city, DROP province, DROP postal_code');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_81398E098BAC62AF ON customer (city_id)');
        $this->addSql('ALTER TABLE setting CHANGE identity_card identity_card VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098BAC62AF');
        $this->addSql('DROP INDEX IDX_81398E098BAC62AF ON customer');
        $this->addSql('ALTER TABLE customer ADD city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD province VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD postal_code VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP city_id');
        $this->addSql('ALTER TABLE setting CHANGE identity_card identity_card VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
