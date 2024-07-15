<?php

declare(strict_types=1);

namespace trash\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240714134837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professors ADD middle_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE name first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE students ADD middle_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE name first_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students ADD name VARCHAR(255) NOT NULL, DROP first_name, DROP middle_name, DROP last_name, DROP email');
        $this->addSql('ALTER TABLE professors ADD name VARCHAR(255) NOT NULL, DROP first_name, DROP middle_name, DROP last_name, DROP email, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
