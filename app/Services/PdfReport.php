<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;


class PdfReport
{
    /**
     * Generate and download a PDF report.
     */
    public static function download(string $view, array $data, string $filename = 'report'): PdfBuilder
    {
        $data['generated_at'] = Carbon::now()->format('d M Y, H:i');
        $data['app_name']     = config('app.name', 'AttachKE');

        $pdf = Pdf::view($view, $data)
            ->format('a4')
            ->portrait();

        return $pdf->download("{$filename}-" . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Stream (inline view) instead of downloading.
     */
    public static function stream(string $view, array $data, string $filename = 'report'): PdfBuilder
    {
        $data['generated_at'] = Carbon::now()->format('d M Y, H:i');
        $data['app_name']     = config('app.name', 'AttachKE');

        $pdf = Pdf::view($view, $data)
            ->format('a4')
            ->portrait();

        return $pdf->inline("{$filename}.pdf");
    }
}