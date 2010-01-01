<h1>Hello <?php echo $this->nama ?></h1>
<h1>Hello <?php echo $this->nim ?></h1>

<form ostric:id="PostController.post">
    <input ostric:id="title"/>
    <input ostric:id="content"/>
</form>

<?php


/** @Entity */
class MyPersistentClass extends Model
{
    /** @Column(type="integer") */
    private $id;
   
    /** @Column(type="string") */
    private $name;
    
    
}
