<?php

namespace App\Services;

class BackupService
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function backupSql()
    {
        $config = config('Database')->default;

        $host = $config['hostname'];
        $port = $config['port'] ?? 5432;
        $user = $config['username'];
        $pass = $config['password'];
        $db   = $config['database'];

        $backupPath = WRITEPATH . 'backups/sql/';
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupPath . $filename;

        putenv("PGPASSWORD={$pass}");

        $cmd = "pg_dump -h {$host} -p {$port} -U {$user} -F p {$db} > {$filepath}";

        exec($cmd, $output, $result);

        if ($result !== 0) {
            throw new \Exception("Backup gagal: " . implode("\n", $output));
        }

        return [
            'filename' => $filename,
            'filepath' => $filepath
        ];
    }

    public function backupCsv()
    {
        $tables = $this->db->listTables();
        $zipFile = WRITEPATH . 'backups/csv/csv_' . date('Y-m-d_H-i-s') . '.zip';

        $zip = new \ZipArchive();
        $zip->open($zipFile, \ZipArchive::CREATE);

        foreach ($tables as $table) {
            $rows = $this->db->table($table)->get()->getResultArray();

            $fp = fopen('php://temp', 'r+');

            if (!empty($rows)) {
                fputcsv($fp, array_keys($rows[0]));
                foreach ($rows as $row) {
                    fputcsv($fp, $row);
                }
            }

            rewind($fp);
            $csv = stream_get_contents($fp);
            fclose($fp);

            $zip->addFromString($table . '.csv', $csv);
        }

        $zip->close();

        return $zipFile;
    }
}
