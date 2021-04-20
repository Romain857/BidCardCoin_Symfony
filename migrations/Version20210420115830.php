<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420115830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE encherir (id INT AUTO_INCREMENT NOT NULL, prix_propose DOUBLE PRECISION NOT NULL, heure DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encherir_acheteur (encherir_id INT NOT NULL, acheteur_id INT NOT NULL, INDEX IDX_41ABAAFBB0BA17BB (encherir_id), INDEX IDX_41ABAAFB96A7BB5F (acheteur_id), PRIMARY KEY(encherir_id, acheteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encherir_lot (encherir_id INT NOT NULL, lot_id INT NOT NULL, INDEX IDX_3C56919BB0BA17BB (encherir_id), INDEX IDX_3C56919BA8CBA5F7 (lot_id), PRIMARY KEY(encherir_id, lot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE encherir_acheteur ADD CONSTRAINT FK_41ABAAFBB0BA17BB FOREIGN KEY (encherir_id) REFERENCES encherir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE encherir_acheteur ADD CONSTRAINT FK_41ABAAFB96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES acheteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE encherir_lot ADD CONSTRAINT FK_3C56919BB0BA17BB FOREIGN KEY (encherir_id) REFERENCES encherir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE encherir_lot ADD CONSTRAINT FK_3C56919BA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encherir_acheteur DROP FOREIGN KEY FK_41ABAAFBB0BA17BB');
        $this->addSql('ALTER TABLE encherir_lot DROP FOREIGN KEY FK_3C56919BB0BA17BB');
        $this->addSql('DROP TABLE encherir');
        $this->addSql('DROP TABLE encherir_acheteur');
        $this->addSql('DROP TABLE encherir_lot');
    }
}
