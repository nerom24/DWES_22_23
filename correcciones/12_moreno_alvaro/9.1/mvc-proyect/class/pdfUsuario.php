<?php

    class pdfUsuario extends FPDF {

        public function Header() {
            
            $this->Image("logo/logo.jpg", 10,5, 20);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 16, 'GESTION USUARIOS - ' . date('d/m/Y'), 'B', 1, 'R');
            $this->ln(5);

        }


        public function Footer() {
            $this->setY(-10);
            $this->SetFont('Times', 'B', 10);
            $this->Cell(0,10, 'Page' .$this->PageNo() .'/{nb}','T' ,0 ,'C');

        }

        public function Titulo() {

            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(173,216,230);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Listado: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Alumnos'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Por id'), 1, 1);
            $this->Ln(5);

        }

        public function CabListadoArticulos() {
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(173,216,230);
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'ID '), 'B', 0, 'L');
            $this->Cell(80, 7, iconv('UTF-8', 'ISO-8859-1', 'Nombre '), 'B', 0, 'L');
            $this->Cell(70, 7, iconv('UTF-8', 'ISO-8859-1', 'Email '), 'B', 1, 'L');

        }

    }


?>