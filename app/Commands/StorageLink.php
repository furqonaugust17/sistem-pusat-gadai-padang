<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class StorageLink extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'storage:link';
    protected $description = 'Buat symbolic link (atau junction di Windows) dari writable/{targetFolder} ke public/{linkFolder}.';
    protected $usage       = 'php spark storage:link [targetFolder] [linkFolder]';
    protected $arguments   = [
        'targetFolder' => 'Nama folder di writable/ (opsional, default: uploads)',
        'linkFolder'   => 'Nama folder di public/ (opsional, default: storage)',
    ];

    public function run(array $params)
    {
        $targetFolder = $params[0] ?? 'uploads';
        $linkFolder   = $params[1] ?? 'storage';

        $target = realpath(WRITEPATH . $targetFolder);
        $link   = FCPATH . $linkFolder;

        CLI::write("Target: {$target}", 'yellow');
        CLI::write("Link: {$link}", 'yellow');

        if ($target === false || !is_dir($target)) {
            CLI::error("Folder sumber '{$targetFolder}' tidak ditemukan di writable/");
            return;
        }

        if (file_exists($link)) {
            CLI::write("Link '{$link}' sudah ada.", 'yellow');
            return;
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $target = str_replace('/', '\\', $target);
            $link   = str_replace('/', '\\', $link);

            $publicPath = dirname($link);
            if (!is_dir($publicPath)) {
                mkdir($publicPath, 0777, true);
            }

            $command = "cmd /c mklink /J \"$link\" \"$target\"";
            $output = shell_exec($command);

            if (strpos($output, 'created') !== false || strpos($output, 'junction') !== false) {
                CLI::write("Junction berhasil dibuat dari '{$target}' ke '{$link}'", 'green');
            } else {
                CLI::error("Gagal membuat junction. Pastikan PHP dijalankan dengan izin yang cukup atau folder path valid.");
                CLI::write("Output: " . trim($output ?? 'Tidak ada output dari mklink'), 'red');
            }
        } else {
            if (symlink($target, $link)) {
                CLI::write("Symlink berhasil dibuat dari '{$target}' ke '{$link}'", 'green');
            } else {
                CLI::error('Gagal membuat symlink.');
            }
        }
    }
}
