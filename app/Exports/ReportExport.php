<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Report;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\Alignment;
use App\Models\Question;

class ReportExport implements FromView,WithEvents,WithHeadings
{
    public function __construct($from_date, $to_date)
    {   
            $this->from_date = $from_date;
            $this->to_date = $to_date;
    }
    public function view(): View
    {
        
        $temp = Report::join('cabang','report.cabang_id','=','cabang.id')
        ->join('users','report.user_id','=','users.id')
        ->join('roles','report.role_id','=','roles.id')
        ->select("report.id","cabang.nama_cabang","roles.name as jenis_layanan","users.name as nama_petugas","report.nama as nama_nasabah","report.reason","report.created_at","report.id as actions")
        ->whereBetween('report.date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])
        ->get();
        $question = Question::all();
        return view('report.excel', [
            'temp' =>  $temp,
            'question'=>$question
        ]);
    }
    public function headings(): array
    {
        return null;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $range = 'A1:Z1';
                $style = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                        'bold'=>true
                    ],
                ];
                $event->sheet->getDelegate()->getStyle('A1:Z1')->getFont()->setBold(true);
                $event->sheet->getStyle($range)->applyFromArray($style);
                $event->sheet->getDelegate()->getStyle('A1:Z1')->getAlignment()->setVertical('center')->setWrapText(true);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);
                $event->sheet->getColumnDimension('A')->setWidth(32);
                $event->sheet->getColumnDimension('B')->setWidth(32);
                $event->sheet->getColumnDimension('C')->setWidth(32);
                $event->sheet->getColumnDimension('D')->setWidth(32);
                $event->sheet->getColumnDimension('E')->setWidth(32);
                $event->sheet->getColumnDimension('F')->setWidth(35);
                $event->sheet->getColumnDimension('G')->setWidth(35);
                $event->sheet->getColumnDimension('H')->setWidth(35);
                $event->sheet->getColumnDimension('I')->setWidth(35);
                $event->sheet->getColumnDimension('J')->setWidth(35);
                $event->sheet->getColumnDimension('K')->setWidth(35);
                $event->sheet->getColumnDimension('L')->setWidth(35);
                $event->sheet->getColumnDimension('M')->setWidth(32);
                $event->sheet->getColumnDimension('N')->setWidth(32);
                $event->sheet->getColumnDimension('O')->setWidth(32);
                $event->sheet->getColumnDimension('P')->setWidth(32);
                $event->sheet->getColumnDimension('Q')->setWidth(32);
                $event->sheet->getColumnDimension('R')->setWidth(32);
                $event->sheet->getColumnDimension('S')->setWidth(32);
                $event->sheet->getColumnDimension('T')->setWidth(32);
                $event->sheet->getColumnDimension('U')->setWidth(32);
                $event->sheet->getColumnDimension('V')->setWidth(32);
                $event->sheet->getColumnDimension('W')->setWidth(32);
                $event->sheet->getColumnDimension('X')->setWidth(32);
                $event->sheet->getColumnDimension('Y')->setWidth(32);
                $event->sheet->getColumnDimension('Z')->setWidth(32);

            },
        ];
    }
    
}
