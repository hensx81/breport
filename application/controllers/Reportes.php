<?php
class Reportes extends CI_Controller {

        public $rangofechadefecto = 1;

        public function ver($page = 'home')
        {
            //print "$fecha_inicio <br />";
            //print "$fecha_fin <br />";

            if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
            {
                // Whoops, we don't have a page for that!
                show_404();
            }

            $data['title'] = ucfirst($page); // Capitalize the first letter

            // Formulario
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fecha', 'Fecha', 'required', array('required' => 'Debe ingresar una %s'));
            $this->form_validation->set_rules('rango', 'Rango', 'required', array('required' => 'Debe ingresar un %s'));
            $this->form_validation->set_rules('origen', 'Origen', 'trim|min_length[2]|max_length[10]', array('min_length' => 'Numero de origen incorrecto, verifique el campo %s', 'max_length' => 'Numero de origen incorrecto, verifique el campo %s'));
            $this->form_validation->run();


            // Modelo
            $this->load->model('Consultas');
            $this->Consultas->numero_registros = 50;
            $this->Consultas->compensar = 1;

            if (set_value('fecha')) {
                $fecha = set_value('fecha')." 00:00:00";
                $fecha = new DateTime("$fecha");
            }
            else {
                $fecha = new DateTime();
            }
            if (set_value('rango')) {
                $rangofecha = set_value('rango')." days";
            }
            else {
                $rangofecha = $this->rangofechadefecto. " days";
            }
            $fecha_inicio = $fecha->format("Y-m-d");
            $fecha->modify("+$rangofecha");
            $fecha_fin = $fecha->format("Y-m-d");
            $this->Consultas->fechainicio = $fecha_inicio;
            $this->Consultas->fechafin = $fecha_fin;

            if (!$this->Consultas->origen = set_value('origen')) {
                $this->Consultas->origen = "";
            }

            $row = $this->Consultas->obtener_entrantes();
            $resultados = $this->Consultas->resultados();
            $registros_totales = $this->Consultas->registros_totales();

            $data['resultado'] = $row;
            $data['resultados'] = $resultados;
            $data['registros_totales'] = $registros_totales;

            // vistas
            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer', $data);

        }

}