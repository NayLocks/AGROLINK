<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316100722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qagt_users ADD company_active_id INT');
        $this->addSql('ALTER TABLE qagt_users ADD CONSTRAINT FK_5C69A67B14D80837 FOREIGN KEY (company_active_id) REFERENCES qagt_companies (id)');
        $this->addSql('CREATE INDEX IDX_5C69A67B14D80837 ON qagt_users (company_active_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('ALTER TABLE qagt_users DROP CONSTRAINT FK_5C69A67B14D80837');
        $this->addSql('DROP INDEX IDX_5C69A67B14D80837 ON qagt_users');
        $this->addSql('ALTER TABLE qagt_users DROP COLUMN company_active_id');
    }
}
