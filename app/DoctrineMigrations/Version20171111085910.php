<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171111085910 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, swift_code VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, removed_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE setting ADD bank_id INT DEFAULT NULL, CHANGE identity_card identity_card VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B89811C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('CREATE INDEX IDX_9F74B89811C8FB41 ON setting (bank_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B89811C8FB41');
        $this->addSql('DROP TABLE bank');
        $this->addSql('DROP INDEX IDX_9F74B89811C8FB41 ON setting');
        $this->addSql('ALTER TABLE setting DROP bank_id, CHANGE identity_card identity_card VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
