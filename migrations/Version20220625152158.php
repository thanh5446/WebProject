<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625152158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_shoes (orders_id INT NOT NULL, shoes_id INT NOT NULL, INDEX IDX_55652E36CFFE9AD6 (orders_id), INDEX IDX_55652E36B75E1D7A (shoes_id), PRIMARY KEY(orders_id, shoes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_shoes ADD CONSTRAINT FK_55652E36CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_shoes ADD CONSTRAINT FK_55652E36B75E1D7A FOREIGN KEY (shoes_id) REFERENCES shoes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('ALTER TABLE shoes ADD supplier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF81972ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_14CF81972ADD6D8C ON shoes (supplier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE orders_shoes');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('DROP INDEX UNIQ_E52FFDEEA76ED395 ON orders');
        $this->addSql('ALTER TABLE orders DROP user_id');
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF81972ADD6D8C');
        $this->addSql('DROP INDEX IDX_14CF81972ADD6D8C ON shoes');
        $this->addSql('ALTER TABLE shoes DROP supplier_id');
    }
}
