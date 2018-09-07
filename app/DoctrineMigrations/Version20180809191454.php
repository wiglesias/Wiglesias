<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180809191454 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting CHANGE identity_card identity_card VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_389B7832B36786B ON tag');
        $this->addSql('ALTER TABLE tag CHANGE title name VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting CHANGE identity_card identity_card VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE tag CHANGE name title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B7832B36786B ON tag (title)');
    }
}
