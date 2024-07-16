<?php
namespace CoreUI\Panel\Tabs;
use \CoreUI\Panel\Abstract;


/**
 *
 */
class Dropdown extends Abstract\Tab {

    protected array $items = [];


    /**
     * @param string|null $id
     */
    public function __construct(string $id = null) {

        $this->setId($id ?: (string)crc32(uniqid()));
    }


    /**
     * Добавление значения в список
     * @param string      $title
     * @param string|null $id
     * @return Dropdown\Item
     */
    public function addItem(string $title, string $id = null): Dropdown\Item {

        $item = new Dropdown\Item($id);
        $item->setTitle($title);

        $this->items[] = $item;

        return $item;
    }


    /**
     * Добавление разделителя
     * @return void
     */
    public function addDivider(): void {

        $this->items[] = [
            'type' => 'divider'
        ];
    }


    /**
     * Получение значений таба
     * @return array
     */
    public function getItems(): array {

        return $this->items;
    }


    /**
     * @return array
     */
    public function toArray(): array {

        $items = [];

        foreach ($this->items as $item) {
            if (is_array($item)) {
                $items[] = $item;

            } else {
                $items[] = $item->toArray();
            }
        }


        $result = [
            'id'    => $this->getId(),
            'type'  => 'dropdown',
            'title' => $this->getTitle(),
            'items' => $items,
        ];

        if ($this->isActive()) {
            $result['active'] = true;
        }
        if ($this->isDisabled()) {
            $result['disabled'] = true;
        }
        if ( ! is_null($side = $this->getSide())) {
            $result['side'] = $side;
        }

        return $result;
    }
}