<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013090251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F6B4FB296C6E55B5 ON membre');
        $this->addSql('ALTER TABLE membre DROP mdp, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6B4FB29E7927C74 ON membre (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F6B4FB29E7927C74 ON membre');
        $this->addSql('ALTER TABLE membre ADD mdp VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6B4FB296C6E55B5 ON membre (nom)');
    }
}
