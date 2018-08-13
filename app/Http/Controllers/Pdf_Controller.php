<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class Pdf_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fpdf = new Fpdf;
        $fpdf->AddPage();
	    $fpdf->SetFont('Courier', 'B', 18);
	    $fpdf->Cell(50, 25, 'Hello World!');
	    $fpdf->Output();
	    return $fpdf;
    }
}
