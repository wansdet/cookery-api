<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use App\Entity\RecipeComment;
use App\Entity\User;
use App\Factory\CountryFactory;
use App\Factory\GeoRegionFactory;
use App\Factory\RecipeCategoryFactory;
use App\Factory\RecipeCommentFactory;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private array $countries = [
        ['countryCode' => 'AF', 'countryName' => 'Afghanistan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'AX', 'countryName' => 'Åland Islands', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'AL', 'countryName' => 'Albania', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'DZ', 'countryName' => 'Algeria', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'AS', 'countryName' => 'American Samoa', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'AD', 'countryName' => 'Andorra', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'AO', 'countryName' => 'Angola', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'AI', 'countryName' => 'Anguilla', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'AQ', 'countryName' => 'Antarctica', 'regionCode' => 'ANTARCTICA'],
        ['countryCode' => 'AG', 'countryName' => 'Antigua and Barbuda', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'AR', 'countryName' => 'Argentina', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'AM', 'countryName' => 'Armenia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'AW', 'countryName' => 'Aruba', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'AU', 'countryName' => 'Australia', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'AT', 'countryName' => 'Austria', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'AZ', 'countryName' => 'Azerbaijan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'BS', 'countryName' => 'Bahamas', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BH', 'countryName' => 'Bahrain', 'regionCode' => 'ASIA'],
        ['countryCode' => 'BD', 'countryName' => 'Bangladesh', 'regionCode' => 'ASIA'],
        ['countryCode' => 'BB', 'countryName' => 'Barbados', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BY', 'countryName' => 'Belarus', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'BE', 'countryName' => 'Belgium', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'BZ', 'countryName' => 'Belize', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BJ', 'countryName' => 'Benin', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'BM', 'countryName' => 'Bermuda', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BT', 'countryName' => 'Bhutan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'BO', 'countryName' => 'Bolivia', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BQ', 'countryName' => 'Bonaire, Sint Eustatius and Saba', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BA', 'countryName' => 'Bosnia and Herzegovina', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'BW', 'countryName' => 'Botswana', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'BV', 'countryName' => 'Bouvet Island', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'BR', 'countryName' => 'Brazil', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'IO', 'countryName' => 'British Indian Ocean Territory', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'BN', 'countryName' => 'Brunei Darussalam', 'regionCode' => 'ASIA'],
        ['countryCode' => 'BG', 'countryName' => 'Bulgaria', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'BF', 'countryName' => 'Burkina Faso', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'BI', 'countryName' => 'Burundi', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'CV', 'countryName' => 'Cabo Verde', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'KH', 'countryName' => 'Cambodia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'CM', 'countryName' => 'Cameroon', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'CA', 'countryName' => 'Canada', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'KY', 'countryName' => 'Cayman Islands', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'CF', 'countryName' => 'Central African Republic', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'TD', 'countryName' => 'Chad', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'CL', 'countryName' => 'Chile', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'CN', 'countryName' => 'China', 'regionCode' => 'ASIA'],
        ['countryCode' => 'CX', 'countryName' => 'Christmas Island', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'CC', 'countryName' => 'Cocos (Keeling) Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'CO', 'countryName' => 'Colombia', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'KM', 'countryName' => 'Comoros', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'CG', 'countryName' => 'Congo', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'CK', 'countryName' => 'Cook Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'CR', 'countryName' => 'Costa Rica', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'CI', 'countryName' => 'Côte d\'Ivoire', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'HR', 'countryName' => 'Croatia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'CU', 'countryName' => 'Cuba', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'CW', 'countryName' => 'Curaçao', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'CY', 'countryName' => 'Cyprus', 'regionCode' => 'ASIA'],
        ['countryCode' => 'CZ', 'countryName' => 'Czechia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'CD', 'countryName' => 'Democratic Republic of the Congo', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'DK', 'countryName' => 'Denmark', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'DJ', 'countryName' => 'Djibouti', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'DM', 'countryName' => 'Dominica', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'DO', 'countryName' => 'Dominican Republic', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'EC', 'countryName' => 'Ecuador', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'EG', 'countryName' => 'Egypt', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'SV', 'countryName' => 'El Salvador', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'GQ', 'countryName' => 'Equatorial Guinea', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'ER', 'countryName' => 'Eritrea', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'EE', 'countryName' => 'Estonia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'SZ', 'countryName' => 'Eswatini', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'ET', 'countryName' => 'Ethiopia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'FK', 'countryName' => 'Falkland Islands', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'FO', 'countryName' => 'Faroe Islands', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'FJ', 'countryName' => 'Fiji', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'FI', 'countryName' => 'Finland', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'FR', 'countryName' => 'France', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'GF', 'countryName' => 'French Guiana', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'PF', 'countryName' => 'French Polynesia', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'TF', 'countryName' => 'French Southern Territories', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GA', 'countryName' => 'Gabon', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GM', 'countryName' => 'Gambia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GE', 'countryName' => 'Georgia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'DE', 'countryName' => 'Germany', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'GH', 'countryName' => 'Ghana', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GI', 'countryName' => 'Gibraltar', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'GR', 'countryName' => 'Greece', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'GL', 'countryName' => 'Greenland', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'GD', 'countryName' => 'Grenada', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'GP', 'countryName' => 'Guadeloupe', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'GU', 'countryName' => 'Guam', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'GT', 'countryName' => 'Guatemala', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'GG', 'countryName' => 'Guernsey', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'GN', 'countryName' => 'Guinea', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GW', 'countryName' => 'Guinea-Bissau', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GY', 'countryName' => 'Guyana', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'HT', 'countryName' => 'Haiti', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'HM', 'countryName' => 'Heard Island and McDonald Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'VA', 'countryName' => 'Holy See', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'HN', 'countryName' => 'Honduras', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'HK', 'countryName' => 'Hong Kong', 'regionCode' => 'ASIA'],
        ['countryCode' => 'HU', 'countryName' => 'Hungary', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'IS', 'countryName' => 'Iceland', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'IN', 'countryName' => 'India', 'regionCode' => 'ASIA'],
        ['countryCode' => 'ID', 'countryName' => 'Indonesia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'IR', 'countryName' => 'Iran', 'regionCode' => 'ASIA'],
        ['countryCode' => 'IQ', 'countryName' => 'Iraq', 'regionCode' => 'ASIA'],
        ['countryCode' => 'IE', 'countryName' => 'Ireland', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'IM', 'countryName' => 'Isle of Man', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'IL', 'countryName' => 'Israel', 'regionCode' => 'ASIA'],
        ['countryCode' => 'IT', 'countryName' => 'Italy', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'JM', 'countryName' => 'Jamaica', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'JP', 'countryName' => 'Japan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'JE', 'countryName' => 'Jersey', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'JO', 'countryName' => 'Jordan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'KZ', 'countryName' => 'Kazakhstan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'KE', 'countryName' => 'Kenya', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'KI', 'countryName' => 'Kiribati', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'KW', 'countryName' => 'Kuwait', 'regionCode' => 'ASIA'],
        ['countryCode' => 'KG', 'countryName' => 'Kyrgyzstan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'LA', 'countryName' => 'Lao People\'s Democratic Republic', 'regionCode' => 'ASIA'],
        ['countryCode' => 'LV', 'countryName' => 'Latvia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'LB', 'countryName' => 'Lebanon', 'regionCode' => 'ASIA'],
        ['countryCode' => 'LS', 'countryName' => 'Lesotho', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'LR', 'countryName' => 'Liberia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'LY', 'countryName' => 'Libya', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'LI', 'countryName' => 'Liechtenstein', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'LT', 'countryName' => 'Lithuania', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'LU', 'countryName' => 'Luxembourg', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'MO', 'countryName' => 'Macao', 'regionCode' => 'ASIA'],
        ['countryCode' => 'MG', 'countryName' => 'Madagascar', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MW', 'countryName' => 'Malawi', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MY', 'countryName' => 'Malaysia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'MV', 'countryName' => 'Maldives', 'regionCode' => 'ASIA'],
        ['countryCode' => 'ML', 'countryName' => 'Mali', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MT', 'countryName' => 'Malta', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'MH', 'countryName' => 'Marshall Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'MQ', 'countryName' => 'Martinique', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'MR', 'countryName' => 'Mauritania', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MU', 'countryName' => 'Mauritius', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'YT', 'countryName' => 'Mayotte', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MX', 'countryName' => 'Mexico', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'FM', 'countryName' => 'Micronesia', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'MD', 'countryName' => 'Moldova', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'MC', 'countryName' => 'Monaco', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'MN', 'countryName' => 'Mongolia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'ME', 'countryName' => 'Montenegro', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'MS', 'countryName' => 'Montserrat', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'MA', 'countryName' => 'Morocco', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MZ', 'countryName' => 'Mozambique', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'MM', 'countryName' => 'Myanmar', 'regionCode' => 'ASIA'],
        ['countryCode' => 'NA', 'countryName' => 'Namibia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'NR', 'countryName' => 'Nauru', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'NP', 'countryName' => 'Nepal', 'regionCode' => 'ASIA'],
        ['countryCode' => 'NL', 'countryName' => 'Netherlands', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'NC', 'countryName' => 'New Caledonia', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'NZ', 'countryName' => 'New Zealand', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'NI', 'countryName' => 'Nicaragua', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'NE', 'countryName' => 'Niger', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'NG', 'countryName' => 'Nigeria', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'NU', 'countryName' => 'Niue', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'NF', 'countryName' => 'Norfolk Island', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'KP', 'countryName' => 'North Korea', 'regionCode' => 'ASIA'],
        ['countryCode' => 'MP', 'countryName' => 'Northern Mariana Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'NO', 'countryName' => 'Norway', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'OM', 'countryName' => 'Oman', 'regionCode' => 'ASIA'],
        ['countryCode' => 'PK', 'countryName' => 'Pakistan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'PW', 'countryName' => 'Palau', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'PS', 'countryName' => 'Palestine', 'regionCode' => 'ASIA'],
        ['countryCode' => 'PA', 'countryName' => 'Panama', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'PG', 'countryName' => 'Papua New Guinea', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'PY', 'countryName' => 'Paraguay', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'PE', 'countryName' => 'Peru', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'PH', 'countryName' => 'Philippines', 'regionCode' => 'ASIA'],
        ['countryCode' => 'PN', 'countryName' => 'Pitcairn', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'PL', 'countryName' => 'Poland', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'PT', 'countryName' => 'Portugal', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'PR', 'countryName' => 'Puerto Rico', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'QA', 'countryName' => 'Qatar', 'regionCode' => 'ASIA'],
        ['countryCode' => 'MK', 'countryName' => 'Republic of North Macedonia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'RE', 'countryName' => 'Réunion', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'RO', 'countryName' => 'Romania', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'RU', 'countryName' => 'Russian Federation', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'RW', 'countryName' => 'Rwanda', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'BL', 'countryName' => 'Saint Barthélemy', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'SH', 'countryName' => 'Saint Helena, Ascension and Tristan da Cunha', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'KN', 'countryName' => 'Saint Kitts and Nevis', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'LC', 'countryName' => 'Saint Lucia', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'MF', 'countryName' => 'Saint Martin (French part)', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'PM', 'countryName' => 'Saint Pierre and Miquelon', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'VC', 'countryName' => 'Saint Vincent and the Grenadines', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'WS', 'countryName' => 'Samoa', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'SM', 'countryName' => 'San Marino', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'ST', 'countryName' => 'Sao Tome and Principe', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'SA', 'countryName' => 'Saudi Arabia', 'regionCode' => 'ASIA'],
        ['countryCode' => 'SN', 'countryName' => 'Senegal', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'RS', 'countryName' => 'Serbia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'SC', 'countryName' => 'Seychelles', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'SL', 'countryName' => 'Sierra Leone', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'SG', 'countryName' => 'Singapore', 'regionCode' => 'ASIA'],
        ['countryCode' => 'SX', 'countryName' => 'Sint Maarten (Dutch part)', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'SK', 'countryName' => 'Slovakia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'SI', 'countryName' => 'Slovenia', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'SB', 'countryName' => 'Solomon Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'SO', 'countryName' => 'Somalia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'ZA', 'countryName' => 'South Africa', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'GS', 'countryName' => 'South Georgia and the South Sandwich Islands', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'KR', 'countryName' => 'South Korea', 'regionCode' => 'ASIA'],
        ['countryCode' => 'SS', 'countryName' => 'South Sudan', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'ES', 'countryName' => 'Spain', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'LK', 'countryName' => 'Sri Lanka', 'regionCode' => 'ASIA'],
        ['countryCode' => 'SD', 'countryName' => 'Sudan', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'SR', 'countryName' => 'Suriname', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'SJ', 'countryName' => 'Svalbard and Jan Mayen', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'SE', 'countryName' => 'Sweden', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'CH', 'countryName' => 'Switzerland', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'SY', 'countryName' => 'Syrian Arab Republic', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TW', 'countryName' => 'Taiwan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TJ', 'countryName' => 'Tajikistan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TZ', 'countryName' => 'Tanzania', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'TH', 'countryName' => 'Thailand', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TL', 'countryName' => 'Timor-Leste', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TG', 'countryName' => 'Togo', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'TK', 'countryName' => 'Tokelau', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'TO', 'countryName' => 'Tonga', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'TT', 'countryName' => 'Trinidad and Tobago', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'TN', 'countryName' => 'Tunisia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'TR', 'countryName' => 'Turkey', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TM', 'countryName' => 'Turkmenistan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'TC', 'countryName' => 'Turks and Caicos Islands', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'TV', 'countryName' => 'Tuvalu', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'UG', 'countryName' => 'Uganda', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'UA', 'countryName' => 'Ukraine', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'AE', 'countryName' => 'United Arab Emirates', 'regionCode' => 'ASIA'],
        ['countryCode' => 'GB', 'countryName' => 'United Kingdom', 'regionCode' => 'EUROPE'],
        ['countryCode' => 'UM', 'countryName' => 'United States Minor Outlying Islands', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'US', 'countryName' => 'United States of America', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'UY', 'countryName' => 'Uruguay', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'UZ', 'countryName' => 'Uzbekistan', 'regionCode' => 'ASIA'],
        ['countryCode' => 'VU', 'countryName' => 'Vanuatu', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'VE', 'countryName' => 'Venezuela', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'VN', 'countryName' => 'Viet Nam', 'regionCode' => 'ASIA'],
        ['countryCode' => 'VG', 'countryName' => 'Virgin Islands (British)', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'VI', 'countryName' => 'Virgin Islands (U.S.)', 'regionCode' => 'AMERICAS'],
        ['countryCode' => 'WF', 'countryName' => 'Wallis and Futuna', 'regionCode' => 'OCEANIA'],
        ['countryCode' => 'EH', 'countryName' => 'Western Sahara', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'YE', 'countryName' => 'Yemen', 'regionCode' => 'ASIA'],
        ['countryCode' => 'ZM', 'countryName' => 'Zambia', 'regionCode' => 'AFRICA'],
        ['countryCode' => 'ZW', 'countryName' => 'Zimbabwe', 'regionCode' => 'AFRICA'],
    ];

    private array $geoRegions = [
        ['regionCode' => 'AFRICA', 'regionName' => 'Africa', 'sortOrder' => 1],
        ['regionCode' => 'AMERICAS', 'regionName' => 'Americas', 'sortOrder' => 2],
        ['regionCode' => 'ANTARCTICA', 'regionName' => 'Antarctica', 'sortOrder' => 3],
        ['regionCode' => 'ASIA', 'regionName' => 'Asia', 'sortOrder' => 4],
        ['regionCode' => 'EUROPE', 'regionName' => 'Europe', 'sortOrder' => 5],
        ['regionCode' => 'OCEANIA', 'regionName' => 'Oceania', 'sortOrder' => 6],
    ];

    private array $recipeCategories = [
        ['categoryCode' => 'appetizers', 'categoryName' => 'Appetizers'],
        ['categoryCode' => 'baked_goods', 'categoryName' => 'Baked-goods'],
        ['categoryCode' => 'beverages', 'categoryName' => 'Beverages'],
        ['categoryCode' => 'breads', 'categoryName' => 'Breads'],
        ['categoryCode' => 'breakfast', 'categoryName' => 'Breakfast'],
        ['categoryCode' => 'brunch', 'categoryName' => 'Brunch'],
        ['categoryCode' => 'desserts', 'categoryName' => 'Desserts'],
        ['categoryCode' => 'entertaining', 'categoryName' => 'Entertaining'],
        ['categoryCode' => 'holidays', 'categoryName' => 'Holidays'],
        ['categoryCode' => 'lunch_brunch', 'categoryName' => 'Lunch/Brunch'],
        ['categoryCode' => 'main_dishes_beef', 'categoryName' => 'Main dishes: Beef'],
        ['categoryCode' => 'main_dishes_lamb', 'categoryName' => 'Main dishes: Lamb'],
        ['categoryCode' => 'main_dishes_meat', 'categoryName' => 'Main dishes: Meat'],
        ['categoryCode' => 'main_dishes_pork', 'categoryName' => 'Main dishes: Pork'],
        ['categoryCode' => 'main_dishes_poultry', 'categoryName' => 'Main dishes: Poultry'],
        ['categoryCode' => 'main_dishes_seafood', 'categoryName' => 'Main dishes: Seafood'],
        ['categoryCode' => 'main_dishes_veal', 'categoryName' => 'Main dishes: Veal'],
        ['categoryCode' => 'main_dishes_vegan', 'categoryName' => 'Main dishes: Vegan'],
        ['categoryCode' => 'main_dishes_vegetarian', 'categoryName' => 'Main dishes: Vegetarian'],
        ['categoryCode' => 'main_dishes_venison', 'categoryName' => 'Main dishes: Venison'],
        ['categoryCode' => 'noodles', 'categoryName' => 'Noodles'],
        ['categoryCode' => 'pasta', 'categoryName' => 'Pasta'],
        ['categoryCode' => 'pizza', 'categoryName' => 'Pizza'],
    ];

    private array $testUsers = [
        ['firstName' => 'Adam', 'lastName' => 'Adkins', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_THIRTIES],
        ['firstName' => 'Bob', 'lastName' => 'Brown', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_SIXTIES],
        ['firstName' => 'Charlie', 'lastName' => 'Clark', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_FIFTIES],
        ['firstName' => 'David', 'lastName' => 'Davis', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_FORTIES],
        ['firstName' => 'Emma', 'lastName' => 'Evans', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_TWENTIES],
        ['firstName' => 'Frank', 'lastName' => 'Fletcher', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_SIXTIES],
        ['firstName' => 'Gemma', 'lastName' => 'Gibson', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_THIRTIES],
        ['firstName' => 'Harry', 'lastName' => 'Harris', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_SEVENTY_PLUS],
        ['firstName' => 'Isla', 'lastName' => 'Ingram', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_FIFTIES],
        ['firstName' => 'Jack', 'lastName' => 'Jones', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_TWENTIES],
        ['firstName' => 'Katie', 'lastName' => 'King', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_UNDER_20],
        ['firstName' => 'Lisa', 'lastName' => 'Lee', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_THIRTIES],
        ['firstName' => 'Mia', 'lastName' => 'Morgan', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_UNDER_20],
        ['firstName' => 'Noah', 'lastName' => 'Nelson', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_THIRTIES],
        ['firstName' => 'Olivia', 'lastName' => 'Owen', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_SIXTIES],
        ['firstName' => 'Poppy', 'lastName' => 'Parker', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_FORTIES],
        ['firstName' => 'Quinn', 'lastName' => 'Queen', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_THIRTIES],
        ['firstName' => 'Rhian', 'lastName' => 'Roberts', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_TWENTIES],
        ['firstName' => 'Sophia', 'lastName' => 'Smith', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_THIRTIES],
        ['firstName' => 'Thomas', 'lastName' => 'Taylor', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_TWENTIES],
        ['firstName' => 'Umar', 'lastName' => 'Upton', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_FORTIES],
        ['firstName' => 'Violet', 'lastName' => 'Vaughan', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_FIFTIES],
        ['firstName' => 'Wilma', 'lastName' => 'Walker', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_SIXTIES],
        ['firstName' => 'Xavier', 'lastName' => 'Xu', 'sex' => User::SEX_MALE, 'age_range' => User::AGE_RANGE_TWENTIES],
        ['firstName' => 'Yasmin', 'lastName' => 'Young', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_UNDER_20],
        ['firstName' => 'Zara', 'lastName' => 'Zhang', 'sex' => User::SEX_FEMALE, 'age_range' => User::AGE_RANGE_THIRTIES],
    ];

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $manager): void
    {
        GeoRegionFactory::createSequence(
            function () {
                foreach ($this->geoRegions as $region) {
                    yield [
                        'regionCode' => $region['regionCode'],
                        'regionName' => $region['regionName'],
                        'sortOrder' => $region['sortOrder'],
                    ];
                }
            }
        );

        $countryIndex = 1;

        CountryFactory::createSequence(
            function () use (&$countryIndex) {
                foreach ($this->countries as $country) {
                    yield [
                        'countryCode' => $country['countryCode'],
                        'countryName' => $country['countryName'],
                        'region' => GeoRegionFactory::find(['regionCode' => $country['regionCode']]),
                        'sortOrder' => $countryIndex,
                    ];
                    ++$countryIndex;
                }
            }
        );

        $faker = Factory::create();
        $beginDays = 1095; // 3 years

        // Create internal users
        UserFactory::createSequence(
            [
                [
                    'email' => 'admin@example.com',
                    'password' => 'Guestbook123',
                    'firstName' => 'Jane',
                    'lastName' => 'Admin',
                    'middleName' => 'Elizabeth',
                    'sex' => User::SEX_FEMALE,
                    'ageRange' => User::AGE_RANGE_THIRTIES,
                    'roles' => [User::ROLE_ADMIN],
                    'status' => User::USER_STATUS_ACTIVE,
                    'createdAt' => $faker->dateTimeInInterval('-'.$beginDays.' days', '+ 1 day'),
                    'country' => CountryFactory::find(['countryCode' => 'GB']),
                ],
                [
                    'email' => 'editor@example.com',
                    'firstName' => 'Lizzie',
                    'lastName' => 'Editor',
                    'middleName' => 'Jane',
                    'sex' => User::SEX_FEMALE,
                    'ageRange' => User::AGE_RANGE_FORTIES,
                    'roles' => [User::ROLE_EDITOR],
                    'status' => User::USER_STATUS_ACTIVE,
                    'createdAt' => $faker->dateTimeInInterval('-'.($beginDays - 1).' days', '+ 1 day'),
                    'country' => CountryFactory::find(['countryCode' => 'GB']),
                ],
                [
                    'email' => 'moderator@example.com',
                    'firstName' => 'Kelly',
                    'lastName' => 'Moderator',
                    'middleName' => 'Anne',
                    'sex' => User::SEX_FEMALE,
                    'ageRange' => User::AGE_RANGE_THIRTIES,
                    'roles' => [User::ROLE_MODERATOR],
                    'status' => User::USER_STATUS_ACTIVE,
                    'createdAt' => $faker->dateTimeInInterval('-'.($beginDays - 2).' days', '+ 1 day'),
                    'country' => CountryFactory::find(['countryCode' => 'GB']),
                ],
            ]
        );

        // Create test users
        $totalTestUsers = 26;
        $testUsersBeginDays = $beginDays - 30;

        UserFactory::createSequence(
            function () use ($faker, $testUsersBeginDays, $totalTestUsers) {
                foreach (range(1, $totalTestUsers) as $i) {
                    yield [
                        'email' => "user{$i}@example.com",
                        'firstName' => $this->testUsers[$i - 1]['firstName'],
                        'lastName' => $this->testUsers[$i - 1]['lastName'],
                        'sex' => $this->testUsers[$i - 1]['sex'],
                        'ageRange' => $this->testUsers[$i - 1]['age_range'],
                        'roles' => ['ROLE_USER'],
                        'status' => User::USER_STATUS_ACTIVE,
                        'createdAt' => $faker->dateTimeInInterval(
                            '-'.($testUsersBeginDays - $i).' days',
                            '+ 1 day'
                        ),
                        'country' => CountryFactory::random(),
                    ];
                }
            }
        );

        $totalOtherUsers = 100;
        $otherUsersBeginDays = $testUsersBeginDays - $totalOtherUsers;

        // Create other users
        UserFactory::createSequence(
            static function () use ($faker, $otherUsersBeginDays, $totalOtherUsers) {
                foreach (range(1, $totalOtherUsers) as $i) {
                    $sexSelect = $faker->randomElement(['male', 'female']);

                    if ('male' === $sexSelect) {
                        $firstName = $faker->firstNameMale();
                        $sex = User::SEX_MALE;
                    } else {
                        $firstName = $faker->firstNameFemale();
                        $sex = User::SEX_FEMALE;
                    }

                    $lastName = $faker->lastName();
                    $email = strtolower($firstName.'.'.$lastName.'@'.$faker->safeEmailDomain());

                    yield [
                        'email' => $email,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'sex' => $sex,
                        'ageRange' => $faker->randomElement(User::AGE_RANGES),
                        'roles' => ['ROLE_USER'],
                        'status' => User::USER_STATUS_ACTIVE,
                        'createdAt' => $faker->dateTimeInInterval(
                            '-'.($otherUsersBeginDays - $i).' days',
                            '+ 1 day'
                        ),
                        'country' => CountryFactory::random(),
                    ];
                }
            }
        );

        $users = $this->entityManager->getRepository(User::class)->findAll();
        /*
                foreach ($users as $user) {
                    var_dump(
                        $user->getId().' :: '.$user->getEmail().' :: '.date_format(\DateTime::createFromImmutable($user->getCreatedAt()), 'Y/m/d H:i:s')
                    );
                }
        */
        // Create recipe categories
        RecipeCategoryFactory::createSequence(
            function () use (&$recipeCategoryIndex) {
                foreach ($this->recipeCategories as $category) {
                    yield [
                        'categoryCode' => $category['categoryCode'],
                        'categoryName' => $category['categoryName'],
                    ];
                    ++$recipeCategoryIndex;
                }
            }
        );

        $allRecipeCategories = $this->entityManager->getRepository(RecipeCategory::class)->findAll();

        // Create recipes
        RecipeFactory::createSequence(
            static function () use ($faker, $users, $allRecipeCategories) {
                $recipeCategories = [];

                foreach ($users as $user) {
                    $recipeCategories[0] = $allRecipeCategories[$faker->numberBetween(0, \count($allRecipeCategories) - 1)];
                    $title = $faker->sentence(6);
                    $description = $faker->sentence(30);

                    yield [
                        'title' => substr($title, 0, 50),
                        'description' => substr($description, 0, 255),
                        'ingredients' => $faker->paragraph(5),
                        'preparation' => $faker->paragraph(10),
                        'preparationTime' => $faker->numberBetween(10, 60),
                        'cooking' => $faker->paragraph(10),
                        'cookingTime' => $faker->numberBetween(10, 180),
                        'servings' => $faker->numberBetween(2, 8),
                        'status' => $faker->optional(
                            $weight = 0.25,
                            $default = Recipe::RECIPE_STATUS_PUBLISHED
                        )->randomElement(Recipe::RECIPE_STATUSES),
                        'user' => $user,
                        'createdAt' => date_add(
                            \DateTime::createFromImmutable($user->getCreatedAt()),
                            date_interval_create_from_date_string('1 day')
                        ),
                        'categories' => $recipeCategories,
                    ];
                }
            }
        );

        // Create comments
        $recipes = $this->entityManager->getRepository(Recipe::class)->findAll();

        RecipeCommentFactory::createSequence(
            static function () use ($faker, $recipes, $users) {
                foreach ($recipes as $recipe) {
                    $comments = $faker->numberBetween(0, 5);
                    $i = 10;

                    for ($j = 0; $j < $comments; ++$j) {
                        $commentUser = $users[$faker->numberBetween(0, \count($users) - 1)];

                        yield [
                            'comment' => $faker->paragraph(3),
                            'recipe' => $recipe,
                            'user' => $commentUser,
                            'status' => $faker->optional(
                                $weight = 0.25,
                                $default = RecipeComment::RECIPE_COMMENT_STATUS_PUBLISHED
                            )->randomElement(RecipeComment::RECIPE_COMMENT_STATUSES),
                            'createdAt' => date_add(
                                \DateTime::createFromImmutable($recipe->getCreatedAt()),
                                date_interval_create_from_date_string($i.' day')
                            ),
                        ];
                        $i = $i + $faker->numberBetween(1, 10);
                    }
                }
            }
        );
    }
}
