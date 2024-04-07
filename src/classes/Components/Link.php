<?php
namespace CoreUI\Panel\classes\Components;


/**
 *
 */
class Link {

    private $id       = '';
    private $href     = '';
    private $content  = '';
    private $onclick  = '';
    private $attr     = [];


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
     * Установка url адреса
     * @param string $href
     * @return self
     */
    public function setHref(string $href): self {

        $this->href = $href;

        return $this;
    }


    /**
     * Получение url адреса
     * @return string
     */
    public function getHref(): string {
        return $this->href;
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
     * Установка ID контрола
     * @param string $id
     * @return void
     */
    public function setId(string $id): void {
        $this->id = $id;
    }


    /**
     * Получение ID контрола
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }


    /**
     * Установка атрибута
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setAttr(string $name, string $value): void {

        if (is_scalar($value)) {
            $this->attr[$name] = $value;
        }
    }


    /**
     * Установка атрибутов
     * @param array $attr
     * @return void
     */
    public function setAttributes(array $attr): void {

        foreach ($attr as $name => $value) {
            $this->setAttr($name, $value);
        }
    }


    /**
     * Получение значения атрибута
     * @return string
     */
    public function getAttr(string $name):? string {
        return $this->attr[$name] ?? null;
    }


    /**
     * @return array
     */
    public function toArray(): array {

        return [
            'id'      => $this->getId(),
            'type'    => 'button',
            'content' => $this->getContent(),
            'href'    => $this->getHref(),
            'onclick' => $this->getOnClick(),
            'attr'    => $this->attr,
        ];
    }
}