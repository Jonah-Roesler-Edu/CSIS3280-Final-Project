<?php
class Article{
/*
Field	Type	Null	Key	Default	Extra
id	int(11)	NO	PRI	null	auto_increment
title	varchar(128)	NO		null	
slug	varchar(128)	NO	MUL	null	
text	text	NO		null
*/
    private $id;
    private $title;
    private $slug;
    private $text;

    public function getNewsText(){
        return $this->text;
    }

    public function getTitular(){
            return $this->title;
    }

    public function getSlug(){
            return $this->slug;
    }

//     public function __set($name, $value)
//     {
//             if ($name === 'last_login')
//             {
//                     $this->last_login = DateTime::createFromFormat('U', $value);
//             }
//     }

//     public function __get($name)
//     {
//             if (isset($this->$name))
//             {
//                     return $this->$name;
//             }
//     }
}