<?php
    /* Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto */

    class pdfClientes extends FPDF{
        public function Header()
        {
            $this->Image('logo/banco.jpeg', 10, 5, 20);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(45,16,' GESBANK 1.0', 'B', 0, 'R');
            $this->Cell(70,16,' Adrian Soria Garcia', 'B', 0, 'R');
            $this->Cell(0,16,' 2DAW', 'B', 1, 'R');
            $this->ln(5);
        }

        public function Footer(){
            $this->setY(-10);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0,10,'Page'. $this->PageNo().'/{nb}', 'T', 0, 'C');
        }

        public function Titulo(){
            $this->SetFont('Times','',10);
            $this->SetFillColor(240);
            $this->Cell(60,10, iconv ("UTF-8","ISO-8859-1", "Informe: "), 1, 0, 'R', true );
            $this->Cell(0,10, iconv ("UTF-8","ISO-8859-1", 'Lista de clientes'), 1, 1);
            $this->Cell(60,10, iconv ("UTF-8","ISO-8859-1", "Fecha: "), 1, 0, 'R', true );
            $this->Cell(0,10, iconv ("UTF-8","ISO-8859-1", date('d-m-Y H:i:s')), 1, 1);
            $this->ln(5);
        }

        public function Linea_clie(){
            $this->SetFillColor(240);
            $this->Cell(10, 7, iconv ("UTF-8","ISO-8859-1", "Id"), 'B', 0, 'R', true);
            $this->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", "Nombre"), 'B', 0, 'L', true);
            $this->Cell(40, 7, iconv ("UTF-8","ISO-8859-1", "Apellidos"), 'B', 0, 'L', true);
            $this->Cell(50, 7, iconv ("UTF-8","ISO-8859-1", "Email"), 'B', 0, 'L', true);
            $this->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", "Teléfono"), 'B', 0, 'L', true);
            $this->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", "Dni"), 'B', 1, 'L', true);
        }

    }

?>