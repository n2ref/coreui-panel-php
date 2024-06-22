<?php
namespace CoreUI\Panel\Abstract;


/**
 *
 */
abstract class Control {

    /**
     * Преобразование в массив
     * @return array
     */
    abstract public function toArray(): array;
}