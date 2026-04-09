<?php 
abstract class DomainEvent 
{ 
 private $eventName; 
 private $occurredOn; 
 public function __construct($eventName) 
 {  
 $this->occurredOn = date('Y-m-d H:i:s'); 
 } 
 public function occurredOn() { return $this->occurredOn; } 
 abstract public static function eventName(): string;
}
