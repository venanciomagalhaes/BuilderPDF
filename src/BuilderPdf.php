<?php

namespace Venancio\Builderpdf;

use Dompdf\Dompdf;
use Dompdf\Options;

class BuilderPdf
{
    private Dompdf $pdf;

    private string $pdfSavePath;

    private string $pdfName;
    public function __construct(?Options $options = null)
    {
        if($options == null) {
            $this->pdf = new Dompdf();
            return;
        }
        $this->pdf = new Dompdf($options);
    }

    public function setHTML(string $html):static
    {
        $this->pdf->loadHtml($html);
        return $this;
    }

    public function setPaper($size = "A4", $orientation = "portrait"): static
    {
        $this->pdf->setPaper($size, $orientation);
        return $this;
    }

    public function setPathToSaveFile(string $path, string $name): static
    {
        $this->pdfSavePath = $path;
        $this->pdfName = $name;
        return $this;
    }

    private function makeDir(): void
    {
        if (!is_dir($this->pdfSavePath)) {
            mkdir($this->pdfSavePath, 0755, true);
        }
    }

    private function getFullPathToStore():string
    {
        return "{$this->pdfSavePath}/{$this->pdfName}";
    }

    private function store(): void
    {
        file_put_contents($this->getFullPathToStore(), $this->pdf->output());
    }
    public function save(): string
    {
        $this->makeDir();
        $this->pdf->render();
        $this->store();
        return $this->getFullPathToStore();
    }

    public function download(string $fileName): void
    {
        $this->pdf->render();
        $this->pdf->stream($fileName);

    }

    public static function destroy(string $fullPath): bool
    {
        if(file_exists($fullPath)){
            return  unlink($fullPath);
        }
        return false;
    }

}

