<?php

declare(strict_types=1);

namespace trash;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715152639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, college_year JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE faculty');
        $this->addSql('ALTER TABLE professors DROP FOREIGN KEY FK_2274711E680CAB68');
        $this->addSql('DROP INDEX IDX_2274711E680CAB68 ON professors');
        $this->addSql('ALTER TABLE professors CHANGE faculty_id college_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professors ADD CONSTRAINT FK_2274711E770124B2 FOREIGN KEY (college_id) REFERENCES college (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_2274711E770124B2 ON professors (college_id)');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB217966043');
        $this->addSql('DROP INDEX IDX_A4698DB217966043 ON students');
        $this->addSql('ALTER TABLE students CHANGE faculty college INT DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2AADA8702 FOREIGN KEY (college) REFERENCES college (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A4698DB2AADA8702 ON students (college)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE faculty (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, faculty_year JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE college');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2AADA8702');
        $this->addSql('DROP INDEX IDX_A4698DB2AADA8702 ON students');
        $this->addSql('ALTER TABLE students CHANGE college faculty INT DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB217966043 FOREIGN KEY (faculty) REFERENCES faculty (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A4698DB217966043 ON students (faculty)');
        $this->addSql('ALTER TABLE professors DROP FOREIGN KEY FK_2274711E770124B2');
        $this->addSql('DROP INDEX IDX_2274711E770124B2 ON professors');
        $this->addSql('ALTER TABLE professors CHANGE college_id faculty_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professors ADD CONSTRAINT FK_2274711E680CAB68 FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_2274711E680CAB68 ON professors (faculty_id)');
    }
}
