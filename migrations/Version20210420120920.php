<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420120920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lot ADD estimation_actuelle DOUBLE PRECISION DEFAULT NULL, ADD prix_vente DOUBLE PRECISION DEFAULT NULL, ADD prix_reserve DOUBLE PRECISION DEFAULT NULL, ADD date_estimation DATE DEFAULT NULL, ADD date_vente DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lot DROP estimation_actuelle, DROP prix_vente, DROP prix_reserve, DROP date_estimation, DROP date_vente');
    }
}
