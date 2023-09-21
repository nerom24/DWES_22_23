<?php

    // Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto

    class pdfUsuario extends FPDF{

        public function Header(){
            
            $this->Image("logo/logo.png", 10,5, 20);
            $this->ln(12);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 16, 'GESBANK 1.0', 'B', 0, 'L');
            $this->Cell(0, 16, '2DAW 22/23', 'B', 1, 'R');
            $this->ln(5);
        }


        public function Footer()
        {
            $this->setY(-10);
            $this->SetFont('Times', 'B', 10);
            $this->Cell(0,10, 'Page' .$this->PageNo() .'/{nb}','T' ,0 ,'C');
        }

        public function Titulo(){

            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(200);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Listado: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Usuarios'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Fecha: '), 1, 0, "R", true);
            $this->Cell(0,10, date('d/m/Y'), 1, 1);
            $this->Ln(5);
        }

        public function CabListadoArticulos(){
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(200);
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Id: '), 'B', 0, 'L');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'name: '), 'B', 0, 'L');
            $this->Cell(60, 7, iconv('UTF-8', 'ISO-8859-1', 'email: '), 'B', 0, 'L');
            $this->Cell(60, 7, iconv('UTF-8', 'ISO-8859-1', 'perfil: '), 'B', 1, 'L');

        }

    }



?>