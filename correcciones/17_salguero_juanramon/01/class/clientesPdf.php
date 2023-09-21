<?php

    // Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto

    class pdfCliente extends FPDF{

        public function Header(){
            
            $this->Image("logo/3.jpg", 10,5, 20);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 16, 'IES SIERRA GRAZALEMA, GRAZALEMA, 630504353', 'B', 1, 'R');
            $this->ln(5);

        }


        public function Footer(){

            $this->setY(-10);
            $this->SetFont('Times', 'B', 10);
            $this->Cell(0,10, 'Page' .$this->PageNo() .'/{nb}','T' ,0 ,'C');

        }

        public function Titulo(){

            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(131,255,140);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Listado: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Clientes'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Orden de Creación'), 1, 1);
            $this->Ln(5);
            
        }

        public function CabListadoClientes(){
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(131,255,140);
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id: '), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Apellidos: '), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Nombre: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Telefono: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'DNI: '), 'B', 0, 'L');
            $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'Email: '), 'B', 1, 'L');

        }

        public function H(){

        }

    }



?>