<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316100339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE qagt_companies (id INT IDENTITY NOT NULL, company_name NVARCHAR(100) NOT NULL, corporate_name NVARCHAR(100), address1 NVARCHAR(255) NOT NULL, address2 NVARCHAR(255), po_box NVARCHAR(50), postal_code NVARCHAR(10) NOT NULL, city NVARCHAR(255) NOT NULL, is_actived BIT NOT NULL, qagt_users_active_id INT, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_4BDDEF88D8999E80 ON qagt_companies (qagt_users_active_id)');
        $this->addSql('CREATE TABLE qagt_users_qagt_companies (qagt_users_id INT NOT NULL, qagt_companies_id INT NOT NULL, PRIMARY KEY (qagt_users_id, qagt_companies_id))');
        $this->addSql('CREATE INDEX IDX_49CED5E2F2D6804E ON qagt_users_qagt_companies (qagt_users_id)');
        $this->addSql('CREATE INDEX IDX_49CED5E2A8E3CE09 ON qagt_users_qagt_companies (qagt_companies_id)');
        $this->addSql('ALTER TABLE qagt_companies ADD CONSTRAINT FK_4BDDEF88D8999E80 FOREIGN KEY (qagt_users_active_id) REFERENCES qagt_users (id)');
        $this->addSql('ALTER TABLE qagt_users_qagt_companies ADD CONSTRAINT FK_49CED5E2F2D6804E FOREIGN KEY (qagt_users_id) REFERENCES qagt_users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE qagt_users_qagt_companies ADD CONSTRAINT FK_49CED5E2A8E3CE09 FOREIGN KEY (qagt_companies_id) REFERENCES qagt_companies (id) ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE qagt_companies DROP CONSTRAINT FK_4BDDEF88D8999E80');
        $this->addSql('ALTER TABLE qagt_users_qagt_companies DROP CONSTRAINT FK_49CED5E2F2D6804E');
        $this->addSql('ALTER TABLE qagt_users_qagt_companies DROP CONSTRAINT FK_49CED5E2A8E3CE09');
        $this->addSql('DROP TABLE qagt_companies');
        $this->addSql('DROP TABLE qagt_users_qagt_companies');
    }
}
