<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250621224047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room DROP FOREIGN KEY FK_64A69CF354177093
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room DROP FOREIGN KEY FK_64A69CF3B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation_room
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD room_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES room (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation_room (reservation_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_64A69CF3B83297E7 (reservation_id), INDEX IDX_64A69CF354177093 (room_id), PRIMARY KEY(reservation_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room ADD CONSTRAINT FK_64A69CF354177093 FOREIGN KEY (room_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_room ADD CONSTRAINT FK_64A69CF3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495554177093
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_42C8495554177093 ON reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP room_id
        SQL);
    }
}
