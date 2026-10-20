<?php

namespace PixiiBomb\Ui\Installers;

use Illuminate\Console\Command;
use PixiiBomb\Core\Attributes\Installer;
use PixiiBomb\Core\Attributes\InstallerDetails;
use PixiiBomb\Core\Installers\PixiiBombInstaller;
use Symfony\Component\Process\Process;

#[InstallerDetails('pixiibomb/ui', priority: 20, icon: '🎨')]
class PixiiUiInstaller extends PixiiBombInstaller
{
    /**
     * Install the UI package's Node dependencies into the host application.
     */
    #[Installer(
        isRequired: true,
        description: 'Install Bootstrap and related UI dependencies.'
    )]
    public function installNodeDependencies(Command $command): void
    {
        $npm = PHP_OS_FAMILY === 'Windows'
            ? 'npm.cmd'
            : 'npm';

        $process = new Process(
            [
                $npm,
                'install',
                'bootstrap@^5.3.8',
                'bootstrap-icons@^1.13.1',
                '@popperjs/core@^2.11.8',
                'highlight.js@^11.11.1',
            ],
            base_path()
        );

        $process->setTimeout(null);

        $process->run(
            fn (string $type, string $buffer) =>
            $command->getOutput()->write($buffer)
        );

        if (! $process->isSuccessful()) {
            $this->log->error('PixiiBomb UI dependencies failed to install.');

            return;
        }

        $this->log->success('PixiiBomb UI dependencies installed.');
    }
}
