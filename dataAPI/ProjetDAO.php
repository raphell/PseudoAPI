<?php
class ProjetDAO{
    // database connection and table name
    private $conn;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function readAll(){
      /*$query = "
      SELECT DISTINCT ob.body_value as body, ob.body_summary as bodysum, ob.bundle, ov.field_ville_value as ville, ol.field_lien_url as lien, oa.field_annee_tid, oc.field_carte_lat as lat, oc.field_carte_lon as lon
      FROM obj_field_data_body as ob , obj_field_data_field_ville as ov, obj_field_data_field_lien as ol, obj_field_data_field_annee as oa, obj_field_data_field_carte as oc
      where ob.bundle='expérience' AND ob.entity_id = ov.entity_id AND ob.entity_id = ol.entity_id AND ob.entity_id = oa.entity_id AND oc.entity_id = ob.entity_id;
      ";*/

      $query = "select * from user ";
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute();
      return $stmt;

    }


    // read products
    function readVille($ville){
        $query = "
        SELECT DISTINCT ob.body_value as body, ob.body_summary as bodysum, ob.bundle, ov.field_ville_value as ville, ol.field_lien_url as lien, oa.field_annee_tid, oc.field_carte_lat as lat, oc.field_carte_lon as lon
        FROM obj_field_data_body as ob , obj_field_data_field_ville as ov, obj_field_data_field_lien as ol, obj_field_data_field_annee as oa, obj_field_data_field_carte as oc
        where ob.bundle='expérience' AND ob.entity_id = ov.entity_id AND ob.entity_id = ol.entity_id AND ob.entity_id = oa.entity_id AND oc.entity_id = ob.entity_id AND ov.field_ville_value LIKE '$ville%' ;
        ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

}
