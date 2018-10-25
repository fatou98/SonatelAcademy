<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181024210857 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, prenom VARCHAR(100) NOT NULL, nom VARCHAR(60) NOT NULL, dateofbirth DATETIME DEFAULT NULL, lieunaissance VARCHAR(100) DEFAULT NULL, image LONGBLOB DEFAULT NULL, numpiece BIGINT DEFAULT NULL, mobile_number INT DEFAULT NULL, fix_number INT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, email VARCHAR(200) DEFAULT NULL, INDEX IDX_717E22E3180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, prenom VARCHAR(150) NOT NULL, nom VARCHAR(100) NOT NULL, numpiece BIGINT NOT NULL, adresse VARCHAR(255) NOT NULL, tel BIGINT NOT NULL, password VARCHAR(64) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', image LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649289172D6 (numpiece), UNIQUE INDEX UNIQ_8D93D649F037AB0F (tel), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3180AA129');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE user');
    }
}
