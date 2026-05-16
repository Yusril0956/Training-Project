<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuditWeakPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:weak-passwords {--reset : Send password reset link to affected users} {--csv= : Output CSV path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit users for weak passwords (e.g., password equals NIK) and optionally send reset links.';

    public function handle()
    {
        $this->info('Starting weak password audit...');

        $users = User::all();
        $results = [];

        foreach ($users as $user) {
            $reasons = [];

            // Check if password equals NIK
            if ($user->nik && Hash::check($user->nik, $user->getAuthPassword())) {
                $reasons[] = 'password_equals_nik';
            }

            // Flag accounts with email ending with AD (legacy suspicious)
            if (str_ends_with(strtoupper($user->email ?? ''), 'AD')) {
                $reasons[] = 'email_suffix_AD';
            }

            if (!empty($reasons)) {
                $record = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'nik' => $user->nik,
                    'roles' => implode('|', $user->roles->pluck('name')->toArray()),
                    'reasons' => implode('|', $reasons),
                ];

                // Optionally send reset link
                if ($this->option('reset')) {
                    try {
                        Password::sendResetLink(['email' => $user->email]);
                        $record['reset_sent'] = 'yes';
                    } catch (\Exception $e) {
                        $record['reset_sent'] = 'error: ' . $e->getMessage();
                    }
                } else {
                    $record['reset_sent'] = 'no';
                }

                $results[] = $record;
            }
        }

        if (empty($results)) {
            $this->info('No weak-password accounts found.');
            return 0;
        }

        $csvPath = $this->option('csv') ?: storage_path('logs/weak_passwords_' . now()->format('Ymd_His') . '.csv');

        $fp = fopen($csvPath, 'w');
        fputcsv($fp, array_keys($results[0]));
        foreach ($results as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);

        $this->info('Audit complete. Found ' . count($results) . ' accounts. CSV: ' . $csvPath);

        return 0;
    }
}
