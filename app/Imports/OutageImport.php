<?php

namespace App\Imports;

use App\Models\FileHistory;
use App\Models\Location;
use App\Models\Outage;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OutageImport implements ToModel, WithStartRow, SkipsEmptyRows
{
    public string $fileName;
    private int $rows = 0;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function model(array $row): ?Model
    {
        $row = $this->formatted($row);

        ++$this->rows;

        return $this->import($row);
    }

    public function formatted(array $row): array
    {
        if (!isset($row[4])) {
            $row[4] = $row[3];
            $row[3] = $row[2];
            $row[2] = 69;
        }

        return $row;
    }

    public function import(array $row): Outage
    {
        $locationName = trim(preg_replace('/\d+/', '', $row[3]));
        $location = Location::firstWhere('name', $locationName);
        $outageHistoryFile = FileHistory::firstWhere('name', $this->fileName);
        $data = [
            'start' => Date::excelToDateTimeObject($row[0]),
            'end' => Date::excelToDateTimeObject($row[1]),
            'location_id' => $location->id,
            'file_history_id' => $outageHistoryFile->id,
            'address' => $row[4]
        ];

        return Outage::updateOrCreate($data);
    }

    /**
     * Set starting row
     * @return int
     */
    public function startRow(): int
    {
        return 3;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
