<?php

namespace App\Libraries;

use App\Libraries\NotFoundException;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
		public array $entries = [];
		
    public function get(string $id)
    {
        if($this->has($id)){

            $entry = $this->entries[$id];
            return new $entry;
        }
        
        return $this->resolve($id);
    }
    public function has(string $id):bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, string $concrete)
    {
        return $this->entries[$id] = $concrete;
    }
    
    public function resolve($id)
    { 
	      $reflectionClass = new \ReflectionClass($id);

        if(! $reflectionClass->isInstantiable())        
        {
                      
            throw new \Exception('class named '.$id. ' is not instantiable');
        }

        $constructor = $reflectionClass->getConstructor();

        if(! $constructor || ! $constructor->getParameters())
        {
            return new $id;
        }
        

        $parameters = $constructor->getParameters();

        $dependencies = array_map(function(\ReflectionParameter $param){
            $paramName = $param->getName();
            $paramType = $param->getType();

            if(! $paramType)
            {
                throw new \Exception('unknow parameter type');
            }

            if($paramType instanceOf \ReflectionUnionType)
            {
                throw new \Exception();
            }

            if($paramType instanceOf \ReflectionNamedType && ! $paramType->isBuiltin() )
            {
                return $this->get($paramType);
            }
            
            throw new \Exception('facing a built in datatype');

        },
        $parameters);
           
         return $reflectionClass->newInstanceArgs($dependencies);
        }
}
?>
