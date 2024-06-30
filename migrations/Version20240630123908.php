<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240630123908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON enrollments');
        $this->addSql('ALTER TABLE enrollments ADD student VARCHAR(255) NOT NULL, DROP semesterCourseId, CHANGE studentId semesterCourse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE enrollments ADD PRIMARY KEY (semesterCourse, student)');
        $this->addSql('ALTER TABLE semester_course ADD course VARCHAR(255) NOT NULL, ADD professor VARCHAR(255) NOT NULL, DROP courseCode, DROP professorSsn');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2680CAB68');
        $this->addSql('DROP INDEX IDX_A4698DB2680CAB68 ON students');
        $this->addSql('ALTER TABLE students CHANGE faculty_id faculty INT DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB217966043 FOREIGN KEY (faculty) REFERENCES faculty (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A4698DB217966043 ON students (faculty)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB217966043');
        $this->addSql('DROP INDEX IDX_A4698DB217966043 ON students');
        $this->addSql('ALTER TABLE students CHANGE faculty faculty_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2680CAB68 FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A4698DB2680CAB68 ON students (faculty_id)');
        $this->addSql('ALTER TABLE semester_course ADD courseCode VARCHAR(255) NOT NULL, ADD professorSsn VARCHAR(255) NOT NULL, DROP course, DROP professor');
        $this->addSql('DROP INDEX `PRIMARY` ON enrollments');
        $this->addSql('ALTER TABLE enrollments ADD semesterCourseId INT NOT NULL, ADD studentId VARCHAR(255) NOT NULL, DROP semesterCourse, DROP student');
        $this->addSql('ALTER TABLE enrollments ADD PRIMARY KEY (semesterCourseId, studentId)');
    }
}
