<?php

namespace App\Exports;

use App\User;

// We use the FromQuery concern instead of FromCollection for better performance in large datasets
// This way, the query is excecuted in chunks
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromQuery, ShouldAutosize, WithHeadings, WithEvents
{
    public function query()
    {
				return User::select('users.name', 'users.lastname', 'users.idNumber', 'users.status', 		'categories.name as category', 'users.email')
						->join('categories', 'users.category_id', '=', 'categories.id');
		}

		/**
		 *	Define headings
		 *
     * @return array
     */
		public function headings(): array
		{
			return [
				'Name',
				'Lastname',
				'ID Number',
				'Status',
				'Category',
				'Email'
			];
		}

		/**
		 *	Increase headings font-size	
		 *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
								$cellRange = 'A1:F1'; // Header cells
								$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(20);
            },
        ];
    }
}
