<?php
namespace CoreUI\Panel\classes\Components\ButtonGroup;

/**
 *
 */
class Dropdown {

    const POSITION_START = 'start';
    const POSITION_END   = 'end';


    private $id       = '';
    private $content  = '';
    private $position = 'end';
    private $items    = [];
    private $attr     = [
        'class' => "btn btn-secondary"
    ];
    private $item_index = 1;


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
     * Установка позиции раскрывающегося списка
     * @param string $position
     * @return self
     */
    public function setPosition(string $position): self {

        $this->position = $position;

        return $this;
    }


    /**
     * Получение позиции раскрывающегося списка
     * @return string
     */
    public function getPosition(): string {
        return $this->position;
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
     * Добавление ссылки
     * @param string      $content
     * @param string      $link
     * @param string|null $id
     * @return Dropdown\Link
     */
    public function addItemLink(string $content, string $link, string $id = null): Dropdown\Link {

        if (empty($id)) {
            $id = "item{$this->item_index}";
        }

        $item = new Dropdown\Link($id);
        $item->setContent($content);
        $item->setLink($link);

        $this->items[] = $item;
        $this->item_index++;

        return $item;
    }


    /**
     * Добавление кнопки
     * @param string      $content
     * @param string|null $id
     * @return Dropdown\Button
     */
    public function addItemButton(string $content, string $id = null): Dropdown\Button {

        if (empty($id)) {
            $id = "item{$this->item_index}";
        }


        $item = new Dropdown\Button($id);
        $item->setContent($content);

        $this->items[] = $item;
        $this->item_index++;

        return $item;
    }


    /**
     * Добавление разделителя
     * @return Dropdown\Divider
     */
    public function addItemDivider(): Dropdown\Divider {

        $item = new Dropdown\Divider();

        $this->items[] = $item;
        $this->item_index++;

        return $item;
    }


    /**
     * Установка атрибута
     * @param string $name
     * @param string $value
     * @return self
     */
    public function setAttr(string $name, string $value): self {

        $this->attr[$name] = $value;

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

        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }

        return [
            'id'       => $this->getId(),
            'type'     => 'dropdown',
            'content'  => $this->getContent(),
            'position' => $this->getPosition(),
            'attr'     => $this->attr,
            'items'    => $items,
        ];
    }
}