<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214145904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reseau (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY fk_password_user');
        $this->addSql('DROP INDEX fk_password_user ON reset_password_request');
        $this->addSql('ALTER TABLE reset_password_request ADD requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP selector, DROP expiresAt, DROP hashedToken, CHANGE user user_id INT NOT NULL');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, auteur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contenu LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_67F068BC4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE reseau');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE categorie CHANGE image image VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395 ON reset_password_request');
        $this->addSql('ALTER TABLE reset_password_request ADD selector VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, ADD expiresAt DATETIME NOT NULL, ADD hashedToken VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, DROP requested_at, CHANGE user_id user INT NOT NULL');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT fk_password_user FOREIGN KEY (user) REFERENCES user (id)');
        $this->addSql('CREATE INDEX fk_password_user ON reset_password_request (user)');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles VARCHAR(255) NOT NULL');
    }
}
