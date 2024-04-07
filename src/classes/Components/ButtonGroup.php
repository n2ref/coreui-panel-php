<?php
namespace CoreUI\Panel\classes\Components;


/**
 *
 */
class ButtonGroup {

    private $id      = '';
    private $buttons = [];
    private $attr    = [
        'class' => "btn-group"
    ];
    private $btn_index = 1;



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
     * Добавление ссылки
     * @param string      $content
     * @param string      $link
     * @param string|null $id
     * @return ButtonGroup\Link
     */
    public function addBtnLink(string $content, string $link, string $id = null): ButtonGroup\Link {

        if (empty($id)) {
            $id = "btn{$this->btn_index}";
        }

        $item = new ButtonGroup\Link($id);
        $item->setContent($content);
        $item->setLink($link);

        $this->items[] = $item;
        $this->btn_index++;

        return $item;
    }


    /**
     * Добавление кнопки
     * @param string      $content
     * @param string|null $id
     * @return ButtonGroup\Button
     */
    public function addBtnButton(string $content, string $id = null): ButtonGroup\Button {

        if (empty($id)) {
            $id = "btn{$this->btn_index}";
        }

        $item = new ButtonGroup\Button($id);
        $item->setContent($content);

        $this->items[] = $item;
        $this->btn_index++;

        return $item;
    }


    /**
     * Добавление кнопки
     * @param string      $content
     * @param string|null $id
     * @return ButtonGroup\Dropdown
     */
    public function addBtnDropdown(string $content, string $id = null): ButtonGroup\Dropdown {

        if (empty($id)) {
            $id = "btn{$this->btn_index}";
        }


        $item = new ButtonGroup\Dropdown($id);
        $item->setContent($content);

        $this->items[] = $item;
        $this->btn_index++;

        return $item;
    }


    /**
     * Установка атрибута
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setAttr(string $name, string $value): void {

        $this->attr[$name] = $value;
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

        $buttons = [];

        foreach ($this->buttons as $button) {
            $buttons[] = $button->toArray();
        }

        return [
            'id'      => $this->getId(),
            'type'    => 'button_group',
            'attr'    => $this->attr,
            'buttons' => $buttons,
        ];
    }
}