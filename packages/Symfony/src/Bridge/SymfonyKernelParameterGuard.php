<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge;

use Rector\Configuration\Option;
use Rector\Exception\Configuration\InvalidConfigurationException;
use Symfony\Component\HttpKernel\Kernel;

final class SymfonyKernelParameterGuard
{
    public function ensureKernelClassIsValid(?string $kernelClass, string $requestServiceName): void
    {
        // ensure value is not null nor empty
        if ($kernelClass === null || $kernelClass === '') {
            throw new InvalidConfigurationException(sprintf(
                'Make sure "parameters > %s" is set in rector.yaml.%sIt is needed to resolve "%s" service name to type',
                Option::KERNEL_CLASS_PARAMETER,
                PHP_EOL,
                $requestServiceName
            ));
        }

        $this->ensureKernelClassExists($kernelClass);
        $this->ensureIsKernelInstance($kernelClass);
    }

    private function ensureKernelClassExists(string $kernelClass): void
    {
        if (class_exists($kernelClass)) {
            return;
        }

        throw new InvalidConfigurationException(sprintf(
            'Kernel class "%s" provided in "parameters > %s" is not autoloadable. Make sure composer.json of your application is valid and rector is loading "vendor/autoload.php" of your application.',
            $kernelClass,
            Option::KERNEL_CLASS_PARAMETER
        ));
    }

    private function ensureIsKernelInstance(string $kernelClass): void
    {
        if (is_a($kernelClass, Kernel::class, true)) {
            return;
        }

        throw new InvalidConfigurationException(sprintf(
            'Kernel class "%s" provided in "parameters > %s" is not instance of "%s". Make sure it is.',
            $kernelClass,
            'kernel_class',
            Kernel::class
        ));
    }
}
