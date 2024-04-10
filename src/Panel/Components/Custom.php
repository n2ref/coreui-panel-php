<?php
namespace CoreUI\Panel\Components;


/**
 *
 */
class Custom {

    private $id      = '';
    private $content = '';


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
     * @return array
     */
    public function toArray(): array {

        return [
            'id'      => $this->getId(),
            'type'    => 'custom',
            'content' => $this->getContent(),
        ];
    }
}