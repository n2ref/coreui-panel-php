<?php
namespace CoreUI\Panel\Components\ButtonGroup;

/**
 *
 */
class Button {

    private $id       = '';
    private $content  = '';
    private $onclick  = '';
    private $attr     = [
        'class' => "btn btn-secondary"
    ];


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
     * Установка атрибута
     * @param string $name
     * @param string $value
     * @return self
     */
    public function setAttr(string $name, string $value): self {

        if (is_scalar($value)) {
            $this->attr[$name] = $value;
        }

        return $this;
    }


    /**
     * Установка атрибутов
     * @param array $attr
     * @return self
     */
    public function setAttributes(array $attr): self {

        foreach ($attr as $name => $value) {
            $this->setAttr($name, $value);
        }

        return $this;
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
            'onClick' => $this->getOnClick(),
            'attr'    => $this->attr,
        ];
    }
}