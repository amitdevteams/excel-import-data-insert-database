<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if (!$row['email']) {
                continue;
            }
            $customer = Customer::where('email', $row['email'])->first();
            if($customer){
                $customer->update([
                    'name' => $row['name'],
                    'phone' => $row['phone'],
                ]);
            }else{
                Customer::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ]);
            }
        }
    }
}
