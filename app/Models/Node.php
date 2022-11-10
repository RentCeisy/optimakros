<?php

namespace App\Models;

class Node implements NodeInterface
{
    private $parent;
    private $relation;
    private $name;
    private $type;
    private $relationNodes;
    private $parentNode;

    public function __construct(string $name, string $type, string $parent, string $relation)
    {
        $this->name = $name;
        $this->type = $type;
        $this->parent = $parent;
        $this->relation = $relation;
        $this->parentNode = null;
        $this->relationNodes = [];
    }

    public function getParent(): string
    {
        return $this->parent;
    }

    public function getRelation(): string
    {
        return $this->relation;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setRelationNode(NodeInterface &$node): void
    {
        if (!in_array($node, $this->relationNodes)) {
            $this->relationNodes[] = $node;
        }
    }

    public function setRelationNodes(array $nodes): void
    {
        foreach ($nodes as $node) {
            $this->setRelationNode($node);
        }
    }

    public function setParentNode(NodeInterface &$node): void
    {
        $this->parent = &$node;

        $node->setRelationNode($this);
    }

    public function getParentNode(): ?NodeInterface
    {
        return $this->parentNode;
    }

    public function getRelationNodes(): array
    {
        return $this->relationNodes;
    }

    public function toArray(): array
    {
        $children = $this->relationNodes ? array_map(function ($item) {
            return $item->toArray();
        }, $this->relationNodes) : null;

        return [
            "itemName" => $this->getName(),
            "parent" => $this->getParent(),
            "children" => $children,
        ];
    }
}