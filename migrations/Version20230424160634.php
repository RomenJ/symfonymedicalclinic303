<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424160634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diagnostico (id INT AUTO_INCREMENT NOT NULL, paciente_id INT DEFAULT NULL, date DATETIME DEFAULT NULL, notas LONGTEXT DEFAULT NULL, INDEX IDX_9B91D4487310DAD4 (paciente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diagnostico_pato (diagnostico_id INT NOT NULL, pato_id INT NOT NULL, INDEX IDX_67C4D2E77A94BA1A (diagnostico_id), INDEX IDX_67C4D2E744BB6ED2 (pato_id), PRIMARY KEY(diagnostico_id, pato_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paciente (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, dateborn DATE DEFAULT NULL, dni VARCHAR(255) NOT NULL, telefono VARCHAR(255) DEFAULT NULL, direccion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pato (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, codcie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diagnostico ADD CONSTRAINT FK_9B91D4487310DAD4 FOREIGN KEY (paciente_id) REFERENCES paciente (id)');
        $this->addSql('ALTER TABLE diagnostico_pato ADD CONSTRAINT FK_67C4D2E77A94BA1A FOREIGN KEY (diagnostico_id) REFERENCES diagnostico (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diagnostico_pato ADD CONSTRAINT FK_67C4D2E744BB6ED2 FOREIGN KEY (pato_id) REFERENCES pato (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diagnostico DROP FOREIGN KEY FK_9B91D4487310DAD4');
        $this->addSql('ALTER TABLE diagnostico_pato DROP FOREIGN KEY FK_67C4D2E77A94BA1A');
        $this->addSql('ALTER TABLE diagnostico_pato DROP FOREIGN KEY FK_67C4D2E744BB6ED2');
        $this->addSql('DROP TABLE diagnostico');
        $this->addSql('DROP TABLE diagnostico_pato');
        $this->addSql('DROP TABLE paciente');
        $this->addSql('DROP TABLE pato');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
