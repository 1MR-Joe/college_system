<?php

declare(strict_types=1);

namespace trash\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627170856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professors ADD password VARCHAR(255) NOT NULL, ADD isAdmin TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE students ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students DROP password');
        $this->addSql('ALTER TABLE professors DROP password, DROP isAdmin');
    }
}
