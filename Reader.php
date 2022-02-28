<?php
/**
 * Read data from input.csv file
 */
class Reader
{
    /**
     * CSV file handler
     */
    private $_handler;

    /**
     * Each column variable name
     * 
     * @var string[]
     */
    public $headers;
    
    /**
     * Open input.csv to parse data
     * 
     * @return void
     */
    public function __construct ()
    {
        $this->_handler = fopen("input.csv", "r");

        $this->_headers (fgetcsv($this->_handler));
    }

    /**
     * Header colums to make them readablea as variables
     * 
     * @return void
     */
    private function _headers ($row)
    {
        $row = array_map(function ($value) {
            return str_replace(" ", "-", strtolower($value));
        }, $row);

        $this->headers = $row;
    }

    /**
     * @return array
     */
    public function read ()
    {
        $row = fgetcsv($this->_handler);

        if (!$row)
        {
            return null;
        }

        $values = [];
        foreach ($row as $key => $val)
        {
            $values[$this->headers[$key]] = $val;
        }

        return $this->_addCoordinates($values);
    }

    /**
     * Read coorginates from map link
     * 
     * @example @52.3813778,9.7179203,17z
     * @return array
     */
    private function _addCoordinates($values)
    {
        $mapLink = $values["map"];

        
        $x = preg_match("#/@([\-?\d\.]+),(\-?[\d\.]+),\d+z/#i", $mapLink, $matches);

        if ($x)
        {
            /* var_dump($values);
            throw new \Exception ("bad x"); */
            $values["lat"] = $matches[1];
            $values["lng"] = $matches[2];
        }

        

        return $this->_popupData($values);
    }

    /**
     * Close file hangler
     * 
     * @return void
     */
    public function _close ()
    {
        fclose($this->_handler);
    }

    /**
     * private function for popup data 
     * add new attribut 
     * popupData
     * 
     * @return array
     */
    private function _popupData ($values)
    {
        $values["popup_data"] = "<p>" . $values["description"] . "</p>";

        if ($values["discipline"])
        {
            $values["popup_data"] .= "<p>" . $values["discipline"] . "</p>";
        }

        $values["popup_data"] .= "<div class=\"bottom-links\">";
        if ($values["link"])
        {
            $values["popup_data"] .= sprintf('<a href="%s" target="_blank">', $values["link"]);
            $values["popup_data"] .= '<svg class="bi" width="16" height="16" fill="currentColor">';
            $values["popup_data"] .= '<use xlink:href="assets/bootstrap-icons.svg#link-45deg"/>';
            $values["popup_data"] .= '</svg>';
            $values["popup_data"] .= '</a>';
        }

        if ($values["contact"])
        {
            if (strstr($values["contact"], "@"))
            {
                $contact = "mailto:" . $values["contact"];
            } else
            {
                $contact = "call:" . $values["contact"];
            }
            
            $values["popup_data"] .= sprintf('<a href="%s">', $contact);
            $values["popup_data"] .= '<svg class="bi" width="16" height="16" fill="currentColor">';
            $values["popup_data"] .= '<use xlink:href="assets/bootstrap-icons.svg#at"/>';
            $values["popup_data"] .= '</svg>';
            $values["popup_data"] .= '</a>';
        }

        if ($values["tweet"])
        {
            $values["popup_data"] .= sprintf('<a href="%s" target="_blank">', $values["tweet"]);
            $values["popup_data"] .= '<svg class="bi" width="16" height="16" fill="currentColor">';
            $values["popup_data"] .= '<use xlink:href="assets/bootstrap-icons.svg#twitter"/>';
            $values["popup_data"] .= '</svg>';
            $values["popup_data"] .= '</a>';
        }
 
        $values["popup_data"] .= "</div>";

        return $values;
    }
}