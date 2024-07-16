<?php
namespace CoreUI\Panel\Abstract;

class Tab {

    const SIDE_LEFT  = 'left';
    const SIDE_RIGHT = 'right';

    private string  $id       = '';
    private string  $title    = '';
    private bool    $disabled = false;
    private bool    $active   = false;
    private ?string $side     = null;



    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self {

        $this->title = $title;
        return $this;
    }


    /**
     * Получение названия таба
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }


    /**
     * Установка ID таба
     * @param string $id
     * @return self
     */
    public function setId(string $id): self {

        $this->id = $id;

        return $this;
    }


    /**
     * Получение ID таба
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }


    /**
     * Установка запрета на переход в таб
     * @param bool $is_disabled
     * @return $this
     */
    public function setDisabled(bool $is_disabled): self {

        $this->disabled = $is_disabled;
        return $this;
    }


    /**
     * Получение запрета на переход в таб
     * @return bool
     */
    public function isDisabled(): bool {
        return $this->disabled;
    }


    /**
     * Установка информации активен ли таб
     * @param bool $is_active
     * @return self
     */
    public function setActive(bool $is_active): self {

        $this->active = $is_active;
        return $this;
    }


    /**
     * Получение информации активен ли таб
     * @return bool
     */
    public function isActive(): bool {
        return $this->active;
    }


    /**
     * Установка стороны для таба
     * @param string|null $side
     * @return self
     */
    public function setSide(string $side = null): self {

        $this->side = $side;

        return $this;
    }


    /**
     * Получение стороны для таба
     * @return string|null
     */
    public function getSide():? string {

        return $this->side;
    }
}