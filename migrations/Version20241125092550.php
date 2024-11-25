<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125092550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BA5AE01DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, joli_dessin_id INT DEFAULT NULL, blog_post_id INT DEFAULT NULL, auteur VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_67F068BCF765356F (joli_dessin_id), INDEX IDX_67F068BCA77FBEAF (blog_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, subject VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joli_dessin (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, hauteur DOUBLE PRECISION NOT NULL, largeur DOUBLE PRECISION NOT NULL, vente TINYINT(1) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, crea_date DATETIME NOT NULL, mel_date DATETIME NOT NULL, description LONGTEXT NOT NULL, portfolio TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_AAC18068A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joli_dessin_categorie (joli_dessin_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_F553F86BF765356F (joli_dessin_id), INDEX IDX_F553F86BBCF5E72D (categorie_id), PRIMARY KEY(joli_dessin_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, about LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_info (id INT AUTO_INCREMENT NOT NULL, relation_id INT NOT NULL, direction VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, town VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, tiktok VARCHAR(255) DEFAULT NULL, snapchat VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, pinterest VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B1087D9E3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF765356F FOREIGN KEY (joli_dessin_id) REFERENCES joli_dessin (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id)');
        $this->addSql('ALTER TABLE joli_dessin ADD CONSTRAINT FK_AAC18068A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE joli_dessin_categorie ADD CONSTRAINT FK_F553F86BF765356F FOREIGN KEY (joli_dessin_id) REFERENCES joli_dessin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joli_dessin_categorie ADD CONSTRAINT FK_F553F86BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_info ADD CONSTRAINT FK_B1087D9E3256915B FOREIGN KEY (relation_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01DA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCF765356F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA77FBEAF');
        $this->addSql('ALTER TABLE joli_dessin DROP FOREIGN KEY FK_AAC18068A76ED395');
        $this->addSql('ALTER TABLE joli_dessin_categorie DROP FOREIGN KEY FK_F553F86BF765356F');
        $this->addSql('ALTER TABLE joli_dessin_categorie DROP FOREIGN KEY FK_F553F86BBCF5E72D');
        $this->addSql('ALTER TABLE user_info DROP FOREIGN KEY FK_B1087D9E3256915B');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE joli_dessin');
        $this->addSql('DROP TABLE joli_dessin_categorie');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_info');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
