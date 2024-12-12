<?php

namespace App\Imports;

use App\Models\Lead;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class LeadImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithSkipDuplicates, WithUpserts
{

    public $team_id;

    public function __construct($team_id)
    {
        $this->team_id = $team_id;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

        /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return [
            'email',
        ];
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // Skip record if no team_id or email exists
        if (!isset($row['email']) || !$this->team_id) {
            return null;
        }

        return new Lead([
            'team_id' => $this->team_id,
            'first_name' => Str::title(trim($row['first_name'])),
            'last_name' => Str::title(trim($row['last_name'])),
            'company_name' => Str::title(trim(Str::before($row['company_name'], '(Dba:'))),
            'email' => Str::lower(trim($row['email'])),
            'phone' => trim($row['phone']),
        ]);
    }
}
