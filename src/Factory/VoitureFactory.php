<?php

namespace App\Factory;

use App\Entity\Voiture;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Voiture>
 */
final class VoitureFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct() {}

    public static function class(): string
    {
        return Voiture::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'nom' => self::faker()->word(),
            'description' => self::faker()->paragraph(),
            'prixQuotidien' => self::faker()->randomFloat(2, 20, 150),
            'prixMensuel' => self::faker()->randomFloat(2, 500, 3000),
            'places' => self::faker()->randomNumber(2, 7),
            'manuelle' => self::faker()->boolean(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Voiture $voiture): void {})
        ;
    }
}
