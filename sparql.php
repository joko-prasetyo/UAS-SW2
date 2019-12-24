<?php 
    require_once('sparqlib.php');
    function query($category) {
        $db = sparql_connect("http://localhost:3030/semanticresto/sparql");
        if (!$db) {
            print sparql_errno() .": ". sparql_errno(). "\n"; exit;
        }
        sparql_ns("foo", "https://semanticresto.com/");
        sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
        sparql_ns("foaf", "http://xmlns.com/foaf/0.1/");
        $sparql = "
        prefix foo: <https://semanticresto.com/> 
        prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
        prefix foaf: <http://xmlns.com/foaf/0.1/>
        select ?name ?price ?ingredients ?category ?url
        where{ 
        ?food foaf:name ?name .
        ?food foaf:price ?price .
        ?food foaf:ingredients ?ingredients .
        ?food foaf:category ?category .
        ?food foaf:url ?url .
        filter (?category = '".$category."')
        }";

        $result = sparql_query($sparql);
        return $result;
    }
    function query1() {
        $db = sparql_connect("http://localhost:3030/pegawai/sparql");
        if (!$db) {
            print sparql_errno() .": ". sparql_errno(). "\n"; exit;
        }

        $sparql = "
        PREFIX sn: <http://www.snee.com/hr/>
        PREFIX fo: <http://www.w3.org/1999/XSL/Format#>
        prefix foaf: <http://xmlns.com/foaf/0.1/> 
        prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
        prefix dc: <http://purl.org/dc/terms/>
        select ?name ?abstract ?desc ?birthday ?hireDate
        where{ 
        ?pegawai foaf:name ?name .
        ?pegawai dc:abstract ?abstract .
        ?pegawai dc:description ?desc .
        ?pegawai foaf:birthday ?birthday .
  	    ?pegawai sn:hireDate ?hireDate .        
        }";

        $result = sparql_query($sparql);
        return $result;
    }
?>