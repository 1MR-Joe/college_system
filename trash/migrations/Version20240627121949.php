<?php

declare(strict_types=1);

namespace trash\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627121949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courses (code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, credit_hours INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(code))');
        $this->addSql('CREATE TABLE enrollments (grade INT NOT NULL, semesterCourseId INT NOT NULL, studentId VARCHAR(255) NOT NULL, PRIMARY KEY(semesterCourseId, studentId))');
        $this->addSql('CREATE TABLE faculty (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE professors (ssn VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, faculty_id INT DEFAULT NULL, INDEX IDX_2274711E680CAB68 (faculty_id), PRIMARY KEY(ssn))');
        $this->addSql('CREATE TABLE semester_course (id VARCHAR(255) NOT NULL, semester VARCHAR(255) NOT NULL, year INT NOT NULL, courseCode VARCHAR(255) NOT NULL, professorSsn VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE students (id VARCHAR(255) NOT NULL, ssn VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, gpa NUMERIC(2, 2) NOT NULL, phone VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, admissionYear INT NOT NULL, faculty_id INT DEFAULT NULL, INDEX IDX_A4698DB2680CAB68 (faculty_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE professors ADD CONSTRAINT FK_2274711E680CAB68 FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2680CAB68 FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professors DROP FOREIGN KEY FK_2274711E680CAB68');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2680CAB68');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE enrollments');
        $this->addSql('DROP TABLE faculty');
        $this->addSql('DROP TABLE professors');
        $this->addSql('DROP TABLE semester_course');
        $this->addSql('DROP TABLE students');
    }
}
