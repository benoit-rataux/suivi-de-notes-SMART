<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241115182430 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }
    
    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE school_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD school_class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3314463F54 FOREIGN KEY (school_class_id) REFERENCES school_class (id)');
        $this->addSql('CREATE INDEX IDX_B723AF3314463F54 ON student (school_class_id)');
    }
    
    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3314463F54');
        $this->addSql('DROP TABLE school_class');
        $this->addSql('DROP INDEX IDX_B723AF3314463F54 ON student');
        $this->addSql('ALTER TABLE student DROP school_class_id');
    }
}
