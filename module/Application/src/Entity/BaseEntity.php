<?php


namespace Application\Entity;


use Doctrine\Common\Collections\Collection;


trait BaseEntity
{
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        unset($vars['__initializer__'], $vars['__cloner__'], $vars['__isInitialized__']);

//        foreach ($vars as $key => $var) {
//            if ($var instanceof Collection) {
//                $vars[$key] = $this->{'get' . ucfirst($key)}()->toArray();
//            }
//        }

        return $vars;
    }
}