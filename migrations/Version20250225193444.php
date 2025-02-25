<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250225193444 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE guest (id SERIAL NOT NULL, will_attend BOOLEAN DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, will_attend_main_ceremony BOOLEAN DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE guest');
    }
}
