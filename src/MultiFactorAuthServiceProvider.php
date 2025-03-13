<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth;

use Illuminate\Foundation\Console\AboutCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Worksome\MultiFactorAuth\Enums\Channel;

class MultiFactorAuthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-mfa')
            ->hasConfigFile()
            ->hasMigration('create_mfa_multi_factors_table');
    }

    public function bootingPackage(): void
    {
        $this->extendAboutCommand();
    }

    private function extendAboutCommand(): void
    {
        if (! config('mfa.features.about_command', true)) {
            return;
        }

        /** @var array<class-string<Channel>, array{driver: string|null}> $channels */
        $channels = config('mfa.channels', []);

        if (empty($channels)) {
            return;
        }

        AboutCommand::add(
            'Multi-Factor Authentication (MFA)',
            fn () => collect($channels)->mapWithKeys(fn (array $config, string $channel) => [
                Channel::driverDescription($channel) => $config['driver'] ?? 'null',
            ])
        );
    }
}
