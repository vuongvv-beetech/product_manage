<?php

namespace App\Imports;

use App\Models\Commune;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CommuneImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $count = count($rows);

        for($i=1; $i < $count ; $i++)
        {
            $id = (int)$rows[$i][0];
            $district_id = (int)$rows[$i][4];
            Commune::create([
                'id' => $id,
                'name'=>$rows[$i][1],
                'district_id'=>$district_id
            ]);
        }
    }
}
