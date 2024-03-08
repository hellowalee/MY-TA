<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
        return view('pdf.upload-pdf');
     }
     
    public function addWatermark($x, $y, $watermarkText, $angle, $pdf){
        $angle = $angle * M_PI / 180;
        $c = cos($angle);
        $s = sin($angle);
        $cx = $x * 1;
        $cy = (300 - $y) * 1;
        $pdf->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, - $s, $c, $cx, $cy, - $cx, - $cy));
        $pdf->Text($x, $y, $watermarkText);
        $pdf->_out('Q');
    }
    
    public function output(Request $request){
        $file = $request->file('file')->path();
        $text_image = public_path().'/storage/'.'kucingku.png'; 
        
        // Set source PDF file 
        $pdf = new \setasign\Fpdi\Fpdi();
        if(file_exists($file)){ 
            $pagecount=$pdf->setSourceFile($file);
        }else{ 
            die('Source PDF not found!'); 
        } 
        
        // Add watermark image to PDF pages 
        // for($i=1;$i<=$pagecount;$i++){ 
        //     $tpl = $pdf->importPage($i); 
        //     $size = $pdf->getTemplateSize($tpl); 
        //     $pdf->addPage(); 
        //     $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE); 
            
        //     //Put the watermark 
        //     $xxx_final = ($size['width']-60); 
        //     $yyy_final = ($size['height']-25); 
        //     $pdf->Image($text_image, $pdf->GetX(), $pdf->GetY(), 100,20,'PNG','www.plus2net.com');
        // } 
    
        for($i = 1; $i <= $pagecount; $i++)
        {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('Times', 'B', 70);
            $pdf->SetTextColor(192, 192, 192);
            $watermarkText = 'IZINTERMURAH.COM';
            $this->addWatermark(70, 220, $watermarkText, 45, $pdf);
            // nib
            if($i<=$pagecount&&$request['izin']==1){
                $pdf->Image($text_image, $pdf->GetX()+105, $pdf->GetY()+64, 30,5,'PNG','www.plus2net.com');
            }
            // pirt
            if($i==1&&$request['izin']==2){
                $pdf->Image($text_image, $pdf->GetX()+80, $pdf->GetY()+66, 60,5,'PNG','www.plus2net.com');
                $pdf->SetXY(25, 25);
                $pdf->Image($text_image, $pdf->GetX()+66, $pdf->GetY()+77, 60,5,'PNG','www.plus2net.com');
            }
            if($i==2&&$request['izin']==2){
                $pdf->Image($text_image, $pdf->GetX()+95, $pdf->GetY()+68, 60,5,'PNG','www.plus2net.com');
                $pdf->SetXY(25, 25);
                $pdf->Image($text_image, $pdf->GetX()+80, $pdf->GetY()+65, 60,5,'PNG','www.plus2net.com');
            }
            $pdf->SetXY(25, 25);
        }
        
        // Output PDF with watermark 
        $pdf->Output();
    }


}
