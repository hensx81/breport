<?php
class Consultas extends CI_Model {
		
		public $resultados;

        public function obtener_entrantes()
        {
			$fechainicio = $this->fechainicio;
			$fechafin = $this->fechafin;
			$origen = $this->origen;
			$numero_registros = $this->numero_registros;
			$compensar = $this->compensar;

			$this->load->database();
			$this->db->select('uniqueid, calldate, clid, channel, src, dst, billsec, disposition');
			$this->db->where('calldate >=', "$fechainicio");
			$this->db->where('calldate <=', "$fechafin");
			//$this->db->where('dst', '23939360');
			$this->db->like('channel', 'SIP/sip-cnt');
			if ($origen != "") {
				$this->db->like('src', "$origen");	
			}
			$this->db->from('cdr');
			$this->db->limit($numero_registros, $compensar);
			$query = $this->db->get();
			$this->db->close();

			// Solo para diagnostico
			// print "<pre>";
			// print_r($query->row_array());
			// print "</pre>";

			$this->resultados = $query->num_rows();

			return $query->result();
        }

        public function resultados()
        {
        	return $this->resultados;
        }

        public function registros_totales()
        {
        	return $this->db->count_all('cdr');
        }
}
