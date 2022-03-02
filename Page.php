<?php
/**
 * Page content
 * Stop the War!
 * 
 * @author uldis@sit.lv
 * @copyright 2022 Mar
 */
class Page
{
    /**
     * Page id
     * - index
     * - team
     * 
     * @var string
     */
    public $id;
    
    /**
     * Page title
     * 
     * @var string
     */
    public $title;
    
    /**
     * Page content
     * 
     * @var string
     */
    public $content;
    
    /**
     * Templates located
     * 
     * @var string
     */
    public $templateDir;
    
    /**
     * Template file
     * 
     * @var string
     */
    public $template;
    
    /**
     * View file
     *
     * @var string
     */
    public $view;
    
    /**
     * @return string
     */
    public function __toString()
    {
        $this->prepareContent ();
        
        // $page = new Page();
        
        // $page->title = $this->title;
        $view = $this->view;
        $this->view = $this->template;
        
        $this->prepareContent();
        
        $this->view = $view;
        
        return $this->content;
    }
    
    /**
     * Prepare content, pass object to view file
     * 
     * @return void
     */
    public function prepareContent ()
    {
        if (!file_exists($this->view))
        {
            throw new Exception("File not found");
        }
        
        ob_start();
        ob_implicit_flush(false);
        extract(["page" => $this], EXTR_OVERWRITE);

        require $this->view;
        
        $this->content = ob_get_clean();
    }
    
    /**
     * TIme of last update
     * <day-name>, <day> <month> <year> <hour>:<minute>:<second> GMT
     * 
     * @return string
     */
    public function getDateGMT()
    {
        $dateTime = new DateTime();
        
        $timeZone = new DateTimeZone("GMT");
        $dateTime->setTimezone($timeZone);
        
        return $dateTime->format("D, d M Y H:i:s") . " GMT";
    }
}
