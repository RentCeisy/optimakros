<?php

namespace App\Services\Handler;

use App\Models\Node;
use App\Models\NodeInterface;

class TreeHandler implements Handler
{
    private const TYPE = 'Прямые компоненты';
    private $tree;
    private $data;
    private $nodes;

    public function __construct()
    {
        $this->data = [];
        $this->tree = [];
        $this->nodes = [];
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        if ($this->data) {
            $this->fillNodes();
            $this->makeArrayTree();
        }
    }

    private function makeArrayTree(): void
    {
        $tree = [];
        $ref = [];
        foreach ($this->nodes as &$node) {
            /** @var $node NodeInterface */
            $ref[$node->getName()] = &$node;
            if ($node->getParent() === '') {
                $tree[$node->getName()] = &$node;
            } else {
                $ref[$node->getParent()]->setRelationNode($node);
            }
        }
        foreach ($ref as &$node) {
            /**  @var $node NodeInterface */
            if ($node->getType() === self::TYPE) {
                $node->setRelationNodes($ref[$node->getRelation()]->getRelationNodes());
            }
        }
        foreach ($tree as $item) {
            $this->tree[] = $item->toArray();
        }
    }

    private function fillNodes(): void
    {
        foreach ($this->data as $item) {
            if ($item[0] === '') {
                break;
            }
            $this->nodes[$item[0]] = new Node($item[0], $item[1], $item[2], $item[3]);
        }
    }

    public function getResult(): array
    {
        return $this->tree;
    }
}