<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210514035557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office_address DROP FOREIGN KEY FK_79120CC38BAC62AF');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D38BAC62AF');
        $this->addSql('ALTER TABLE right_experience DROP FOREIGN KEY FK_17C19965443707B0');
        $this->addSql('ALTER TABLE services_provided DROP FOREIGN KEY FK_45205AB9443707B0');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3443707B0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64910405986');
        $this->addSql('ALTER TABLE subscription_right_experience DROP FOREIGN KEY FK_6481ACE164BD0F99');
        $this->addSql('ALTER TABLE subscription_services_provided DROP FOREIGN KEY FK_AF865DB5D7F495FC');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02345D83CC1');
        $this->addSql('ALTER TABLE institution DROP FOREIGN KEY FK_3A9F98E55D83CC1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A84AC5AC');
        $this->addSql('ALTER TABLE subscription_right_experience DROP FOREIGN KEY FK_6481ACE19A1887DC');
        $this->addSql('ALTER TABLE subscription_services_provided DROP FOREIGN KEY FK_AF865DB59A1887DC');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3A76ED395');
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF7A76ED395');
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, task VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE institution');
        $this->addSql('DROP TABLE office_address');
        $this->addSql('DROP TABLE right_experience');
        $this->addSql('DROP TABLE services_provided');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE subscription_right_experience');
        $this->addSql('DROP TABLE subscription_services_provided');
        $this->addSql('DROP TABLE testimonial');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cep INT NOT NULL, INDEX IDX_2D5B02345D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE institution (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, initial VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3A9F98E55D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE office_address (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_79120CC38BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE right_experience (id INT AUTO_INCREMENT NOT NULL, field_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_17C19965443707B0 (field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE services_provided (id INT AUTO_INCREMENT NOT NULL, field_id INT NOT NULL, service VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_45205AB9443707B0 (field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, uf VARCHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, field_id INT NOT NULL, city_id INT NOT NULL, type TINYINT(1) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_A3C664D3443707B0 (field_id), INDEX IDX_A3C664D3A76ED395 (user_id), INDEX IDX_A3C664D38BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE subscription_right_experience (subscription_id INT NOT NULL, right_experience_id INT NOT NULL, INDEX IDX_6481ACE19A1887DC (subscription_id), INDEX IDX_6481ACE164BD0F99 (right_experience_id), PRIMARY KEY(subscription_id, right_experience_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE subscription_services_provided (subscription_id INT NOT NULL, services_provided_id INT NOT NULL, INDEX IDX_AF865DB59A1887DC (subscription_id), INDEX IDX_AF865DB5D7F495FC (services_provided_id), PRIMARY KEY(subscription_id, services_provided_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE testimonial (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, comment LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E6BDCDF7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, oab_state_id INT NOT NULL, institution_id INT DEFAULT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, surname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, whatsapp INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, oab_number INT NOT NULL, INDEX IDX_8D93D649A84AC5AC (oab_state_id), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64910405986 (institution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02345D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE institution ADD CONSTRAINT FK_3A9F98E55D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE office_address ADD CONSTRAINT FK_79120CC38BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE right_experience ADD CONSTRAINT FK_17C19965443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE services_provided ADD CONSTRAINT FK_45205AB9443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D38BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subscription_right_experience ADD CONSTRAINT FK_6481ACE164BD0F99 FOREIGN KEY (right_experience_id) REFERENCES right_experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_right_experience ADD CONSTRAINT FK_6481ACE19A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_services_provided ADD CONSTRAINT FK_AF865DB59A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_services_provided ADD CONSTRAINT FK_AF865DB5D7F495FC FOREIGN KEY (services_provided_id) REFERENCES services_provided (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64910405986 FOREIGN KEY (institution_id) REFERENCES institution (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A84AC5AC FOREIGN KEY (oab_state_id) REFERENCES state (id)');
        $this->addSql('DROP TABLE todo');
    }
}
