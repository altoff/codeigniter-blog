<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Categorytree {
    function getSectionOptions($options = array())
    {
        $options['first'] = (isset($options['first'])) ? $options['first'] : true;
        $options['delimiter'] = (isset($options['delimiter'])) ? $options['delimiter'] : ". ";

        $CI =& get_instance();
        $tree = array();
        $CI->db->order_by("NAME", "ASC");
        $queryS = $CI->db->get('category');
        foreach ($queryS->result() as $rowS)
            $tree[] = $this->ObjectToMass($rowS);
        if($options['first'] != false)
            return array("0" => array("ID" => "0", "NAME" => "Верхний уровень", "CODE" => "")) + $this->get_tree($tree, 0, 0, $options);
        else
            return $this->get_tree($tree, 0, 0, $options);
    }
    function get_tree($tree, $pid, $lvl, $options)
    {
        $lvl++;
        $html = array();
        foreach ($tree as $row)
        {
            if ($row['PARENT_ID'] == $pid)
            {
                $row['NAME'] = str_repeat($options['delimiter'], ($options['first'] != false)? $lvl : $lvl-1 ) . " " . $row['NAME'];
                $html[$row['ID']] = $row;
                $html = $html + $this->get_tree($tree, $row['ID'], $lvl, $options);
            }
        }
        return $html;
    }
    function ObjectToMass($array)
    {
        $newarray = array();
        if(is_array($array) || is_object($array))
        {
            foreach($array as $key => $mass)
            {
                if(is_object($mass))
                    $mass = $this->ObjectToMass($mass);
                $newarray[$key] = $mass;
            }
        }
        else
        {
            $newarray = $array;
        }
        return $newarray;
    }
}