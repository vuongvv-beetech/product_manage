<?php

namespace App\Imports;

use App\Models\Province;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProvinceImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $count = count($rows);

        for($i=1; $i < $count - 1; $i++)
        {
            $id = (int)$rows[$i][0];
            Province::create([
                'id' => $id,
                'name'=>$rows[$i][1]
            ]);
        }
    }
}
