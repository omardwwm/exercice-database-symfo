<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204153836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel ADD chef_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE150A48F1 FOREIGN KEY (chef_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DEA4AEAFEA ON personnel (entreprise_id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DE150A48F1 ON personnel (chef_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA4AEAFEA');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE150A48F1');
        $this->addSql('DROP INDEX IDX_A6BCF3DEA4AEAFEA ON personnel');
        $this->addSql('DROP INDEX IDX_A6BCF3DE150A48F1 ON personnel');
        $this->addSql('ALTER TABLE personnel DROP chef_id');
    }
}
