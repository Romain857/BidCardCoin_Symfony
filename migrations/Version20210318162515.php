<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318162515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acheteur (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, solde DOUBLE PRECISION NOT NULL, is_solvable TINYINT(1) NOT NULL, identite VARCHAR(50) NOT NULL, moyen_paiement VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_304AFF9DBA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, enchere_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, numero_tel INT NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, age INT NOT NULL, INDEX IDX_880E0D76E80B6EFB (enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (categorie_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_76264285BCF5E72D (categorie_id), INDEX IDX_76264285F347EFB (produit_id), PRIMARY KEY(categorie_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, heure VARCHAR(50) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimation (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT DEFAULT NULL, id_admin_id INT NOT NULL, estimation DOUBLE PRECISION NOT NULL, date_estimation DATE NOT NULL, INDEX IDX_D0527024AABEFE2C (id_produit_id), INDEX IDX_D052702434F06E85 (id_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, enchere_id INT NOT NULL, ville VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, departement VARCHAR(50) NOT NULL, INDEX IDX_2F577D59642B8210 (admin_id), INDEX IDX_2F577D59E80B6EFB (enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (id INT AUTO_INCREMENT NOT NULL, id_enchere_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(50) NOT NULL, INDEX IDX_B81291B4D81EE2C (id_enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_achat (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, id_acheteur_id INT NOT NULL, id_enchere_id INT NOT NULL, montant_max DOUBLE PRECISION NOT NULL, adresse_depot VARCHAR(50) NOT NULL, INDEX IDX_71306AD9AABEFE2C (id_produit_id), INDEX IDX_71306AD98EB576A8 (id_acheteur_id), INDEX IDX_71306AD94D81EE2C (id_enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, mail VARCHAR(45) NOT NULL, numero_tel INT NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, photo VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_lot_id INT NOT NULL, id_photo_id INT DEFAULT NULL, id_acheteur_id INT DEFAULT NULL, id_vendeur_id INT NOT NULL, estimation_actuelle DOUBLE PRECISION NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(50) NOT NULL, artiste VARCHAR(50) NOT NULL, style VARCHAR(50) NOT NULL, date_vente DATE NOT NULL, INDEX IDX_29A5EC278EFC101A (id_lot_id), UNIQUE INDEX UNIQ_29A5EC272E45A019 (id_photo_id), INDEX IDX_29A5EC278EB576A8 (id_acheteur_id), INDEX IDX_29A5EC2720068689 (id_vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_categorie (produit_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_CDEA88D8F347EFB (produit_id), INDEX IDX_CDEA88D8BCF5E72D (categorie_id), PRIMARY KEY(produit_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, UNIQUE INDEX UNIQ_7AF49996BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acheteur ADD CONSTRAINT FK_304AFF9DBA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76E80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D052702434F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59E80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B4D81EE2C FOREIGN KEY (id_enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD98EB576A8 FOREIGN KEY (id_acheteur_id) REFERENCES acheteur (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD94D81EE2C FOREIGN KEY (id_enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278EFC101A FOREIGN KEY (id_lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC272E45A019 FOREIGN KEY (id_photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278EB576A8 FOREIGN KEY (id_acheteur_id) REFERENCES acheteur (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2720068689 FOREIGN KEY (id_vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('ALTER TABLE produit_categorie ADD CONSTRAINT FK_CDEA88D8F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_categorie ADD CONSTRAINT FK_CDEA88D8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vendeur ADD CONSTRAINT FK_7AF49996BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD98EB576A8');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278EB576A8');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D052702434F06E85');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59642B8210');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285BCF5E72D');
        $this->addSql('ALTER TABLE produit_categorie DROP FOREIGN KEY FK_CDEA88D8BCF5E72D');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76E80B6EFB');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59E80B6EFB');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B4D81EE2C');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD94D81EE2C');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278EFC101A');
        $this->addSql('ALTER TABLE acheteur DROP FOREIGN KEY FK_304AFF9DBA091CE5');
        $this->addSql('ALTER TABLE vendeur DROP FOREIGN KEY FK_7AF49996BA091CE5');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC272E45A019');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285F347EFB');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024AABEFE2C');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9AABEFE2C');
        $this->addSql('ALTER TABLE produit_categorie DROP FOREIGN KEY FK_CDEA88D8F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2720068689');
        $this->addSql('DROP TABLE acheteur');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE estimation');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE ordre_achat');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_categorie');
        $this->addSql('DROP TABLE vendeur');
    }
}
