<?php

namespace App\Exports;

use App\EventUser;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventUserExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct(int $event_id)
    {
        $this->event_id = $event_id;
    }

    public function query()
    {
        return EventUser::query()->where('event_id', $this->event_id);
    }

    public function map($EventUser): array
    {
        return [
            $EventUser->event->name,
            $EventUser->user->name,
            $EventUser->user->email,
            $EventUser->code,
            Carbon::parse($EventUser->created_at)->toFormattedDateString()

        ];
    }

    public function headings(): array
    {
        return [
            'Nama Event',
            'Nama Peserta',
            'Email',
            'Code Ticket',
            'Tanggal Pendaftaran'
        ];
    }
}
