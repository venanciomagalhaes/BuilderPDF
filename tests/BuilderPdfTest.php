<?php

namespace Venancio\tests;

use PHPUnit\Framework\TestCase;
use Venancio\Builderpdf\BuilderPdf;

class BuilderPdfTest extends TestCase
{
    /**
     * @test
     */
    public function testSavePdf()
    {
        $pathSavePdf = (new BuilderPdf())
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
        $pathSavePdf = (new BuilderPdf())
            ->setPaper()
            ->setHTML(file_get_contents( __DIR__ . "/template.php"))
            ->setPathToSaveFile(__DIR__ . "/pdf", "meu-teste.pdf")
            ->save();
        $this->assertTrue(file_exists($pathSavePdf));
        BuilderPdf::destroy($pathSavePdf);
        $this->assertFalse(file_exists($pathSavePdf));
    }
}