<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707165306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_abonnement CHANGE date_abonne??ment date_abonneÃÃment DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lignes_commande_abonnement DROP FOREIGN KEY FK_9E615BD05DD408B1');
        $this->addSql('ALTER TABLE lignes_commande_abonnement DROP FOREIGN KEY FK_9E615BD0668E5A8A');
        $this->addSql('DROP INDEX IDX_9E615BD0668E5A8A ON lignes_commande_abonnement');
        $this->addSql('DROP INDEX IDX_9E615BD05DD408B1 ON lignes_commande_abonnement');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD aboÃÃnnement_id INT DEFAULT NULL, ADD commande_abonneÃÃment_id INT DEFAULT NULL, DROP abo??nnement_id, DROP commande_abonne??ment_id');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD CONSTRAINT FK_9E615BD05DD408B1 FOREIGN KEY (aboÃÃnnement_id) REFERENCES details_abonnement (id)');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD CONSTRAINT FK_9E615BD0668E5A8A FOREIGN KEY (commande_abonneÃÃment_id) REFERENCES commande_abonnement (id)');
        $this->addSql('CREATE INDEX IDX_9E615BD0668E5A8A ON lignes_commande_abonnement (commande_abonneÃÃment_id)');
        $this->addSql('CREATE INDEX IDX_9E615BD05DD408B1 ON lignes_commande_abonnement (aboÃÃnnement_id)');
        $this->addSql('ALTER TABLE produits ADD url_liseuse VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_abonnement CHANGE date_abonneÃÃment date_abonne??ment DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lignes_commande_abonnement DROP FOREIGN KEY FK_9E615BD05DD408B1');
        $this->addSql('ALTER TABLE lignes_commande_abonnement DROP FOREIGN KEY FK_9E615BD0668E5A8A');
        $this->addSql('DROP INDEX IDX_9E615BD05DD408B1 ON lignes_commande_abonnement');
        $this->addSql('DROP INDEX IDX_9E615BD0668E5A8A ON lignes_commande_abonnement');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD abo??nnement_id INT DEFAULT NULL, ADD commande_abonne??ment_id INT DEFAULT NULL, DROP aboÃÃnnement_id, DROP commande_abonneÃÃment_id');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD CONSTRAINT FK_9E615BD05DD408B1 FOREIGN KEY (abo??nnement_id) REFERENCES details_abonnement (id)');
        $this->addSql('ALTER TABLE lignes_commande_abonnement ADD CONSTRAINT FK_9E615BD0668E5A8A FOREIGN KEY (commande_abonne??ment_id) REFERENCES commande_abonnement (id)');
        $this->addSql('CREATE INDEX IDX_9E615BD05DD408B1 ON lignes_commande_abonnement (abo??nnement_id)');
        $this->addSql('CREATE INDEX IDX_9E615BD0668E5A8A ON lignes_commande_abonnement (commande_abonne??ment_id)');
        $this->addSql('ALTER TABLE produits DROP url_liseuse');
    }
}
