<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250227191955 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE drink (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE guest_drink (guest_id INT NOT NULL, drink_id INT NOT NULL, PRIMARY KEY(guest_id, drink_id))');
        $this->addSql('CREATE INDEX IDX_1840D7C59A4AA658 ON guest_drink (guest_id)');
        $this->addSql('CREATE INDEX IDX_1840D7C536AA4BB4 ON guest_drink (drink_id)');
        $this->addSql('ALTER TABLE guest_drink ADD CONSTRAINT FK_1840D7C59A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE guest_drink ADD CONSTRAINT FK_1840D7C536AA4BB4 FOREIGN KEY (drink_id) REFERENCES drink (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE guest_drink DROP CONSTRAINT FK_1840D7C59A4AA658');
        $this->addSql('ALTER TABLE guest_drink DROP CONSTRAINT FK_1840D7C536AA4BB4');
        $this->addSql('DROP TABLE drink');
        $this->addSql('DROP TABLE guest_drink');
    }
}