<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705134302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_abonnement (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_abonneÃÃment DATETIME DEFAULT NULL, client VARCHAR(255) DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_ADD0445DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lignes_commande_abonnement (id INT AUTO_INCREMENT NOT NULL, aboÃÃnnement_id INT DEFAULT NULL, commande_abonneÃÃment_id INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, quantite INT DEFAULT NULL, dure VARCHAR(255) DEFAULT NULL, INDEX IDX_9E615BD05DD408B1 (aboÃÃnnement_id), INDEX IDX_9E615BD0668E5A8A (commande_abonneÃÃment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_abonnement ADD CONSTRAINT FK_ADD0445DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD CONSTRAINT FK_9E615BD05DD408B1 FOREIGN KEY (aboÃÃnnement_id) REFERENCES details_abonnement (id)');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD CONSTRAINT FK_9E615BD0668E5A8A FOREIGN KEY (commande_abonneÃÃment_id) REFERENCES commande_abonnement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lignes_commande_abonnement DROP FOREIGN KEY FK_9E615BD0668E5A8A');
        $this->addSql('DROP TABLE commande_abonnement');
        $this->addSql('DROP TABLE lignes_commande_abonnement');
    }
}
