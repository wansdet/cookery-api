<?php

declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521083510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (country_code VARCHAR(2) NOT NULL, region_code VARCHAR(20) NOT NULL, country_name VARCHAR(255) NOT NULL, sort_order SMALLINT NOT NULL, INDEX IDX_5373C966AEB327AF (region_code), PRIMARY KEY(country_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geo_region (region_code VARCHAR(20) NOT NULL, region_name VARCHAR(20) NOT NULL, sort_order SMALLINT NOT NULL, PRIMARY KEY(region_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, region_code VARCHAR(20) DEFAULT NULL, user_id INT NOT NULL, cooking VARCHAR(4000) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, ingredients VARCHAR(1000) NOT NULL, preparation VARCHAR(4000) DEFAULT NULL, recipe_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', status VARCHAR(20) NOT NULL, title VARCHAR(50) NOT NULL, vegan TINYINT(1) DEFAULT NULL, vegetarian TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_DA88B13759D8A214 (recipe_id), INDEX IDX_DA88B137AEB327AF (region_code), INDEX IDX_DA88B137A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_recipe_category (recipe_id INT NOT NULL, category_code VARCHAR(30) NOT NULL, INDEX IDX_19A8E93359D8A214 (recipe_id), INDEX IDX_19A8E933FC8E4ADF (category_code), PRIMARY KEY(recipe_id, category_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_category (category_code VARCHAR(30) NOT NULL, category_name VARCHAR(30) NOT NULL, PRIMARY KEY(category_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_comment (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, user_id INT DEFAULT NULL, comment VARCHAR(1000) NOT NULL, rating NUMERIC(4, 2) DEFAULT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D8905C2C59D8A214 (recipe_id), INDEX IDX_D8905C2CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_image (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, filename VARCHAR(255) DEFAULT NULL, title VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D32ED04059D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, country_code VARCHAR(2) NOT NULL, age_range VARCHAR(20) NOT NULL, display_name VARCHAR(20) DEFAULT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, middle_name VARCHAR(50) DEFAULT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, sex VARCHAR(10) DEFAULT NULL, status VARCHAR(10) NOT NULL, user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649A76ED395 (user_id), INDEX IDX_8D93D649F026BB7C (country_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966AEB327AF FOREIGN KEY (region_code) REFERENCES geo_region (region_code)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137AEB327AF FOREIGN KEY (region_code) REFERENCES geo_region (region_code)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recipe_recipe_category ADD CONSTRAINT FK_19A8E93359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe_recipe_category ADD CONSTRAINT FK_19A8E933FC8E4ADF FOREIGN KEY (category_code) REFERENCES recipe_category (category_code)');
        $this->addSql('ALTER TABLE recipe_comment ADD CONSTRAINT FK_D8905C2C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe_comment ADD CONSTRAINT FK_D8905C2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recipe_image ADD CONSTRAINT FK_D32ED04059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F026BB7C FOREIGN KEY (country_code) REFERENCES country (country_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966AEB327AF');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137AEB327AF');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137A76ED395');
        $this->addSql('ALTER TABLE recipe_recipe_category DROP FOREIGN KEY FK_19A8E93359D8A214');
        $this->addSql('ALTER TABLE recipe_recipe_category DROP FOREIGN KEY FK_19A8E933FC8E4ADF');
        $this->addSql('ALTER TABLE recipe_comment DROP FOREIGN KEY FK_D8905C2C59D8A214');
        $this->addSql('ALTER TABLE recipe_comment DROP FOREIGN KEY FK_D8905C2CA76ED395');
        $this->addSql('ALTER TABLE recipe_image DROP FOREIGN KEY FK_D32ED04059D8A214');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F026BB7C');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE geo_region');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_recipe_category');
        $this->addSql('DROP TABLE recipe_category');
        $this->addSql('DROP TABLE recipe_comment');
        $this->addSql('DROP TABLE recipe_image');
        $this->addSql('DROP TABLE user');
    }
}
