<?php

namespace Venancio\Builderpdf;

use Dompdf\Dompdf;
use Dompdf\Options;

class BuilderPdf
{
    /**
     * The Dompdf instance for PDF generation.
     *
     * @var Dompdf
     */
    private Dompdf $pdf;

    /**
     * The path where the PDF file will be saved.
     *
     * @var string
     */
    private string $pdfSavePath;

    /**
     * The name of the PDF file.
     *
     * @var string
     */
    private string $pdfName;

    /**
     * Constructor for the BuilderPdf class.
     *
     * @param Options|null $options (Optional) An instance of the Dompdf Options class to configure PDF generation.
     */
    public function __construct(?Options $options = null)
    {
        if($options == null) {
            $this->pdf = new Dompdf();
            return;
        }
        $this->pdf = new Dompdf($options);
    }

    /**
     * Set the HTML content to be converted into a PDF.
     *
     * @param string $html The HTML content to be converted into a PDF.
     * @return static The current instance of BuilderPdf.
     */
    public function setHTML(string $html):static
    {
        $this->pdf->loadHtml($html);
        return $this;
    }

    /**
     * Set the paper size and orientation for the PDF.
     *
     * @param string $size The paper size (e.g., "A4").
     * @param string $orientation The paper orientation (e.g., "portrait" or "landscape").
     * @return static The current instance of BuilderPdf.
     */
    public function setPaper($size = "A4", $orientation = "portrait"): static
    {
        $this->pdf->setPaper($size, $orientation);
        return $this;
    }

    /**
     * Set the path and name of the resulting PDF file.
     *
     * @param string $path The path where the PDF file will be saved.
     * @param string $name The name of the PDF file.
     * @return static The current instance of BuilderPdf.
     */
    public function setPathToSaveFile(string $path, string $name): static
    {
        $this->pdfSavePath = $path;
        $this->pdfName = $name;
        return $this;
    }

    /**
     * Generate the target directory if it does not exist.
     *
     * @return void
     */
    private function makeDir(): void
    {
        if (!is_dir($this->pdfSavePath)) {
            mkdir($this->pdfSavePath, 0755, true);
        }
    }

    /**
     * Get the full path to store the PDF file.
     *
     * @return string The full path for the PDF file.
     */
    private function getFullPathToStore():string
    {
        return "{$this->pdfSavePath}/{$this->pdfName}";
    }

    /**
     * Save the generated PDF content to the specified file path.
     *
     * This method stores the PDF content to the specified file path using the Dompdf library.
     *
     * @return void
     */
    private function store(): void
    {
        file_put_contents($this->getFullPathToStore(), $this->pdf->output());
    }

    /**
     * Render and save the PDF, returning the full path of the file.
     *
     * @return string The full path for the saved PDF file.
     */
    public function save(): string
    {
        $this->makeDir();
        $this->pdf->render();
        $this->store();
        return $this->getFullPathToStore();
    }

    /**
     * Initiate the process of downloading the generated PDF.
     *
     * @param string $fileName The name of the PDF file during download.
     * @return void
     */
    public function download(string $fileName): void
    {
        $this->pdf->render();
        $this->pdf->stream($fileName);

    }

    /**
     * Remove an existing PDF file, if it exists.
     *
     * @param string $fullPath The full path of the file to be removed.
     * @return bool true if the file was successfully removed, false if it doesn't exist.
     */
    public static function destroy(string $fullPath): bool
    {
        if(file_exists($fullPath)){
            return  unlink($fullPath);
        }
        return false;
    }
}

