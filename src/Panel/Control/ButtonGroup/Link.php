<?php
namespace CoreUI\Panel\Control\ButtonGroup;

/**
 *
 */
class Link {

    private $id      = '';
    private $content = '';
    private $link    = '';


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
     * Установка ссылки
     * @param string $link
     * @return self
     */
    public function setLink(string $link): self {

        $this->link = $link;

        return $this;
    }


    /**
     * Получение ссылки
     * @return string
     */
    public function getLink(): string {
        return $this->link;
    }


    /**
     * @return array
     */
    public function toArray(): array {

        return [
            'id'      => $this->getId(),
            'type'    => 'link',
            'content' => $this->getContent(),
            'link'    => $this->getLink(),
        ];
    }
}