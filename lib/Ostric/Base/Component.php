<?php

namespace Ostric\Base;

abstract class Component extends Base
{
        
    protected $template = null;
    
    public function __inject(array $objects)
    {
        foreach ($objects as $id => $object) {
            if (property_exists($this,$id)) {
                $this->$id = $object;
            }
        }
        
    }
    
    public function setTemplate($template_path)
    {
        if(file_exists($template_path)) {
            ob_start();
            include($template_path);
            $this->template = ob_clean();
        }
    }
    
    public function getTemplate(Component $component)
    {
        
        if ($component->template != null) {
            return $component->template;
        }
        
        $file_path = $component->getReflection()->getFileName();
    
        
        $file_template_path = str_replace('.php','.phtml',$file_path);
        
        if (file_exists($file_template_path)){
            ob_start();
            include($file_template_path);
            $component->template = ob_get_clean();
            goto end_render;
        }
        
        
        
        preg_match('/\/(?P<file>[A-Za-z0-9_]+)\.php/',$file_path,$result);
        
        
        if ($result['file'] == 'classes') {
            $sort_name = $component->getReflection()->getShortName();
            
            $file_template_path = str_replace('/classes.php','/classes/' 
                                    . $sort_name . '.phtml');
            
            
            if (file_exists($file_template_path)){
                ob_start();
                include($file_template_path);
                $component->template = ob_get_clean();
                goto end_render;
            }
            
        }
        
        
        end_render:
        return $component->template;
        
    }
    
    
    public function render()
    {
        echo $this->getTemplate($this);
    }
    
    abstract public function run();

}
