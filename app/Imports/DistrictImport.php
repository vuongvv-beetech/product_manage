<?php

namespace App\Imports;

use App\Models\District;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DistrictImport implements ToCollection
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
            $province_id = (int)$rows[$i][4];
            District::create([
                'id' => $id,
                'name'=>$rows[$i][1],
                'province_id'=>$province_id
            ]);
        }
    }

}
