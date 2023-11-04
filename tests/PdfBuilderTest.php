<?php

namespace Venancio\tests;

use PHPUnit\Framework\TestCase;
use Venancio\Builderpdf\PdfBuilder;

class PdfBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function testSavePdf()
    {
        $pathSavePdf = (new PdfBuilder())
            ->setPaper()
            ->setHTML(file_get_contents( __DIR__ . "/template.php"))
            ->setPathToSaveFile(__DIR__ . "/pdf", "meu-teste.pdf")
            ->save();
        $this->assertTrue(file_exists($pathSavePdf));
    }

    /**
     * @test
     */
    public function testDestroyPdf()
    {
        $pathSavePdf = (new PdfBuilder())
            ->setPaper()
            ->setHTML(file_get_contents( __DIR__ . "/template.php"))
            ->setPathToSaveFile(__DIR__ . "/pdf", "meu-teste.pdf")
            ->save();
        $this->assertTrue(file_exists($pathSavePdf));
        PdfBuilder::destroy($pathSavePdf);
        $this->assertFalse(file_exists($pathSavePdf));
    }
}