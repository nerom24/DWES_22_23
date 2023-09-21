<?php

    /* Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto */

    class pdfArticulo extends FPDF {

        public function Header() {

            $this->Image('logo/mariano.png', 10, 5, 20);
            $this->SetFont('Arial','B',10);
            $this->Cell(0,16,'Curtidos Mariana','B',1,'R');
            $this->ln(5);

        }

        public function Footer() {
            $this->setY(-10);
            $this->SetFont('Arial','B',10);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}','T',0,'C');
        }

        public function Titulo() {
            $this->SetFont('Times','',10);
            $this->SetFillColor(240);
            $this->Cell(60,10,iconv('UTF-8','ISO-8859-1','Listado: '), 1, 0, 'R', true);
            $this->Cell(0, 10,iconv('UTF-8','ISO-8859-1','Productos Mariana'), 1, 1);
            $this->Cell(60,10,iconv('UTF-8','ISO-8859-1','Criterio: '), 1, 0, 'R', true);
            $this->Cell(0,10,iconv('UTF-8','ISO-8859-1','Orden de Creación'), 1, 1);
            $this->ln(5);
        }

        public function CabListadoArticulos() {
            $this->SetFont('Times','B',10);
            $this->SetFillColor(240);
            $this->Cell(10, 7, iconv('UTF-8','ISO-8859-1','Id'), 'B', 0, 'R', true);
            $this->Cell(50, 7, iconv('UTF-8','ISO-8859-1','Descripción'), 'B', 0, 'L', true);
            $this->Cell(30, 7, iconv('UTF-8','ISO-8859-1','Fabricante'), 'B', 0, 'L', true);
            $this->Cell(30, 7, iconv('UTF-8','ISO-8859-1','Categoría'), 'B', 0, 'L', true);
            $this->Cell(40, 7, iconv('UTF-8','ISO-8859-1','Etiquetas'), 'B', 0, 'L', true);
            $this->Cell(30, 7, iconv('UTF-8','ISO-8859-1','Precio'), 'B', 1, 'R', true);

        }

    }

?>