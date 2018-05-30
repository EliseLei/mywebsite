<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180530120806 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, nb_single INT NOT NULL, INDEX IDX_D782112D79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_single (playlist_id INT NOT NULL, single_id INT NOT NULL, INDEX IDX_25D12B2A6BBD148 (playlist_id), INDEX IDX_25D12B2AE7C1D92B (single_id), PRIMARY KEY(playlist_id, single_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE single (id INT AUTO_INCREMENT NOT NULL, id_album_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, artiste VARCHAR(255) NOT NULL, time TIME NOT NULL, INDEX IDX_CAA7271941EC475A (id_album_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, artiste VARCHAR(255) NOT NULL, nb_single INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE playlist_single ADD CONSTRAINT FK_25D12B2A6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_single ADD CONSTRAINT FK_25D12B2AE7C1D92B FOREIGN KEY (single_id) REFERENCES single (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE single ADD CONSTRAINT FK_CAA7271941EC475A FOREIGN KEY (id_album_id) REFERENCES album (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE playlist_single DROP FOREIGN KEY FK_25D12B2A6BBD148');
        $this->addSql('ALTER TABLE playlist_single DROP FOREIGN KEY FK_25D12B2AE7C1D92B');
        $this->addSql('ALTER TABLE single DROP FOREIGN KEY FK_CAA7271941EC475A');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D79F37AE5');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_single');
        $this->addSql('DROP TABLE single');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE user');
    }
}
