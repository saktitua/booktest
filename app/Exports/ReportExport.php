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
use App\Models\DetailReport;
use DB;

class ReportExport implements FromView,WithEvents,WithHeadings
{
    public function __construct($from_date, $to_date)
    {   
            $this->from_date = $from_date;
            $this->to_date = $to_date;
    }
    public function view(): View
    {
        $reports = DB::table('report')
        ->join('cabang','report.cabang_id','=','cabang.id')
        ->join('roles','report.role_id','=','roles.id')
        ->join('users','report.user_id','=','users.id')
        ->select('report.id','report.nama','report.date','cabang.nama_cabang','report.reason','roles.name as jenis_layanan','users.name as petugas')
        ->whereBetween('date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])
        ->get();
        if(count($reports)< 1 ){
            return redirect()->back()->with(['danger'=>'Data yang di export tidak ada']);
        }
        $question = DB::table('report_detail')->join('question','report_detail.question','=','question.question')->groupBy('report_detail.question')->select('question.question','report_detail.point','question.id as id_question')->whereBetween('report_detail.date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])->get(); 
        foreach($reports as $key => $die){ 
            foreach($question as $k => $d){
                $points = DB::table('report_detail')->select('point')->where('question',$d->question)->where('report_id',$die->id)->first(); 
                $arrpoint[$k] =[
                    'question' =>$d->question,
                    'point' =>isset($points->point) ? $points->point : " ",
                ];
                $arrquestion[$k] =[
                    'question' =>$d->question,
                ];
            }
            $pointArr[] = [
                'date'=>date('d M Y',strtotime($die->date)),
                'nama'=>$die->nama,
                'kritik_saran'=>$die->reason,
                'jenis_layanan'=>$die->jenis_layanan,
                'petugas'=>$die->petugas,
                'nama_cabang'=>$die->nama_cabang,
                'point'=>$arrpoint,
            ];
            $questionArr [] =[
                'questions'=>$arrquestion,
            ]; 
        }
        $report =[
            'nasabah'=>$pointArr,
            'questions'=>$arrquestion,
        ];
        $from = $this->from_date;
        $to   = $this->to_date;
        return view('report.excel', [
            'report' => $report,
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
              

            },
        ];
    }
    
}
