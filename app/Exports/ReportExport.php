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
use App\Models\Cabang;

class ReportExport implements FromView,WithEvents,WithHeadings
{
    public function __construct($from_date, $to_date,$cabang_id)
    {   
            $this->from_date = $from_date;
            $this->to_date = $to_date;
            $this->cabang_id = $cabang_id;
    }
    public function view(): View
    {
   
       

        $cabang = Cabang::find($this->cabang_id);
    
        $count = Report::whereBetween('date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])->count();
        if($this->cabang_id != ""){
            $count = Report::whereBetween('date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])->where('cabang_id',$this->cabang_id)->count();
        }
        $page = ceil($count/10);

    
        for($i=1; $i<=$page ;$i++){

            $reportss = DB::table('report')
            ->join('cabang','report.cabang_id','=','cabang.id')
            ->join('roles','report.role_id','=','roles.id')
            ->join('users','report.user_id','=','users.id')
            ->select('report.id','report.nama','roles.name as jenis_layanan','cabang.nama_cabang','report.date','report.reason','users.name as petugas')
            ->whereBetween('date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])
            ->skip(($i  - 1) * 10)
            ->take(10)
            ->get();

            $question = DB::table('report_detail')
            ->join('report','report_detail.report_id','=','report.id')
            ->groupBy('report_detail.question')->select('report_detail.question','report_detail.point')
            ->whereBetween('report_detail.date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])
            ->get();

          

            if($this->cabang_id != ""){
                $reportss = DB::table('report')
                ->join('cabang','report.cabang_id','=','cabang.id')
                ->join('roles','report.role_id','=','roles.id')
                ->join('users','report.user_id','=','users.id')
                ->select('report.id','report.nama','roles.name as jenis_layanan','cabang.nama_cabang','report.date','report.reason','users.name as petugas')
                ->whereBetween('date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])
                ->where('report.cabang_id',$this->cabang_id)
                ->skip(($i  - 1) * 10)
                ->take(10)
                ->get();
    
                $question = DB::table('report_detail')
                ->join('report','report_detail.report_id','=','report.id')
                ->groupBy('report_detail.question')->select('report_detail.question','report_detail.point')
                ->whereBetween('report_detail.date',[date('Y-m-d',strtotime($this->from_date)),date('Y-m-d',strtotime($this->to_date))])
                ->where('report.cabang_id',$this->cabang_id)
                ->get();
            }
    
            // dd($question);

            $reportArr =[]; 
            $arrquestion = array();
            foreach($reportss as $key => $die){ 
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
                $reportArr[$key] = [
                    'tanggal'=>$die->date,
                    'cabang'=>$die->nama_cabang,
                    'kritik_saran'=>$die->reason,
                    'jenis_layanan'=>$die->jenis_layanan,
                    'nama'=>$die->nama,
                    'petugas'=>$die->petugas,
                    'points'=>$arrpoint,
                ];
            }
           
    
            $nasabah[$i] = $reportArr;
            $rep[$i] = $reportss;
        }

        $report =[
            'question'=>$arrquestion,
            'nasabah'=>$nasabah, 
        ];



        return view('report.excel', [
            'report' => $report,
            'cabang'=>$cabang,
            'from'=>$this->from_date,
            'to'=>$this->to_date,
            'cabang'=>$cabang,
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
                $range = 'A3:Z3';
                $style = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                        'bold'=>true
                    ],
                ];
                $event->sheet->getDelegate()->getStyle('A1:Z1')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:Z2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4:XDF4')->getFont()->setBold(true);
                $event->sheet->getStyle($range)->applyFromArray($style);
                $event->sheet->getDelegate()->getStyle('A4:Z4')->getAlignment()->setVertical('center')->setWrapText(true);
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
