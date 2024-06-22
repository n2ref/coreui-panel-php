<?php
namespace CoreUI\Panel\Control\Dropdown;


/**
 * 
 */
class Button {

    private $id      = '';
    private $content = '';
    private $onclick = '';


    /**
     * @param string|null $id
     */
    public function __construct(string $id = null) {

        if ($id) {
            $this->id = $id;
        } else {
            $this->id = crc32(uniqid());
        }
    }


    /**
     * Установка ID контрола
     * @param string $id
     * @return self
     */
    public function setId(string $id): self {

        $this->id = $id;

        return $this;
    }


    /**
     * Получение ID контрола
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }


    /**
     * Установка содержимого кнопки
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self {

        $this->content = $content;

        return $this;
    }


    /**
     * Получение содержимого кнопки
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }


    /**
     * Установка js функции выполняющейся при клике
     * @param string $onclick
     * @return self
     */
    public function setOnClick(string $onclick): self {

        $this->onclick = $onclick;

        return $this;
    }


    /**
     * Получение js функции выполняющейся при клике
     * @return string
     */
    public function getOnClick(): string {
        return $this->onclick;
    }


    /**
     * @return array
     */
    public function toArray(): array {

        return [
            'id'      => $this->getId(),
            'type'    => 'button',
            'content' => $this->getContent(),
            'onClick' => $this->getOnClick(),
        ];
    }
}