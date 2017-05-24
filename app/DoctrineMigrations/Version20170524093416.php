<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170524093416 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE portafolio_portfolio_category (portafolio_id INT NOT NULL, portfolio_category_id INT NOT NULL, INDEX IDX_B375992D87992612 (portafolio_id), INDEX IDX_B375992DAC7FAB36 (portfolio_category_id), PRIMARY KEY(portafolio_id, portfolio_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_category (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, removed_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7AC643592B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portafolio_portfolio_category ADD CONSTRAINT FK_B375992D87992612 FOREIGN KEY (portafolio_id) REFERENCES portafolio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portafolio_portfolio_category ADD CONSTRAINT FK_B375992DAC7FAB36 FOREIGN KEY (portfolio_category_id) REFERENCES portfolio_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portafolio ADD short_description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE setting CHANGE identity_card identity_card VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portafolio_portfolio_category DROP FOREIGN KEY FK_B375992DAC7FAB36');
        $this->addSql('DROP TABLE portafolio_portfolio_category');
        $this->addSql('DROP TABLE portfolio_category');
        $this->addSql('ALTER TABLE portafolio DROP short_description');
        $this->addSql('ALTER TABLE setting CHANGE identity_card identity_card VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
