<?php

namespace App\Models;

interface NodeInterface
{
    public function getParent(): ?string;

    public function getRelation(): ?string;

    public function getName(): ?string;

    public function setRelationNode(NodeInterface &$node): void;

    public function setParentNode(NodeInterface &$node): void;

    public function getParentNode(): ?NodeInterface;

    public function getRelationNodes(): array;

    public function getType(): string;

    public function setRelationNodes(array $nodes): void;

}