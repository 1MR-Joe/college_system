<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715165930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, college_year JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE courses (code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, credit_hours INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(code))');
        $this->addSql('CREATE TABLE enrollments (grade INT NOT NULL, semesterCourse VARCHAR(255) NOT NULL, student VARCHAR(255) NOT NULL, PRIMARY KEY(semesterCourse, student))');
        $this->addSql('CREATE TABLE professors (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ssn VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, isAdmin TINYINT(1) NOT NULL, college_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_2274711E7EE6971 (ssn), INDEX IDX_2274711E770124B2 (college_id), PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE semester_course (id VARCHAR(255) NOT NULL, semester VARCHAR(255) NOT NULL, year INT NOT NULL, course VARCHAR(255) NOT NULL, professor VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE students (id VARCHAR(255) NOT NULL, ssn VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, gpa DOUBLE PRECISION NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, admissionYear INT NOT NULL, password VARCHAR(255) NOT NULL, college INT DEFAULT NULL, INDEX IDX_A4698DB2AADA8702 (college), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE professors ADD CONSTRAINT FK_2274711E770124B2 FOREIGN KEY (college_id) REFERENCES college (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2AADA8702 FOREIGN KEY (college) REFERENCES college (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professors DROP FOREIGN KEY FK_2274711E770124B2');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2AADA8702');
        $this->addSql('DROP TABLE college');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE enrollments');
        $this->addSql('DROP TABLE professors');
        $this->addSql('DROP TABLE semester_course');
        $this->addSql('DROP TABLE students');
    }
}
