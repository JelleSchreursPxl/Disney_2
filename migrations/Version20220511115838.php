<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511115838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE director CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE director director VARCHAR(19) DEFAULT NULL');
        $this->addSql('ALTER TABLE disney_char CHANGE disney_movie_id disney_movie_id INT AUTO_INCREMENT NOT NULL, CHANGE movie_title movie_title VARCHAR(38) DEFAULT NULL, CHANGE release_date release_date VARCHAR(10) DEFAULT NULL, CHANGE hero hero VARCHAR(26) DEFAULT NULL, CHANGE villian villian VARCHAR(36) DEFAULT NULL, CHANGE song song VARCHAR(34) DEFAULT NULL');
        $this->addSql('ALTER TABLE movie_gross CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE movie_title movie_title VARCHAR(40) DEFAULT NULL, CHANGE release_date release_date VARCHAR(10) DEFAULT NULL, CHANGE genre genre VARCHAR(19) DEFAULT NULL, CHANGE mpaa_rating mpaa_rating VARCHAR(9) DEFAULT NULL');
        $this->addSql('ALTER TABLE voice_actor CHANGE character_id character_id INT AUTO_INCREMENT NOT NULL, CHANGE character_name character_name VARCHAR(31) DEFAULT NULL, CHANGE voice_actor voice_actor VARCHAR(34) DEFAULT NULL, CHANGE movie_title movie_title VARCHAR(45) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE director CHANGE id id INT NOT NULL, CHANGE director director VARCHAR(19) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE disney_char CHANGE disney_movie_id disney_movie_id INT NOT NULL, CHANGE movie_title movie_title VARCHAR(38) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE release_date release_date VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE hero hero VARCHAR(26) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE villian villian VARCHAR(36) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE song song VARCHAR(34) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE movie_gross CHANGE id id INT NOT NULL, CHANGE movie_title movie_title VARCHAR(40) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE release_date release_date VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE genre genre VARCHAR(19) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE mpaa_rating mpaa_rating VARCHAR(9) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE voice_actor CHANGE character_id character_id INT NOT NULL, CHANGE character_name character_name VARCHAR(31) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE voice_actor voice_actor VARCHAR(34) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE movie_title movie_title VARCHAR(45) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
    }
}
