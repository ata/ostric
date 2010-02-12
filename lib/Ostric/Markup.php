<?php
namespace Ostric;

class Markup extends Component
{
    
    
    /**
     * html attributes
     * @var string
     */
    protected $attributes = array();
    
    /**
     * 
     */
    public function __construct($id, $attributes = array())
    {
        parent::__construct($id);
        $this->attributes = attributes;
    }
    
     /**
     * Costume   template path
     * @return void
     */
    public setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
    }
    
    /**
     * @return string
     */
    public function getTemplatePath()
    {
        if ($this->templatePath != null) {
            return $this->templatePath;
        }
        $path = str_replace('.php','.html',$this->getFileName());
        if (file_exists($path)) {
            $this->templatePath = $path;
            return $path;
        }
        $path = str_replace('.php', '/'.$this->getShortName().'.html', $this->getFileName());
        if (file_exists($path)) {
            $this->templatePath = $path;
            return $path;
        }
    }
    
}
