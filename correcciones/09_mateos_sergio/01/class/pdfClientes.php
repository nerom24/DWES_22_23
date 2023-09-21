<?php

    // Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto

    class pdfCliente extends FPDF{

        public function Header(){
            
            $this->Image("imagenes/cliente.png", 10,5, 20);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 16, 'Clientes - ' . date('d/m/Y'), 'B', 1, 'R');
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
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Clientes'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Por id'), 1, 1);
            $this->Ln(5);
        }

        public function CabListadoArticulos(){
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(200);
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id: '), 'B', 0, 'R');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Nombre: '), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Apellidos: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'telefono: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'ciudad: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'dni: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'email: '), 'B', 1, 'R');

        }

        public function H(){

        }

    }



?>