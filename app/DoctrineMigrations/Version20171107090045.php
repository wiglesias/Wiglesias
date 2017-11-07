<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171107090045 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting ADD city_id INT DEFAULT NULL, DROP city, DROP province, DROP postal_code, CHANGE identity_card identity_card VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B8988BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_9F74B8988BAC62AF ON setting (city_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B8988BAC62AF');
        $this->addSql('DROP INDEX IDX_9F74B8988BAC62AF ON setting');
        $this->addSql('ALTER TABLE setting ADD city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD province VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD postal_code VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP city_id, CHANGE identity_card identity_card VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
