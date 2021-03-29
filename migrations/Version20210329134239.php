<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329134239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX index_time ON observations');
        $this->addSql('ALTER TABLE observations CHANGE a_hum A_hum INT DEFAULT NULL, CHANGE b_hum B_hum INT DEFAULT NULL, CHANGE ext_hum EXT_hum INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE OBSERVATIONS CHANGE A_hum a_hum TINYINT(1) DEFAULT NULL, CHANGE B_hum b_hum TINYINT(1) DEFAULT NULL, CHANGE EXT_hum ext_hum TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX index_time ON OBSERVATIONS (time)');
    }
}
