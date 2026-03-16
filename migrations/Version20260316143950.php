<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316143950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qagt_companies ADD siret NVARCHAR(14)');
        $this->addSql('ALTER TABLE qagt_companies ADD siren NVARCHAR(9)');
        $this->addSql('ALTER TABLE qagt_companies ADD vat NVARCHAR(13)');
        $this->addSql('ALTER TABLE qagt_users ADD job_function NVARCHAR(100)');
        $this->addSql('ALTER TABLE qagt_users ADD service NVARCHAR(50)');
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
        $this->addSql('ALTER TABLE qagt_companies DROP COLUMN siret');
        $this->addSql('ALTER TABLE qagt_companies DROP COLUMN siren');
        $this->addSql('ALTER TABLE qagt_companies DROP COLUMN vat');
        $this->addSql('ALTER TABLE qagt_users DROP COLUMN job_function');
        $this->addSql('ALTER TABLE qagt_users DROP COLUMN service');
    }
}
