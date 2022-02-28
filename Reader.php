<?php
/**
 * 
 */
class Reader
{
    /**
     * 
     */
    public $handler;

    /**
     * 
     */
    public $headers;
    
    public function __construct ()
    {
        $this->handler = fopen("input.csv", "r");

        $this->_headers (fgetcsv($this->handler));

        
    }

    /**
     * 
     */
    private function _headers ($row)
    {
        $row = array_map(function ($value) {
            // var_dump();
            return str_replace(" ", "-", strtolower($value));
        }, $row);

        $this->headers = $row;
    }

    /**
     * @return array
     */
    public function read ()
    {
        $row = fgetcsv($this->handler);

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
     * 
     */
    private function _addCoordinates($values)
    {
        $mapLink = $values["map"];

        // var_dump ($mapLink);

        // @52.3813778,9.7179203,17z
        $x = preg_match("#/@([\-?\d\.]+),(\-?[\d\.]+),\d+z/#i", $mapLink, $matches);

        if (!$x)
        {
            var_dump($values);
            throw new \Exception ("bad x");
        }

        // var_dump($matches);
        $values["lat"] = $matches[1];
        $values["lng"] = $matches[2];

        return $this->_popupData($values);
    }

    /**
     * 
     */
    public function _close ()
    {
        fclose($this->handler);
    }

    /**
     * private function for popup data 
     * add new attribut 
     * popupData
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