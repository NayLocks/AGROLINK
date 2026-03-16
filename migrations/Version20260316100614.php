<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316100614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qagt_companies DROP CONSTRAINT FK_4BDDEF88D8999E80');
        $this->addSql('DROP INDEX IDX_4BDDEF88D8999E80 ON qagt_companies');
        $this->addSql('ALTER TABLE qagt_companies DROP COLUMN qagt_users_active_id');
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
        $this->addSql('ALTER TABLE qagt_companies ADD qagt_users_active_id INT');
        $this->addSql('ALTER TABLE qagt_companies ADD CONSTRAINT FK_4BDDEF88D8999E80 FOREIGN KEY (qagt_users_active_id) REFERENCES qagt_users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_4BDDEF88D8999E80 ON qagt_companies (qagt_users_active_id)');
    }
}
