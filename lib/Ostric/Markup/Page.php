<?php 

namespace Ostric\Markup;

use Ostric\Markup;

abstract class Page extends Markup
{
    /**
     * file template path
     * @var string
     */
    protected $templatePath = null;
    /**
     * file path cache of template for performance
     * @var string
     */
    protected $templatePathCache = null;
    /**
     * @var DomDocument
     * 
     */
    protected $dom = null;
    
   
    
}
