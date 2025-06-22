<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250620224620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation_room (reservation_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_64A69CF3B83297E7 (reservation_id), INDEX IDX_64A69CF354177093 (room_id), PRIMARY KEY(reservation_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room ADD CONSTRAINT FK_64A69CF3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room ADD CONSTRAINT FK_64A69CF354177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD from_date DATETIME NOT NULL, ADD to_date DATETIME NOT NULL, ADD guest_name VARCHAR(40) NOT NULL, ADD price24 NUMERIC(10, 0) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room DROP FOREIGN KEY FK_64A69CF3B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room DROP FOREIGN KEY FK_64A69CF354177093
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation_room
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP from_date, DROP to_date, DROP guest_name, DROP price24
        SQL);
    }
}
